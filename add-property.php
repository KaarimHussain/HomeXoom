<?php
include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Models/Roles.php';
require_once ROOT_DIR . '/Models/Subscription.php';
require_once ROOT_DIR . '/Models/Property.php';
require_once ROOT_DIR . '/Controllers/PropertyController.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Models\Roles;
use HomeXoom\Models\Subscription;
use HomeXoom\Controllers\PropertyController;

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

$message = '';
$messageType = 'info';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PropertyController($conn);
    $result = $controller->createProperty($_SESSION['isLoggedIn']['id'], $_POST, $_FILES);
    $message = $result['message'];
    $messageType = $result['success'] ? 'success' : 'error';
    if ($result['success']) {
        header("Location: realtor-dashboard.php");
        exit();
    }
}

$db->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - <?php echo TTITLE ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-50">
    <?php include COMPONENT_DIR . "/header.php"; ?>

    <!-- Hero Section -->
    <main class="hero-section flex items-center justify-center flex-col py-20">
        <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata text-center">Add a <span class="text-primary-color font-prata">Property</span></h1>
        <p class="text-primary-foreground text-center font-inter mt-4 max-w-2xl">Fill in the details below to list your property</p>
    </main>

    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Breadcrumbs -->
        <nav class="flex items-center text-sm font-inter text-gray-600 mb-6">
            <a href="realtor-dashboard.php" class="hover:text-primary-color transition">Dashboard</a>
            <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
            <span class="text-text-color font-medium">Add Property</span>
        </nav>

        <!-- Alert Message -->
        <?php if ($message): ?>
            <div class="mb-6 p-4 rounded-lg border-l-4 <?php echo $messageType === 'success' ? 'bg-green-50 border-green-500' : 'bg-red-50 border-red-500'; ?>" role="alert">
                <div class="flex items-center gap-2">
                    <i data-lucide="<?php echo $messageType === 'success' ? 'check-circle' : 'alert-circle'; ?>" class="w-5 h-5 <?php echo $messageType === 'success' ? 'text-green-600' : 'text-red-600'; ?>"></i>
                    <p class="font-inter <?php echo $messageType === 'success' ? 'text-green-700' : 'text-red-700'; ?>"><?php echo $message; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Progress Steps -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 step-item active">
                    <div class="w-10 h-10 rounded-full bg-primary-color text-white flex items-center justify-center font-semibold">1</div>
                    <span class="font-inter font-medium hidden sm:inline">Basic Info</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
                <div class="flex items-center gap-2 step-item">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">2</div>
                    <span class="font-inter font-medium hidden sm:inline">Location</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
                <div class="flex items-center gap-2 step-item">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">3</div>
                    <span class="font-inter font-medium hidden sm:inline">Features</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
                <div class="flex items-center gap-2 step-item">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-semibold">4</div>
                    <span class="font-inter font-medium hidden sm:inline">Media</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <form action="" method="POST" enctype="multipart/form-data" id="propertyForm">

                <!-- Step 1: Basic Info -->
                <div class="form-step active" data-step="1">
                    <div class="flex items-center gap-3 mb-6">
                        <i data-lucide="info" class="w-6 h-6 text-primary-color"></i>
                        <h2 class="text-2xl font-prata">Basic Information</h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="title">
                                Property Title <span class="text-red-500">*</span>
                            </label>
                            <input class="input w-full" id="title" name="title" type="text" placeholder="e.g. Modern Apartment in City Center" required>
                            <p class="text-xs text-gray-500 mt-1">Enter a descriptive title for your property</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="price">
                                    Price ($) <span class="text-red-500">*</span>
                                </label>
                                <input class="input w-full" id="price" name="price" type="number" step="0.01" min="0" placeholder="250000" required>
                                <p class="text-xs text-gray-500 mt-1">Enter the listing price</p>
                            </div>

                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="property_type">
                                    Property Type <span class="text-red-500">*</span>
                                </label>
                                <select class="input w-full" id="property_type" name="property_type" required>
                                    <option value="">Select Type</option>
                                    <option>Single Family</option>
                                    <option>Condo</option>
                                    <option>Townhouse</option>
                                    <option>Multi-Family</option>
                                    <option>Land</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" class="button-primary next-step">
                            Next <i data-lucide="arrow-right" class="w-4 h-4 inline ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Location -->
                <div class="form-step" data-step="2">
                    <div class="flex items-center gap-3 mb-6">
                        <i data-lucide="map-pin" class="w-6 h-6 text-primary-color"></i>
                        <h2 class="text-2xl font-prata">Location Details</h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="address">
                                Street Address <span class="text-red-500">*</span>
                            </label>
                            <input class="input w-full" id="address" name="address" type="text" placeholder="123 Main St" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="city">
                                    City <span class="text-red-500">*</span>
                                </label>
                                <input class="input w-full" id="city" name="city" type="text" placeholder="New York" required>
                            </div>
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="state">
                                    State/Province <span class="text-red-500">*</span>
                                </label>
                                <input class="input w-full" id="state" name="state" type="text" placeholder="NY" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="country">
                                    Country <span class="text-red-500">*</span>
                                </label>
                                <input class="input w-full" id="country" name="country" type="text" placeholder="USA" required>
                            </div>
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="zip_code">
                                    Zip/Postal Code <span class="text-red-500">*</span>
                                </label>
                                <input class="input w-full" id="zip_code" name="zip_code" type="text" placeholder="10001" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="button-secondary-outline prev-step">
                            <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i> Previous
                        </button>
                        <button type="button" class="button-primary next-step">
                            Next <i data-lucide="arrow-right" class="w-4 h-4 inline ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Features -->
                <div class="form-step" data-step="3">
                    <div class="flex items-center gap-3 mb-6">
                        <i data-lucide="home" class="w-6 h-6 text-primary-color"></i>
                        <h2 class="text-2xl font-prata">Property Features</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="bedrooms">
                                    Bedrooms
                                </label>
                                <input class="input w-full" id="bedrooms" name="bedrooms" type="number" min="0" placeholder="3">
                            </div>
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="bathrooms">
                                    Bathrooms
                                </label>
                                <input class="input w-full" id="bathrooms" name="bathrooms" type="number" step="0.5" min="0" placeholder="2.5">
                            </div>
                            <div>
                                <label class="block font-inter font-semibold text-gray-700 mb-2" for="sqft">
                                    Square Feet
                                </label>
                                <input class="input w-full" id="sqft" name="sqft" type="number" min="0" placeholder="1500">
                            </div>
                        </div>

                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="area_type">
                                Area Type
                            </label>
                            <select class="input w-full" name="area_type" id="area_type">
                                <option>Square Feet</option>
                                <option>Square Meter</option>
                                <option>Hectare</option>
                                <option>Acre</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="description">
                                Property Description
                            </label>
                            <textarea class="input w-full" id="description" name="description" rows="5" placeholder="Describe the property, its features, and what makes it special..."></textarea>
                            <p class="text-xs text-gray-500 mt-1"><span id="charCount">0</span> / 1000 characters</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="button-secondary-outline prev-step">
                            <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i> Previous
                        </button>
                        <button type="button" class="button-primary next-step">
                            Next <i data-lucide="arrow-right" class="w-4 h-4 inline ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Media -->
                <div class="form-step" data-step="4">
                    <div class="flex items-center gap-3 mb-6">
                        <i data-lucide="image" class="w-6 h-6 text-primary-color"></i>
                        <h2 class="text-2xl font-prata">Media & Location Map</h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="images">
                                Property Images <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-primary-color transition">
                                <input class="hidden" id="images" name="images[]" type="file" multiple accept="image/*" required>
                                <label for="images" class="cursor-pointer">
                                    <i data-lucide="upload" class="w-12 h-12 mx-auto mb-3 text-gray-400"></i>
                                    <p class="font-inter text-gray-600 mb-1">Click to upload images</p>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 10MB each. First image will be main photo.</p>
                                </label>
                            </div>
                            <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                        </div>

                        <div>
                            <label class="block font-inter font-semibold text-gray-700 mb-2" for="google_map_url">
                                Google Map Embed URL (Optional)
                            </label>
                            <input class="input w-full" id="google_map_url" name="google_map_url" type="url" placeholder="https://www.google.com/maps/embed?pb=...">
                            <p class="text-xs text-gray-500 mt-1">
                                <a href="https://www.google.com/maps" target="_blank" class="text-primary-color hover:underline">Get embed link from Google Maps</a>
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" class="button-secondary-outline prev-step">
                            <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i> Previous
                        </button>
                        <button type="submit" class="button-primary" id="submitBtn">
                            <i data-lucide="check" class="w-4 h-4 inline mr-1"></i> Submit Property
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <section class="container mx-auto py-10">
        <?php include "Components/footer.php"; ?>
    </section>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // Multi-step form
        let currentStep = 1;
        const totalSteps = 4;

        function showStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.querySelector(`[data-step="${step}"]`).classList.add('active');

            // Update progress
            document.querySelectorAll('.step-item').forEach((item, index) => {
                if (index < step) {
                    item.classList.add('active');
                    item.querySelector('div').classList.remove('bg-gray-200', 'text-gray-600');
                    item.querySelector('div').classList.add('bg-primary-color', 'text-white');
                } else {
                    item.classList.remove('active');
                    item.querySelector('div').classList.remove('bg-primary-color', 'text-white');
                    item.querySelector('div').classList.add('bg-gray-200', 'text-gray-600');
                }
            });

            lucide.createIcons();
        }

        // Next step
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Previous step
        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                currentStep--;
                showStep(currentStep);
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });

        // Validate current step
        function validateStep(step) {
            const currentStepEl = document.querySelector(`[data-step="${step}"]`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required]');
            let valid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('border-red-500');
                    valid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                alert('Please fill in all required fields');
            }

            return valid;
        }

        // Character counter
        const description = document.getElementById('description');
        const charCount = document.getElementById('charCount');
        description.addEventListener('input', () => {
            const count = description.value.length;
            charCount.textContent = count;
            if (count > 1000) {
                charCount.classList.add('text-red-500');
                description.value = description.value.substring(0, 1000);
            } else {
                charCount.classList.remove('text-red-500');
            }
        });

        // Image preview
        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                        ${index === 0 ? '<span class="absolute top-2 left-2 bg-primary-color text-white text-xs px-2 py-1 rounded">Main</span>' : ''}
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        // Price formatting
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value < 0) value = 0;
            e.target.value = value;
        });

        // Hide form-step by default except first
        document.querySelectorAll('.form-step').forEach((step, index) => {
            if (index !== 0) step.style.display = 'none';
        });

        // Update showStep to handle display
        const originalShowStep = showStep;
        showStep = function(step) {
            document.querySelectorAll('.form-step').forEach(s => {
                s.style.display = 'none';
                s.classList.remove('active');
            });
            const targetStep = document.querySelector(`[data-step="${step}"]`);
            targetStep.style.display = 'block';
            targetStep.classList.add('active');

            // Update progress
            document.querySelectorAll('.step-item').forEach((item, index) => {
                if (index < step) {
                    item.classList.add('active');
                    item.querySelector('div').classList.remove('bg-gray-200', 'text-gray-600');
                    item.querySelector('div').classList.add('bg-primary-color', 'text-white');
                } else {
                    item.classList.remove('active');
                    item.querySelector('div').classList.remove('bg-primary-color', 'text-white');
                    item.querySelector('div').classList.add('bg-gray-200', 'text-gray-600');
                }
            });

            lucide.createIcons();
        };
    </script>
</body>

</html>