<?php
include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';

use HomeXoom\Controllers\DBController;

$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();

// Disable foreign key checks to allow truncation/deletion
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

echo "Deleting all Subscriptions...\n";
$conn->query("TRUNCATE TABLE Subscriptions");

echo "Deleting all Properties...\n";
$conn->query("TRUNCATE TABLE Properties");

echo "Deleting all PropertyImages...\n";
$conn->query("TRUNCATE TABLE PropertyImages");

echo "Deleting all Users...\n";
$conn->query("TRUNCATE TABLE Users");

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

$db->closeConnection();
echo "All users and related data have been deleted.\n";
