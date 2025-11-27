<?php

namespace HomeXoom\Models;

class Subscription
{
    public $id;
    public $user_id;
    public $stripe_customer_id;
    public $stripe_subscription_id;
    public $stripe_price_id;
    public $status;
    public $current_period_start;
    public $current_period_end;
    public $created_at;
    public $updated_at;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'];
        $this->stripe_customer_id = $data['stripe_customer_id'] ?? null;
        $this->stripe_subscription_id = $data['stripe_subscription_id'] ?? null;
        $this->stripe_price_id = $data['stripe_price_id'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->current_period_start = $data['current_period_start'] ?? null;
        $this->current_period_end = $data['current_period_end'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }

    public static function create($conn, $data)
    {
        $stmt = $conn->prepare("INSERT INTO Subscriptions (user_id, stripe_customer_id, stripe_subscription_id, stripe_price_id, status, current_period_start, current_period_end) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $data['user_id'], $data['stripe_customer_id'], $data['stripe_subscription_id'], $data['stripe_price_id'], $data['status'], $data['current_period_start'], $data['current_period_end']);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        error_log("Subscription::create failed: " . $stmt->error);
        return false;
    }

    public static function getByUserId($conn, $user_id)
    {
        $stmt = $conn->prepare("SELECT * FROM Subscriptions WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return new Subscription($result->fetch_assoc());
        }
        return null;
    }

    public static function updateStatus($conn, $subscription_id, $status)
    {
        $stmt = $conn->prepare("UPDATE Subscriptions SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $subscription_id);
        return $stmt->execute();
    }
}
