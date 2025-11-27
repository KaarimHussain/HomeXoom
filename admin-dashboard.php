<?php
include "config.php";

// Checking if user is already logged in
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: index.php");
    exit();
}

$role_id = $_SESSION["isLoggedIn"]["role_id"];

require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Models/Roles.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Models\Roles;

$dbController = new DBController();
$dbController->openConnection();
$conn = $dbController->getConnection();

$buyerId = Roles::getIdByName($conn, Roles::BUYER);
$sellerId = Roles::getIdByName($conn, Roles::SELLER);
$adminId = Roles::getIdByName($conn, Roles::ADMIN);

$dbController->closeConnection();

switch ($role_id) {
    case $buyerId:
        header("Location: profile.php");
        exit();
    case $sellerId:
        header("Location: realtor-dashboard.php");
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo TTITLE ?></title>
</head>

<body>
    <h1>Welcome Admin</h1>
</body>

</html>