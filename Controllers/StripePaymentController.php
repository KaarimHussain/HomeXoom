<?php

namespace HomeXoom\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use HomeXoom\Models\Subscription;

class StripePaymentController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        Stripe::setApiKey(STRIPE_SECRET_KEY);
    }

    public function createCheckoutSession($userId, $email)
    {
        $checkout_session = Session::create([
            'customer_email' => $email,
            'line_items' => [[
                'price' => STRIPE_PRICE_ID,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => BASE_URL . '/payment-success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => BASE_URL . '/payment-cancel.php',
            'client_reference_id' => $userId,
        ]);

        return $checkout_session->url;
    }

    public function handleWebhook()
    {
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                STRIPE_WEBHOOK_SECRET
            );
        } catch (\UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }



        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;
            case 'invoice.payment_succeeded':
                $invoice = $event->data->object;
                $this->handleInvoicePaymentSucceeded($invoice);
                break;
            case 'customer.subscription.updated':
            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                $this->handleSubscriptionUpdated($subscription);
                break;
            default:
                // Unexpected event type
                http_response_code(200);
                exit();
        }

        http_response_code(200);
    }

    private function handleCheckoutSessionCompleted($session)
    {
        $userId = $session->client_reference_id;
        $stripeCustomerId = $session->customer;
        $stripeSubscriptionId = $session->subscription;

        // Fetch subscription details to get period end
        $stripeSub = \Stripe\Subscription::retrieve($stripeSubscriptionId);

        $data = [
            'user_id' => $userId,
            'stripe_customer_id' => $stripeCustomerId,
            'stripe_subscription_id' => $stripeSubscriptionId,
            'stripe_price_id' => STRIPE_PRICE_ID,
            'status' => $stripeSub->status,
            'current_period_start' => date('Y-m-d H:i:s', $stripeSub->current_period_start),
            'current_period_end' => date('Y-m-d H:i:s', $this->getAdjustedPeriodEnd($stripeSub))
        ];

        // Check if subscription already exists (idempotency)
        $existingSub = Subscription::getByUserId($this->conn, $userId);
        if ($existingSub) {
            // Update existing
            $this->updateSubscriptionInDb($existingSub->id, $data);
        } else {
            // Create new
            Subscription::create($this->conn, $data);
        }
    }

    private function handleInvoicePaymentSucceeded($invoice)
    {
        if ($invoice->billing_reason == 'subscription_create') {
            // Handled by checkout.session.completed
            return;
        }

        $stripeSubscriptionId = $invoice->subscription;
        $stripeSub = \Stripe\Subscription::retrieve($stripeSubscriptionId);

        // Find user by stripe_customer_id or subscription_id
        // Since our model only has getByUserId, we might need a new method or query directly.
        // For now, let's assume we can find the subscription by stripe_subscription_id

        $stmt = $this->conn->prepare("SELECT id FROM Subscriptions WHERE stripe_subscription_id = ?");
        $stmt->bind_param("s", $stripeSubscriptionId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = [
                'status' => $stripeSub->status,
                'current_period_start' => date('Y-m-d H:i:s', $stripeSub->current_period_start),
                'current_period_end' => date('Y-m-d H:i:s', $this->getAdjustedPeriodEnd($stripeSub))
            ];
            $this->updateSubscriptionInDb($row['id'], $data);
        }
    }

    private function handleSubscriptionUpdated($subscription)
    {
        $stripeSubscriptionId = $subscription->id;

        $stmt = $this->conn->prepare("SELECT id FROM Subscriptions WHERE stripe_subscription_id = ?");
        $stmt->bind_param("s", $stripeSubscriptionId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = [
                'status' => $subscription->status,
                'current_period_start' => date('Y-m-d H:i:s', $subscription->current_period_start),
                'current_period_end' => date('Y-m-d H:i:s', $subscription->current_period_end)
            ];
            $this->updateSubscriptionInDb($row['id'], $data);
        }
    }

    private function updateSubscriptionInDb($id, $data)
    {
        // We need a more generic update method in Subscription model, but for now we can do it here or add it to model.
        // Let's add a generic update method to the model later. For now, direct query.

        if (isset($data['stripe_subscription_id']) && isset($data['stripe_customer_id'])) {
            $sql = "UPDATE Subscriptions SET status = ?, current_period_start = ?, current_period_end = ?, stripe_subscription_id = ?, stripe_customer_id = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssi", $data['status'], $data['current_period_start'], $data['current_period_end'], $data['stripe_subscription_id'], $data['stripe_customer_id'], $id);
        } else {
            $sql = "UPDATE Subscriptions SET status = ?, current_period_start = ?, current_period_end = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $data['status'], $data['current_period_start'], $data['current_period_end'], $id);
        }
        $stmt->execute();
    }

    private function getAdjustedPeriodEnd($stripeSub)
    {
        $start = $stripeSub->current_period_start;
        $end = $stripeSub->current_period_end;

        // If start and end are the same (common in test mode triggers), add 1 month
        if ($start == $end) {
            // Default to +1 month if plan interval is not available or identical
            return strtotime('+1 month', $start);
        }

        return $end;
    }
}
