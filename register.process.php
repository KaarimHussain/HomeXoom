<?php
include_once "config.php";

use HomeXoom\Controllers\DBController;
use HomeXoom\Controllers\RegisterController;

require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Controllers/register.controller.php';

// Controller Instance
$dbController = new DBController();

// Database Connection
$dbController->openConnection();
$conn = $dbController->getConnection();

// checking if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST["user_type"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $registerController = new RegisterController($conn);
    try {
        if ($registerController->Register($user_type, $fullname, $email, $phone, $password)) {
            // Sessions Messages
            $_SESSION["message_box"] = array(
                "type" => "success",
                "message" => "Registeration Successful"
            );
            header("Location: register.php");
            exit();
        } else {
            $_SESSION["message_box"] = array(
                "type" => "error",
                "message" => "Registeration Failed"
            );
            header("Location: register.php");
            exit();
        }
    } catch (Exception $ex) {
        $_SESSION["message_box"] = array(
            "type" => "error",
            "message" => $ex->getMessage()
        );
        header("Location: register.php");
        exit();
    }
} else {
    $_SESSION["message_box"] = array(
        "type" => "error",
        "message" => "Invalid Request Method"
    );
    header("Location: register.php");
    exit();
}
