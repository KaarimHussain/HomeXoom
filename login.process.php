<?php
include "config.php";
include ROOT_DIR . "/Controllers/db.controller.php";

use HomeXoom\Controllers\DBController;
// Controller Instance
$dbController = new DBController();

// Database Connection
$dbController->openConnection();
$conn = $dbController->getConnection();