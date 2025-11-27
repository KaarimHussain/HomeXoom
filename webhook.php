<?php
include "config.php";

require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Controllers/StripePaymentController.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Controllers\StripePaymentController;

$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();

$stripe = new StripePaymentController($conn);
$stripe->handleWebhook();

$db->closeConnection();
