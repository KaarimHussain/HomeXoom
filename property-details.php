<?php
include "config.php";
require_once ROOT_DIR . '/Controllers/db.controller.php';
require_once ROOT_DIR . '/Models/Property.php';

use HomeXoom\Controllers\DBController;
use HomeXoom\Models\Property;

// Get property ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: buy.php");
    exit();
}

$db = new DBController();
$db->openConnection();
$conn = $db->getConnection();

$propertyId = $_GET['id'];
$property = Property::getById($conn, $propertyId);

if (!$property) {
    $db->closeConnection();
    header("Location: buy.php");
    exit();
}

// Get all images for this property
$images = Property::getImages($conn, $propertyId);

$db->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($property['title']); ?> - <?php echo TTITLE ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body class="bg-gray-50">
    <?php include COMPONENT_DIR . "/header.php"; ?>

    <main class="pt-32 pb-20">
        <div class="container mx-auto px-4">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-sm font-inter text-gray-600 mb-6">
                <a href="index.php" class="hover:text-primary-color transition">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
                <a href="buy.php" class="hover:text-primary-color transition">Properties</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
                <span class="text-text-color font-medium"><?php echo htmlspecialchars($property['title']); ?></span>
            </nav>

            <!-- Image Gallery -->
            <div class="mb-8">
                <?php
                $primaryImage = null;
                $otherImages = [];

                if (!empty($images)) {
                    foreach ($images as $img) {
                        if ($img['is_primary']) {
                            $primaryImage = $img;
                        } else {
                            $otherImages[] = $img;
                        }
                    }
                    if (!$primaryImage && !empty($images)) {
                        $primaryImage = $images[0];
                    }
                }

                $imagePath = $primaryImage ? $primaryImage['image_path'] : 'https://via.placeholder.com/1200x600?text=No+Image';
                if (strpos($imagePath, 'http') === false) {
                    $imagePath = BASE_URL . '/' . $imagePath;
                }
                ?>

                <div class="relative group">
                    <img id="mainImage" src="<?php echo htmlspecialchars($imagePath); ?>"
                        alt="<?php echo htmlspecialchars($property['title']); ?>"
                        class="w-full h-[600px] object-cover rounded-2xl shadow-2xl">

                    <!-- Image counter -->
                    <div class="absolute top-4 right-4 bg-black/70 text-white px-4 py-2 rounded-lg font-inter text-sm">
                        <i data-lucide="image" class="w-4 h-4 inline mr-1"></i>
                        <?php echo count($images); ?> Photos
                    </div>
                </div>

                <?php if (!empty($otherImages)): ?>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-4">
                        <!-- Primary image thumbnail -->
                        <div class="relative cursor-pointer group" onclick="changeMainImage('<?php echo htmlspecialchars($imagePath); ?>')">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                alt="Main Image"
                                class="w-full h-32 object-cover rounded-lg border-2 border-primary-color">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition rounded-lg"></div>
                        </div>

                        <!-- Other images -->
                        <?php foreach (array_slice($otherImages, 0, 5) as $img):
                            $imgPath = $img['image_path'];
                            if (strpos($imgPath, 'http') === false) {
                                $imgPath = BASE_URL . '/' . $imgPath;
                            }
                        ?>
                            <div class="relative cursor-pointer group" onclick="changeMainImage('<?php echo htmlspecialchars($imgPath); ?>')">
                                <img src="<?php echo htmlspecialchars($imgPath); ?>"
                                    alt="Property Image"
                                    class="w-full h-32 object-cover rounded-lg border-2 border-transparent hover:border-primary-color transition">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition rounded-lg"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Property Header -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h1 class="text-4xl md:text-5xl font-prata mb-3"><?php echo htmlspecialchars($property['title']); ?></h1>
                                <!-- Location Display Section -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-primary-color/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="map-pin" class="w-5 h-5 text-primary-color"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-500 font-inter mb-1 uppercase tracking-wide">Location</p>
                                            <div class="space-y-1">
                                                <p class="font-semibold text-gray-900 font-inter">
                                                    <?php echo htmlspecialchars($property['address']); ?>
                                                </p>
                                                <p class="text-sm text-gray-600 font-inter">
                                                    <?php echo htmlspecialchars($property['city'] . ', ' . $property['state'] . ' ' . $property['zip_code']); ?>
                                                </p>
                                                <p class="text-sm text-gray-500 font-inter">
                                                    <?php echo htmlspecialchars($property['country']); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <a href="<?php echo !empty($property['google_map_url']) ? '#location-map' : 'https://www.google.com/maps/search/?api=1&query=' . urlencode($property['address'] . ', ' . $property['city'] . ', ' . $property['state']); ?>"
                                            class="text-primary-color hover:text-secondary-color transition text-sm font-inter font-semibold flex items-center gap-1 whitespace-nowrap">
                                            View Map
                                            <i data-lucide="external-link" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 font-inter mb-1">Price</p>
                                <p class="text-4xl font-bold text-primary-color font-prata">$<?php echo number_format($property['price']); ?></p>
                            </div>
                        </div>

                        <!-- Key Features -->
                        <div class="grid grid-cols-3 gap-6 py-6 border-y">
                            <div class="text-center">
                                <div class="w-14 h-14 bg-primary-color/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i data-lucide="bed" class="w-7 h-7 text-primary-color"></i>
                                </div>
                                <p class="text-2xl font-prata mb-1"><?php echo $property['bedrooms']; ?></p>
                                <p class="text-sm text-gray-600 font-inter">Bedrooms</p>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-secondary-color/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i data-lucide="bath" class="w-7 h-7 text-secondary-color"></i>
                                </div>
                                <p class="text-2xl font-prata mb-1"><?php echo $property['bathrooms'] + 0; ?></p>
                                <p class="text-sm text-gray-600 font-inter">Bathrooms</p>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-primary-color/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i data-lucide="ruler" class="w-7 h-7 text-primary-color"></i>
                                </div>
                                <p class="text-2xl font-prata mb-1"><?php echo number_format($property['sqft']); ?></p>
                                <p class="text-sm text-gray-600 font-inter"><?php echo $property['area_type']; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-6">
                        <h2 class="text-3xl font-prata mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-6 h-6 text-primary-color"></i>
                            Description
                        </h2>
                        <p class="text-gray-700 font-inter leading-relaxed whitespace-pre-line">
                            <?php echo htmlspecialchars($property['description']); ?>
                        </p>
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white rounded-xl shadow-md p-8 mb-6">
                        <h2 class="text-3xl font-prata mb-6 flex items-center gap-2">
                            <i data-lucide="list" class="w-6 h-6 text-primary-color"></i>
                            Property Details
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary-color/10 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="hash" class="w-6 h-6 text-primary-color"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-inter">Property ID</p>
                                    <p class="font-semibold font-inter">#<?php echo $property['id']; ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-secondary-color/10 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="home" class="w-6 h-6 text-secondary-color"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-inter">Property Type</p>
                                    <p class="font-semibold font-inter"><?php echo htmlspecialchars($property['property_type']); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary-color/10 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="map" class="w-6 h-6 text-primary-color"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-inter">City</p>
                                    <p class="font-semibold font-inter"><?php echo htmlspecialchars($property['city']); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-secondary-color/10 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="flag" class="w-6 h-6 text-secondary-color"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-inter">Country</p>
                                    <p class="font-semibold font-inter"><?php echo htmlspecialchars($property['country']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <?php if (!empty($property['google_map_url'])): ?>
                        <div id="location-map" class="bg-white rounded-xl shadow-md p-8">
                            <h2 class="text-3xl font-prata mb-6 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-6 h-6 text-primary-color"></i>
                                Location
                            </h2>
                            <div class="w-full h-96 rounded-lg overflow-hidden">
                                <iframe
                                    src="<?php echo htmlspecialchars($property['google_map_url']); ?>"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <!-- Agent Card -->
                        <div class="text-center mb-6 pb-6 border-b">
                            <div class="w-20 h-20 bg-gradient-to-br from-primary-color to-secondary-color rounded-full mx-auto mb-3 flex items-center justify-center">
                                <i data-lucide="user" class="w-10 h-10 text-white"></i>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3 mb-6">
                                <button id="openContactModal" class="w-full button-primary">
                                    <i data-lucide="phone" class="w-4 h-4 inline-block mr-2"></i>
                                    Contact Now
                                </button>
                            </div>

                            <!-- Quick Info -->
                            <div class="pt-6 border-t">
                                <h3 class="font-prata text-lg mb-4">Quick Info</h3>
                                <div class="space-y-3 text-sm font-inter">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Listed</span>
                                        <span class="font-semibold"><?php echo date('M d, Y', strtotime($property['created_at'])); ?></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Zip Code</span>
                                        <span class="font-semibold"><?php echo htmlspecialchars($property['zip_code']); ?></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Area Type</span>
                                        <span class="font-semibold"><?php echo htmlspecialchars($property['area_type']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <section class="container mx-auto py-10">
        <?php include "Components/footer.php"; ?>
    </section>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary-color to-secondary-color p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-prata text-white">Contact Agent</h3>
                    <button id="closeModal" class="text-white hover:text-gray-200 transition">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p class="text-white/90 text-sm font-inter mt-2">Fill in your details and we'll get back to you soon</p>
            </div>

            <!-- Modal Body -->
            <form id="contactForm" class="p-6">
                <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">

                <div class="space-y-4">
                    <div>
                        <label class="block font-inter font-semibold text-gray-700 mb-2" for="contact_name">
                            Your Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="contact_name" name="name" required
                            class="input w-full" placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block font-inter font-semibold text-gray-700 mb-2" for="contact_email">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="contact_email" name="email" required
                            class="input w-full" placeholder="john@example.com">
                    </div>

                    <div>
                        <label class="block font-inter font-semibold text-gray-700 mb-2" for="contact_phone">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="contact_phone" name="phone" required
                            class="input w-full" placeholder="+1 (555) 123-4567">
                    </div>

                    <div>
                        <label class="block font-inter font-semibold text-gray-700 mb-2" for="contact_message">
                            Message (Optional)
                        </label>
                        <textarea id="contact_message" name="message" rows="4"
                            class="input w-full" placeholder="I'm interested in this property..."></textarea>
                    </div>
                </div>

                <!-- Alert Message -->
                <div id="formAlert" class="hidden mt-4 p-4 rounded-lg"></div>

                <!-- Submit Button -->
                <div class="mt-6 flex gap-3">
                    <button type="button" id="cancelBtn" class="flex-1 button-secondary-outline">
                        Cancel
                    </button>
                    <button type="submit" id="submitContactBtn" class="flex-1 button-primary">
                        <span id="btnText">Send Message</span>
                        <span id="btnLoader" class="hidden">
                            <i data-lucide="loader" class="w-4 h-4 inline animate-spin"></i> Sending...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('contactModal');
        const openBtn = document.getElementById('openContactModal');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const contactForm = document.getElementById('contactForm');
        const formAlert = document.getElementById('formAlert');
        const submitBtn = document.getElementById('submitContactBtn');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');

        // Open modal
        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        });

        // Close modal
        function closeModal() {
            modal.style.display = 'none';
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            contactForm.reset();
            formAlert.classList.add('hidden');
        }

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Close on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // Form submission
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Show loading state
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            formAlert.classList.add('hidden');

            try {
                const formData = new FormData(contactForm);
                const response = await fetch('send-inquiry.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                // Show alert
                formAlert.classList.remove('hidden');
                if (result.success) {
                    formAlert.className = 'mt-4 p-4 rounded-lg bg-green-50 border-l-4 border-green-500';
                    formAlert.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            <p class="font-inter text-green-700">${result.message}</p>
                        </div>
                    `;
                    lucide.createIcons();

                    // Close modal after 2 seconds
                    setTimeout(() => {
                        closeModal();
                    }, 2000);
                } else {
                    formAlert.className = 'mt-4 p-4 rounded-lg bg-red-50 border-l-4 border-red-500';
                    formAlert.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                            <p class="font-inter text-red-700">${result.message}</p>
                        </div>
                    `;
                    lucide.createIcons();
                }
            } catch (error) {
                formAlert.classList.remove('hidden');
                formAlert.className = 'mt-4 p-4 rounded-lg bg-red-50 border-l-4 border-red-500';
                formAlert.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                        <p class="font-inter text-red-700">An error occurred. Please try again.</p>
                    </div>
                `;
                lucide.createIcons();
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // Change main image when clicking thumbnails
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = imageSrc;
                mainImage.style.opacity = '1';
            }, 200);
        }

        // Add smooth transition to main image
        document.getElementById('mainImage').style.transition = 'opacity 0.3s ease';
    </script>
</body>

</html>