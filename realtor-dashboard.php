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
require_once ROOT_DIR . '/Models/Subscription.php';
require_once ROOT_DIR . '/Models/Property.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Models\Roles;
use HomeXoom\Models\Subscription;
use HomeXoom\Models\Property;

$dbController = new DBController();
$dbController->openConnection();
$conn = $dbController->getConnection();

$buyerId = Roles::getIdByName($conn, Roles::BUYER);
$sellerId = Roles::getIdByName($conn, Roles::SELLER);
$adminId = Roles::getIdByName($conn, Roles::ADMIN);

// Fetch Subscription
$subscription = Subscription::getByUserId($conn, $_SESSION['isLoggedIn']['id']);

// Fetch Stats and Properties
$activeListings = Property::countByUserId($conn, $_SESSION['isLoggedIn']['id']);
$userProperties = Property::getByUserId($conn, $_SESSION['isLoggedIn']['id']);

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    Property::delete($conn, $_GET['delete'], $_SESSION['isLoggedIn']['id']);
    header("Location: realtor-dashboard.php");
    exit();
}

$dbController->closeConnection();

if ($role_id == $buyerId) {
    header("Location: profile.php");
    exit();
} elseif ($role_id == $adminId) {
    header("Location: admin-dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtor Dashboard - <?php echo TTITLE ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/dashboard.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-50">
    <?php include COMPONENT_DIR . "/header.php"; ?>

    <main class="min-h-screen pt-32 pb-20">
        <div class="container mx-auto px-4">
            <!-- Welcome Header -->
            <div class="bg-gradient-to-r from-secondary-color via-secondary-color to-primary-color rounded-2xl shadow-xl p-8 md:p-12 mb-8 text-white">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-prata mb-2 text-white">Welcome back, <?php echo htmlspecialchars($_SESSION['isLoggedIn']['fullname'] ?? 'Realtor'); ?>!</h1>
                        <p class="text-white/90 font-inter text-lg">Manage your properties and grow your business</p>
                    </div>
                    <div class="flex gap-3">
                        <?php if ($subscription && $subscription->status === 'active'): ?>
                            <a href="add-property.php" class="bg-white text-primary-color px-6 py-3 rounded-lg font-inter font-semibold hover:bg-gray-100 transition inline-flex items-center gap-2">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                                Add Property
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Stats Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Active Listings -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary-color">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-primary-color/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="home" class="w-6 h-6 text-primary-color"></i>
                        </div>
                        <span class="text-xs font-inter text-gray-500 uppercase">This Month</span>
                    </div>
                    <h3 class="text-3xl font-prata text-primary-color mb-1"><?php echo $activeListings; ?></h3>
                    <p class="text-gray-600 font-inter text-sm">Active Listings</p>
                </div>

                <!-- Total Views -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-secondary-color">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-secondary-color/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="eye" class="w-6 h-6 text-secondary-color"></i>
                        </div>
                        <span class="text-xs font-inter text-gray-500 uppercase">All Time</span>
                    </div>
                    <h3 class="text-3xl font-prata text-secondary-color mb-1">0</h3>
                    <p class="text-gray-600 font-inter text-sm">Total Views</p>
                </div>

                <!-- Subscription Status -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 <?php echo ($subscription && $subscription->status === 'active') ? 'border-green-500' : 'border-red-500'; ?>">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 <?php echo ($subscription && $subscription->status === 'active') ? 'bg-green-100' : 'bg-red-100'; ?> rounded-lg flex items-center justify-center">
                            <i data-lucide="<?php echo ($subscription && $subscription->status === 'active') ? 'check-circle' : 'alert-circle'; ?>" class="w-6 h-6 <?php echo ($subscription && $subscription->status === 'active') ? 'text-green-600' : 'text-red-600'; ?>"></i>
                        </div>
                        <span class="text-xs font-inter text-gray-500 uppercase">Status</span>
                    </div>
                    <h3 class="text-3xl font-prata <?php echo ($subscription && $subscription->status === 'active') ? 'text-green-600' : 'text-red-600'; ?> mb-1">
                        <?php echo ($subscription && $subscription->status === 'active') ? 'Active' : 'Inactive'; ?>
                    </h3>
                    <p class="text-gray-600 font-inter text-sm">Membership</p>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Subscription Details -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-prata mb-4 flex items-center gap-2">
                            <i data-lucide="crown" class="w-6 h-6 text-primary-color"></i>
                            Membership
                        </h2>

                        <?php if ($subscription && $subscription->status === 'active'):
                            $startDate = strtotime($subscription->current_period_start);
                            $endDate = strtotime($subscription->current_period_end);
                            $currentDate = time();
                            $totalDays = ($endDate - $startDate) / (60 * 60 * 24);
                            $daysElapsed = ($currentDate - $startDate) / (60 * 60 * 24);
                            $daysRemaining = ($endDate - $currentDate) / (60 * 60 * 24);

                            // Fix: Check if totalDays is greater than 0 before division
                            if ($totalDays > 0) {
                                $progressPercentage = min(100, max(0, ($daysElapsed / $totalDays) * 100));
                            } else {
                                // Default to 0% if dates are invalid or the same
                                $progressPercentage = 0;
                            }
                        ?>
                            <!-- Active Status Badge -->
                            <div class="mb-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border-2 border-green-200">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                        <span class="text-green-700 font-bold font-inter">ACTIVE</span>
                                    </div>
                                </div>

                                <!-- Days Remaining Highlight -->
                                <div class="bg-white rounded-lg p-3 mb-3 text-center">
                                    <p class="text-3xl font-prata text-green-600 mb-1"><?php echo max(0, round($daysRemaining)); ?></p>
                                    <p class="text-xs text-gray-600 font-inter">Days Remaining</p>
                                </div>

                                <!-- Timeline -->
                                <div class="space-y-3">
                                    <!-- Start Date -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="play-circle" class="w-4 h-4 text-green-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-500 font-inter">Started</p>
                                            <p class="text-sm font-semibold text-gray-800 font-inter">
                                                <?php echo date('F j, Y', $startDate); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="relative ml-4 pl-4 border-l-2 border-green-200">
                                        <div class="mb-2">
                                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all duration-500"
                                                    style="width: <?php echo $progressPercentage; ?>%"></div>
                                            </div>
                                            <p class="text-xs text-gray-500 font-inter mt-1 text-center">
                                                <?php echo round($progressPercentage); ?>% Complete
                                            </p>
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-500 font-inter">Renews On</p>
                                            <p class="text-sm font-semibold text-gray-800 font-inter">
                                                <?php echo date('F j, Y', $endDate); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <!-- Inactive Status -->
                            <div class="mb-4 p-4 bg-gradient-to-r from-red-50 to-rose-50 rounded-lg border-2 border-red-200">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <span class="text-red-700 font-bold font-inter">INACTIVE</span>
                                    </div>
                                    <span class="text-xs bg-gray-400 text-white px-3 py-1 rounded-full font-inter font-semibold">
                                        Free
                                    </span>
                                </div>

                                <div class="bg-white rounded-lg p-4 mb-3 text-center">
                                    <i data-lucide="lock" class="w-12 h-12 mx-auto mb-2 text-gray-400"></i>
                                    <p class="text-sm text-gray-600 font-inter">
                                        Subscribe to unlock property listings and premium features.
                                    </p>
                                </div>

                                <!-- Benefits List -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-sm font-inter text-gray-700">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                        <span>Unlimited property listings</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm font-inter text-gray-700">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                        <span>Priority support</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm font-inter text-gray-700">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                        <span>Analytics dashboard</span>
                                    </div>
                                </div>
                            </div>

                            <a href="subscribe.php" class="block w-full button-primary text-center">
                                <i data-lucide="star" class="w-4 h-4 inline mr-1"></i>
                                Subscribe Now
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Properties Overview -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-prata flex items-center gap-2">
                                <i data-lucide="building" class="w-6 h-6 text-primary-color"></i>
                                Your Properties
                            </h2>
                            <?php if ($subscription && $subscription->status === 'active'): ?>
                                <a href="add-property.php" class="button-secondary text-sm">
                                    <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>
                                    Add New
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($userProperties)): ?>
                            <div class="text-center py-16">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="home" class="w-12 h-12 text-gray-400"></i>
                                </div>
                                <h3 class="text-2xl font-prata mb-2 text-gray-800">No Properties Yet</h3>
                                <p class="text-gray-600 font-inter mb-6">Start building your portfolio by adding your first property</p>
                                <?php if ($subscription && $subscription->status === 'active'): ?>
                                    <a href="add-property.php" class="button-primary inline-block">
                                        <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>
                                        Add Your First Property
                                    </a>
                                <?php else: ?>
                                    <a href="subscribe.php" class="button-primary inline-block">
                                        <i data-lucide="lock" class="w-4 h-4 inline mr-1"></i>
                                        Subscribe to Add Properties
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4 max-h-[600px] overflow-y-auto">
                                <?php foreach ($userProperties as $property):
                                    $imagePath = !empty($property['image_path']) ? $property['image_path'] : 'https://via.placeholder.com/400x300?text=No+Image';
                                    if (strpos($imagePath, 'http') === false) {
                                        $imagePath = BASE_URL . '/' . $imagePath;
                                    }
                                ?>
                                    <div class="flex flex-col sm:flex-row gap-4 p-4 border border-gray-200 rounded-lg hover:border-primary-color transition-all hover:shadow-md">
                                        <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                            alt="<?php echo htmlspecialchars($property['title']); ?>"
                                            class="w-full sm:w-32 h-32 object-cover rounded-lg">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-prata mb-1"><?php echo htmlspecialchars($property['title']); ?></h3>
                                            <p class="text-gray-600 font-inter text-sm mb-2">
                                                <i data-lucide="map-pin" class="w-3 h-3 inline"></i>
                                                <?php echo htmlspecialchars($property['city'] . ', ' . $property['country']); ?>
                                            </p>
                                            <div class="flex flex-wrap items-center gap-4 text-sm font-inter text-gray-600 mb-3">
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="bed" class="w-4 h-4"></i>
                                                    <?php echo $property['bedrooms']; ?>
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="bath" class="w-4 h-4"></i>
                                                    <?php echo $property['bathrooms'] + 0; ?>
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="ruler" class="w-4 h-4"></i>
                                                    <?php echo $property['sqft']; ?> sqft
                                                </span>
                                                <span class="font-semibold text-primary-color text-base">
                                                    $<?php echo number_format($property['price']); ?>
                                                </span>
                                            </div>
                                            <div class="flex gap-2">
                                                <a href="edit-property.php?id=<?php echo $property['id']; ?>"
                                                    class="button-secondary-outline text-xs py-1.5 px-4">
                                                    <i data-lucide="edit" class="w-3 h-3 inline-block mr-1"></i>
                                                    Edit
                                                </a>
                                                <a href="?delete=<?php echo $property['id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this property?')"
                                                    class="bg-red-500 text-white px-4 py-1.5 rounded-md hover:bg-red-600 transition text-xs font-inter">
                                                    <i data-lucide="trash-2" class="w-3 h-3 inline-block mr-1"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="container mx-auto py-10">
        <?php include "Components/footer.php"; ?>
    </section>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>