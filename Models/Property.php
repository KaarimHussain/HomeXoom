<?php

namespace HomeXoom\Models;

class Property
{
    public static function create($conn, $data)
    {
        $sql = "INSERT INTO Properties (user_id, title, description, price, address, city, state, zip_code, bedrooms, bathrooms, sqft, property_type, area_type, country, google_map_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "issdssssddissss",
            $data['user_id'],
            $data['title'],
            $data['description'],
            $data['price'],
            $data['address'],
            $data['city'],
            $data['state'],
            $data['zip_code'],
            $data['bedrooms'],
            $data['bathrooms'],
            $data['sqft'],
            $data['property_type'],
            $data['area_type'],
            $data['country'],
            $data['google_map_url']
        );

        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        return false;
    }

    public static function addImage($conn, $propertyId, $imagePath, $isPrimary = false)
    {
        $sql = "INSERT INTO PropertyImages (property_id, image_path, is_primary) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $isPrimaryInt = $isPrimary ? 1 : 0;
        $stmt->bind_param("isi", $propertyId, $imagePath, $isPrimaryInt);
        return $stmt->execute();
    }

    public static function getById($conn, $id)
    {
        $sql = "SELECT * FROM Properties WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function getAll($conn)
    {
        // Fetch properties with primary image
        $sql = "SELECT p.*, pi.image_path 
                FROM Properties p 
                LEFT JOIN PropertyImages pi ON p.id = pi.property_id AND pi.is_primary = 1
                ORDER BY p.created_at DESC";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getRecent($conn, $limit = 3, $category = null)
    {
        $sql = "SELECT p.*, pi.image_path 
                FROM Properties p 
                LEFT JOIN PropertyImages pi ON p.id = pi.property_id AND pi.is_primary = 1
                INNER JOIN Users u ON p.user_id = u.id
                LEFT JOIN Subscriptions s ON u.id = s.user_id
                WHERE (s.status = 'active' OR s.status = 'trialing')";

        $params = [];
        $types = "";

        if ($category) {
            $sql .= " AND p.property_type = ?";
            $params[] = $category;
            $types .= "s";
        }

        $sql .= " ORDER BY p.created_at DESC LIMIT ?";
        $params[] = $limit;
        $types .= "i";

        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all properties from users with active subscriptions only
     * Used for public-facing pages like buy.php
     */
    public static function getAllWithActiveOwners($conn)
    {
        $sql = "SELECT p.*, pi.image_path 
                FROM Properties p 
                LEFT JOIN PropertyImages pi ON p.id = pi.property_id AND pi.is_primary = 1
                INNER JOIN Users u ON p.user_id = u.id
                LEFT JOIN Subscriptions s ON u.id = s.user_id
                WHERE s.status = 'active' OR s.status = 'trialing'
                ORDER BY p.created_at DESC";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function search($conn, $filters)
    {
        $sql = "SELECT p.*, pi.image_path 
                FROM Properties p 
                LEFT JOIN PropertyImages pi ON p.id = pi.property_id AND pi.is_primary = 1
                INNER JOIN Users u ON p.user_id = u.id
                LEFT JOIN Subscriptions s ON u.id = s.user_id
                WHERE (s.status = 'active' OR s.status = 'trialing')";

        $params = [];
        $types = "";

        if (!empty($filters['city'])) {
            $sql .= " AND p.city = ?";
            $params[] = $filters['city'];
            $types .= "s";
        }
        if (!empty($filters['country'])) {
            $sql .= " AND p.country = ?";
            $params[] = $filters['country'];
            $types .= "s";
        }
        if (!empty($filters['property_type'])) {
            $sql .= " AND p.property_type = ?";
            $params[] = $filters['property_type'];
            $types .= "s";
        }
        if (!empty($filters['zip_code'])) {
            $sql .= " AND p.zip_code = ?";
            $params[] = $filters['zip_code'];
            $types .= "s";
        }
        if (!empty($filters['price_range'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $filters['price_range'];
            $types .= "d";
        }
        if (!empty($filters['area_type'])) {
            $sql .= " AND p.area_type = ?";
            $params[] = $filters['area_type'];
            $types .= "s";
        }

        $sql .= " ORDER BY p.created_at DESC";

        $stmt = $conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function countByUserId($conn, $userId)
    {
        $sql = "SELECT COUNT(*) as count FROM Properties WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public static function getByUserId($conn, $userId)
    {
        $sql = "SELECT p.*, pi.image_path 
                FROM Properties p 
                LEFT JOIN PropertyImages pi ON p.id = pi.property_id AND pi.is_primary = 1
                WHERE p.user_id = ?
                ORDER BY p.created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function update($conn, $id, $userId, $data)
    {
        // Security check: verify property belongs to user
        $property = self::getById($conn, $id);
        if (!$property || $property['user_id'] != $userId) {
            return false;
        }

        $sql = "UPDATE Properties SET 
                title = ?, 
                description = ?, 
                price = ?, 
                address = ?, 
                city = ?, 
                state = ?, 
                zip_code = ?, 
                bedrooms = ?, 
                bathrooms = ?, 
                sqft = ?, 
                property_type = ?, 
                area_type = ?, 
                country = ?, 
                google_map_url = ?
                WHERE id = ? AND user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssdssssddissssii",
            $data['title'],
            $data['description'],
            $data['price'],
            $data['address'],
            $data['city'],
            $data['state'],
            $data['zip_code'],
            $data['bedrooms'],
            $data['bathrooms'],
            $data['sqft'],
            $data['property_type'],
            $data['area_type'],
            $data['country'],
            $data['google_map_url'],
            $id,
            $userId
        );

        return $stmt->execute();
    }

    public static function delete($conn, $id, $userId)
    {
        // First delete images
        $sql = "DELETE FROM PropertyImages WHERE property_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Then delete property (with user check for security)
        $sql = "DELETE FROM Properties WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }

    public static function getImages($conn, $propertyId)
    {
        $sql = "SELECT * FROM PropertyImages WHERE property_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $propertyId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
