<?php

namespace HomeXoom\Models;

class Roles
{
    const BUYER = "Buyer";
    const SELLER = "Seller";
    const ADMIN = "Admin";

    public $id;
    public $role_name;
    public $created_at;
    public $updated_at;

    public function __construct($id, $role_name, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->role_name = $role_name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function getAll($conn)
    {
        $roles = [];
        $sql = "SELECT * FROM Roles";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roles[] = new Roles($row['id'], $row['role_name'], $row['created_at'], $row['updated_at']);
            }
        }
        return $roles;
    }

    public static function getIdByName($conn, $role_name)
    {
        $sql = "SELECT id FROM Roles WHERE role_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $role_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        }
        return null;
    }
}
