<?php
include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Models/Roles.php';
require_once ROOT_DIR . '/Models/Subscription.php';
require_once ROOT_DIR . '/Models/Property.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Models\Roles;
use HomeXoom\Models\Subscription;
use HomeXoom\Models\Property;

// Check login
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: login.php");
    exit();
}

$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();

// Check Subscription
$subscription = Subscription::getByUserId($conn, $_SESSION['isLoggedIn']['id']);

if (!$subscription || $subscription->status !== 'active') {
    $db->closeConnection();
    header("Location: realtor-dashboard.php");
    exit();
}

// Get property ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: realtor-dashboard.php");
    exit();
}

$propertyId = $_GET['id'];
$property = Property::getById($conn, $propertyId);

// Security check: verify property belongs to user
if (!$property || $property['user_id'] != $_SESSION['isLoggedIn']['id']) {
    $db->closeConnection();
    header("Location: realtor-dashboard.php");
    exit();
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'price' => $_POST['price'] ?? 0,
        'address' => $_POST['address'] ?? '',
        'city' => $_POST['city'] ?? '',
        'state' => $_POST['state'] ?? '',
        'zip_code' => $_POST['zip_code'] ?? '',
        'bedrooms' => $_POST['bedrooms'] ?? 0,
        'bathrooms' => $_POST['bathrooms'] ?? 0,
        'sqft' => $_POST['sqft'] ?? 0,
        'property_type' => $_POST['property_type'] ?? '',
        'area_type' => $_POST['area_type'] ?? '',
        'country' => $_POST['country'] ?? '',
        'google_map_url' => $_POST['google_map_url'] ?? ''
    ];

    if (Property::update($conn, $propertyId, $_SESSION['isLoggedIn']['id'], $data)) {
        $message = 'Property updated successfully!';
        $messageType = 'success';
        // Refresh property data
        $property = Property::getById($conn, $propertyId);
    } else {
        $message = 'Failed to update property.';
        $messageType = 'error';
    }
}

$db->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property - <?php echo TTITLE ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-100 font-inter">
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex items-center justify-center flex-col py-20">
        <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">Edit <span
                class="text-primary-color font-prata">Property</span>
        </h1>
    </main>

    <!-- Breadcrumbs -->
    <div class="container mx-auto mt-4 px-4">
        <nav class="flex items-center text-sm font-inter text-gray-600">
            <a href="realtor-dashboard.php" class="hover:text-primary-color transition">Dashboard</a>
            <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
            <span class="text-text-color font-medium">Edit Property</span>
        </nav>
    </div>

    <div class="container mx-auto mt-8 p-4 max-w-4xl">
        <?php if ($message): ?>
            <div class="<?php echo $messageType === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'; ?> border-l-4 p-4 mb-4" role="alert">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 border-b pb-2 font-prata">Property Details</h2>

            <form action="" method="POST">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Property Title</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="title" name="title" type="text"
                            value="<?php echo htmlspecialchars($property['title']); ?>" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price ($)</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="price" name="price" type="number" step="0.01"
                            value="<?php echo htmlspecialchars($property['price']); ?>" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="property_type">Property Type</label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="property_type" name="property_type">
                            <option <?php echo $property['property_type'] === 'Single Family' ? 'selected' : ''; ?>>Single Family</option>
                            <option <?php echo $property['property_type'] === 'Condo' ? 'selected' : ''; ?>>Condo</option>
                            <option <?php echo $property['property_type'] === 'Townhouse' ? 'selected' : ''; ?>>Townhouse</option>
                            <option <?php echo $property['property_type'] === 'Multi-Family' ? 'selected' : ''; ?>>Multi-Family</option>
                            <option <?php echo $property['property_type'] === 'Land' ? 'selected' : ''; ?>>Land</option>
                        </select>
                    </div>
                </div>

                <!-- Location -->
                <h3 class="text-lg font-medium text-gray-700 mb-4">Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Address</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="address" name="address" type="text"
                            value="<?php echo htmlspecialchars($property['address']); ?>" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="city">City</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="city" name="city" type="text"
                            value="<?php echo htmlspecialchars($property['city']); ?>" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Country</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="country" name="country" type="text"
                            value="<?php echo htmlspecialchars($property['country']); ?>" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="state">State</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="state" name="state" type="text"
                                value="<?php echo htmlspecialchars($property['state']); ?>" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="zip_code">Zip Code</label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="zip_code" name="zip_code" type="text"
                                value="<?php echo htmlspecialchars($property['zip_code']); ?>" required>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <h3 class="text-lg font-medium text-gray-700 mb-4">Features</h3>
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="bedrooms">Bedrooms</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="bedrooms" name="bedrooms" type="number"
                            value="<?php echo htmlspecialchars($property['bedrooms']); ?>">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="bathrooms">Bathrooms</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="bathrooms" name="bathrooms" type="number" step="0.5"
                            value="<?php echo htmlspecialchars($property['bathrooms']); ?>">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sqft">Area Size</label>
                        <div class="flex">
                            <input class="shadow appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="sqft" name="sqft" type="number"
                                value="<?php echo htmlspecialchars($property['sqft']); ?>">
                            <select class="shadow border rounded-r bg-gray-100 text-gray-700 py-2 px-3 focus:outline-none" name="area_type">
                                <option <?php echo $property['area_type'] === 'Square Feet' ? 'selected' : ''; ?>>Square Feet</option>
                                <option <?php echo $property['area_type'] === 'Square Meter' ? 'selected' : ''; ?>>Square Meter</option>
                                <option <?php echo $property['area_type'] === 'Hectare' ? 'selected' : ''; ?>>Hectare</option>
                                <option <?php echo $property['area_type'] === 'Acre' ? 'selected' : ''; ?>>Acre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description & Media -->
                <h3 class="text-lg font-medium text-gray-700 mb-4">Description & Media</h3>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="description" name="description" rows="4"><?php echo htmlspecialchars($property['description']); ?></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="google_map_url">Google Map URL (Embed Link)</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="google_map_url" name="google_map_url" type="text"
                        value="<?php echo htmlspecialchars($property['google_map_url']); ?>">
                    <p class="text-xs text-gray-500 mt-1">Paste the "Embed a map" HTML src URL here.</p>
                </div>

                <div class="flex items-center justify-between">
                    <a href="realtor-dashboard.php" class="bg-gray-500 text-white font-bold py-3 px-6 rounded hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button class="bg-primary-color text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline hover:bg-opacity-90 transition" type="submit">
                        Update Property
                    </button>
                </div>
            </form>
        </div>
    </div>

    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>
</body>

</html>