<?php

namespace HomeXoom\Controllers;

include_once __DIR__ . "/../config.php";

use mysqli;

class DBController
{

    private $conn;

    public function __construct()
    {
        $this->startSession();
    }
    // Session Management
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Database Connection
    public function openConnection()
    {
        $conn = new mysqli("localhost", "root", "", "homexoom");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
    }

    // Database Connection Close
    public function closeConnection()
    {
        if ($this->conn instanceof mysqli) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}
