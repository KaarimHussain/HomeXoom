<?php
include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Controllers/StripePaymentController.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Controllers\StripePaymentController;

if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: login.php");
    exit();
}

$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();
try {

    $stripe = new StripePaymentController($conn);
    $url = $stripe->createCheckoutSession($_SESSION['isLoggedIn']['id'], $_SESSION['isLoggedIn']['email']);

    $db->closeConnection();

    if ($url) {
        header("Location: " . $url);
        exit();
    } else {
        echo "Error creating checkout session. Please check your configuration.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
