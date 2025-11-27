<?php

namespace HomeXoom\Controllers;

use HomeXoom\Models\Property;

class PropertyController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createProperty($userId, $postData, $files)
    {
        // Basic Validation
        if (empty($postData['title']) || empty($postData['price']) || empty($postData['address'])) {
            return ['success' => false, 'message' => 'Please fill in all required fields.'];
        }

        $data = [
            'user_id' => $userId,
            'title' => $postData['title'],
            'description' => $postData['description'] ?? '',
            'price' => $postData['price'],
            'address' => $postData['address'],
            'city' => $postData['city'],
            'state' => $postData['state'],
            'zip_code' => $postData['zip_code'],
            'bedrooms' => $postData['bedrooms'] ?? 0,
            'bathrooms' => $postData['bathrooms'] ?? 0,
            'sqft' => $postData['sqft'] ?? 0,
            'property_type' => $postData['property_type'] ?? 'Single Family',
            'area_type' => $postData['area_type'] ?? 'Square Feet',
            'country' => $postData['country'] ?? '',
            'google_map_url' => $postData['google_map_url'] ?? ''
        ];

        $propertyId = Property::create($this->conn, $data);

        if ($propertyId) {
            // Handle Image Uploads
            if (!empty($files['images']['name'][0])) {
                $this->uploadImages($propertyId, $files['images']);
            }
            return ['success' => true, 'message' => 'Property added successfully!', 'property_id' => $propertyId];
        }

        return ['success' => false, 'message' => 'Failed to add property.'];
    }

    private function uploadImages($propertyId, $files)
    {
        $targetDir = ROOT_DIR . "/Images/properties/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $count = count($files['name']);
        for ($i = 0; $i < $count; $i++) {
            $fileName = basename($files['name'][$i]);
            $targetFilePath = $targetDir . time() . "_" . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array(strtolower($fileType), $allowTypes)) {
                if (move_uploaded_file($files['tmp_name'][$i], $targetFilePath)) {
                    // Save relative path to DB
                    $relativePath = "Images/properties/" . time() . "_" . $fileName;
                    $isPrimary = ($i === 0); // First image is primary
                    Property::addImage($this->conn, $propertyId, $relativePath, $isPrimary);
                }
            }
        }
    }
}
