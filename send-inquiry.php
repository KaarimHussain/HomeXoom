<?php
header('Content-Type: application/json');

include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Controllers/EmailController.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Controllers\EmailController;

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Get and validate input
$propertyId = $_POST['property_id'] ?? '';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validation
$errors = [];

if (empty($propertyId) || !is_numeric($propertyId)) {
    $errors[] = 'Invalid property ID';
}

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

if (empty($phone)) {
    $errors[] = 'Phone number is required';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit();
}

// Send email
try {
    $db = new DBController();
    $db->openConnection();
    $conn = $db->getConnection();

    $emailController = new EmailController();
    $result = $emailController->sendPropertyInquiry(
        $propertyId,
        [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message ?: 'No message provided'
        ],
        $conn
    );

    $db->closeConnection();

    echo json_encode($result);
} catch (Exception $e) {
    error_log("Send inquiry error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}
