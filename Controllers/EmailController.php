<?php

namespace HomeXoom\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP()
    {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['SMTP_USERNAME'] ?? '';
            $this->mailer->Password = $_ENV['SMTP_PASSWORD'] ?? '';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $_ENV['SMTP_PORT'] ?? 587;

            // Default sender
            $this->mailer->setFrom(
                $_ENV['SMTP_FROM_EMAIL'] ?? 'noreply@homexoom.com',
                $_ENV['SMTP_FROM_NAME'] ?? 'HomeXoom'
            );

            // Character set
            $this->mailer->CharSet = 'UTF-8';
        } catch (Exception $e) {
            error_log("Email configuration error: " . $e->getMessage());
        }
    }

    public function sendPropertyInquiry($propertyId, $visitorData, $conn)
    {
        try {
            // Get property and owner details
            require_once __DIR__ . '/../Models/Property.php';
            require_once __DIR__ . '/../Models/User.php';

            $property = \HomeXoom\Models\Property::getById($conn, $propertyId);
            if (!$property) {
                return ['success' => false, 'message' => 'Property not found'];
            }

            $owner = \HomeXoom\Models\User::getById($conn, $property['user_id']);
            if (!$owner || empty($owner['email'])) {
                return ['success' => false, 'message' => 'Property owner email not found'];
            }

            // Load email template
            $template = $this->loadTemplate('property-inquiry', [
                'visitor_name' => $visitorData['name'],
                'visitor_email' => $visitorData['email'],
                'visitor_phone' => $visitorData['phone'],
                'visitor_message' => $visitorData['message'],
                'property_title' => $property['title'],
                'property_price' => number_format($property['price']),
                'property_address' => $property['address'] . ', ' . $property['city'],
                'property_id' => $property['id']
            ]);

            // Recipients
            $this->mailer->addAddress($owner['email'], $owner['full_name'] ?? $owner['username']);
            $this->mailer->addReplyTo($visitorData['email'], $visitorData['name']);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'New Inquiry for ' . $property['title'];
            $this->mailer->Body = $template;
            $this->mailer->AltBody = strip_tags($template);

            $this->mailer->send();

            return ['success' => true, 'message' => 'Your inquiry has been sent successfully!'];
        } catch (Exception $e) {
            error_log("Email sending error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to send email. Please try again later.'];
        }
    }

    private function loadTemplate($templateName, $data)
    {
        $templatePath = __DIR__ . '/../email-templates/' . $templateName . '.html';

        if (!file_exists($templatePath)) {
            throw new Exception("Email template not found: " . $templateName);
        }

        $template = file_get_contents($templatePath);

        // Replace placeholders
        foreach ($data as $key => $value) {
            $template = str_replace('{{' . $key . '}}', htmlspecialchars($value), $template);
        }

        return $template;
    }
}
