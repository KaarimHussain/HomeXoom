<?php

namespace HomeXoom\Controllers;

include_once ROOT_DIR . "/Controllers/db.controller.php";

use Exception;

class RegisterController
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function Login($email, $password)
    {
        // 1. Check if user exists
        $stmt = $this->conn->prepare("SELECT id, full_name, email, password_hash, role_id FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Invalid email or password.");
        }

        $user = $result->fetch_assoc();

        // 2. Verify Password
        if (!password_verify($password, $user['password_hash'])) {
            throw new Exception("Invalid email or password.");
        }

        $this->SetSession($user['id'], $user['email'], $user['role_id'], $user['full_name']);

        // 3. Return user data (excluding password)
        unset($user['password_hash']);
        return $user;
    }

    public function Register($user_type, $fullname, $email, $phone, $password)
    {
        if ($this->CheckIfAlreadyExist($email)) {
            throw new Exception("Email already exists, Try a different email");
        }

        $role_name = ucfirst($user_type);

        $roleStmt = $this->conn->prepare("SELECT id FROM Roles WHERE role_name = ?");
        $roleStmt->bind_param("s", $role_name);
        $roleStmt->execute();
        $result = $roleStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Role not found, Contact Admin!");
        }

        $row = $result->fetch_assoc();
        $role_id = $row['id'];
        $roleStmt->close();

        $stmt = $this->conn->prepare("INSERT INTO users (role_id, full_name, email, phone, password_hash) VALUES (?, ?, ?, ?, ?)");
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("issss", $role_id, $fullname, $email, $phone, $hashpassword);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            throw new Exception("Registration failed");
        }
    }
    private function CheckIfAlreadyExist($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    private function SetSession($id, $email, $role_id, $fullname)
    {
        $_SESSION["isLoggedIn"] = array(
            "id" => $id,
            "email" => $email,
            "role_id" => $role_id,
            "fullname" => $fullname
        );
    }
}
