<?php
include "config.php";

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: " . BASE_URL);
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

if ($role_id == $sellerId) {
    header("Location: realtor-dashboard.php");
    exit();
} elseif ($role_id == $adminId) {
    header("Location: admin-dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo TTITLE ?></title>
</head>

<body>

</body>

</html>