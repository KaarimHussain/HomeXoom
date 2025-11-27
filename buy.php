<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex items-center justify-center flex-col py-20">
        <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">Purchase a <span
                class="text-primary-color font-prata">Property</span>
        </h1>
        <p class="text-primary-foreground w-11/12 md:w-1/2 text-center font-inter mt-4">
            Find your dream home with our extensive listings of properties.
        </p>
    </main>
    <section class="min-h-screen container mx-auto py-20">
        <!-- Header Section -->
        <h1 class="text-4xl sm:text-6xl font-prata mb-8">
            Search Now
        </h1>
        <form action="" method="GET" class="flex flex-col md:flex-row items-center justify-center gap-8">
            <div class="flex flex-col gap-4 items-center justify-center w-full">
                <!-- <select name="city" id="city" class="input bg-transparent">
                    <option value="" selected disabled>Select An City</option>
                    <option value="Karachi">Karachi</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Faisalabad">Faisalabad</option>
                    <option value="Rawalpindi">Rawalpindi</option>
                    <option value="Multan">Multan</option>
                </select>
                <select name="country" id="country" class="input bg-transparent">
                    <option value="" selected disabled>Select An Country</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="India">India</option>
                    <option value="China">China</option>
                    <option value="Srilanka">Srilanka</option>
                    <option value="Afganistan">Afganistan</option>
                    <option value="USA">USA</option>
                </select> -->

                <div class="relative w-full">
                    <input
                        type="text"
                        name="country"
                        id="country"
                        class="input bg-transparent w-full"
                        placeholder="Type to search country..."
                        autocomplete="off">
                    <i data-lucide="search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <div id="countryDropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto"></div>
                </div>
                <!-- City Input with Autocomplete -->
                <div class="relative w-full">
                    <input
                        type="text"
                        name="city"
                        id="city"
                        class="input bg-transparent w-full"
                        placeholder="Type to search city..."
                        autocomplete="off">
                    <i data-lucide="search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <div id="cityDropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto"></div>
                </div>
                <select name="property_type" id="property_type" class="input bg-transparent">
                    <option value="" selected disabled>Property Type</option>
                    <option value="Single Family">Single Family</option>
                    <option value="Condo">Condo</option>
                    <option value="Townhouse">Townhouse</option>
                    <option value="Multi-Family">Multi-Family</option>
                    <option value="Land">Land</option>
                </select>
            </div>
            <div class="flex flex-col gap-4 items-center justify-center w-full">
                <input type="text" name="zip_code" class="input bg-transparent" placeholder="Zip / Postal Code">
                <select name="price_range" id="price_range" class="input bg-transparent">
                    <option value="" selected disabled>Max Price</option>
                    <option value="100000">100,000</option>
                    <option value="250000">250,000</option>
                    <option value="500000">500,000</option>
                    <option value="1000000">1,000,000</option>
                    <option value="5000000">5,000,000</option>
                </select>
                <select name="area_type" id="area_type" class="input bg-transparent">
                    <option value="" selected disabled>Area Type</option>
                    <option value="Square Feet">Square Feet</option>
                    <option value="Square Meter">Square Meter</option>
                    <option value="Hectare">Hectare</option>
                    <option value="Acre">Acre</option>
                </select>
            </div>
            <div>
                <button type="submit" class="button-secondary whitespace-nowrap">Search</button>
            </div>
        </form>
        <!-- ========= -->
        <!-- Properties -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            <?php
            require_once ROOT_DIR . '/Controllers/db.controller.php';
            require_once ROOT_DIR . '/Models/Property.php';

            use HomeXoom\Controllers\DBController;
            use HomeXoom\Models\Property;

            $db = new DBController();
            $db->openConnection();
            $conn = $db->getConnection();

            // Use search if filters are present, otherwise getAll
            if (!empty($_GET)) {
                $properties = Property::search($conn, $_GET);
            } else {
                $properties = Property::getAllWithActiveOwners($conn);
            }

            $db->closeConnection();

            if (empty($properties)) {
                echo '<p class="text-center col-span-3 text-gray-500">No properties found.</p>';
            } else {
                foreach ($properties as $item) {
                    $imagePath = !empty($item['image_path']) ? $item['image_path'] : 'https://via.placeholder.com/400x300?text=No+Image';
                    // Ensure image path is correct (relative to root)
                    if (strpos($imagePath, 'http') === false) {
                        $imagePath = BASE_URL . '/' . $imagePath;
                    }
            ?>
                    <div class="w-full">
                        <!-- Card -->
                        <div class="flex flex-col gap-4 mb-4">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>"
                                class="w-full h-64 object-cover object-center rounded-lg">
                            <div class="flex py-3 gap-2 flex-col">
                                <h2 class="text-2xl font-semibold font-prata truncate"><?php echo htmlspecialchars($item['title']); ?></h2>
                                <div class="flex items-center justify-between gap-2">
                                    <small class="text-gray-500 font-inter truncate"><?php echo htmlspecialchars($item['city'] . ', ' . $item['country']); ?></small>
                                    <small class="text-gray-500 font-bold text-lg font-inter">$<?php echo number_format($item['price']); ?></small>
                                </div>
                                <div class="flex items-center justify-between gap-2 mt-2">
                                    <div class="flex gap-4 items-center justify-start w-full">
                                        <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                            <i data-lucide="bed" class="w-4 h-4"></i>
                                            <?php echo $item['bedrooms']; ?>
                                        </small>
                                        <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                            <i data-lucide="bath" class="w-4 h-4"></i>
                                            <?php echo $item['bathrooms'] + 0; ?>
                                        </small>
                                        <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                            <i data-lucide="ruler" class="w-4 h-4"></i>
                                            <?php echo $item['sqft'] . ' ' . ($item['area_type'] == 'Square Feet' ? 'sqft' : $item['area_type']); ?>
                                        </small>
                                    </div>
                                    <div class="w-full flex justify-end">
                                        <a href="property-details.php?id=<?php echo $item['id']; ?>" class="button-secondary-outline rounded-full text-sm whitespace-nowrap">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- ========= -->
        <!-- CTA -->
        <?php include "Components/cta.php"; ?>
        <!-- ========= -->
        <!-- NEWS -->
        <?php include "Components/news.php"; ?>
        <!-- ========= -->
    </section>
    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>
    <script>
        lucide.createIcons();
    </script>

    <script>
        // Sample data - Replace with your API call
        const countries = [
            "Afghanistan", "Albania", "Algeria", "Argentina", "Australia", "Austria",
            "Bangladesh", "Belgium", "Brazil", "Canada", "China", "Colombia",
            "Denmark", "Egypt", "Finland", "France", "Germany", "Greece",
            "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy",
            "Japan", "Jordan", "Kenya", "South Korea", "Malaysia", "Mexico",
            "Netherlands", "New Zealand", "Nigeria", "Norway", "Pakistan",
            "Philippines", "Poland", "Portugal", "Qatar", "Russia", "Saudi Arabia",
            "Singapore", "South Africa", "Spain", "Sri Lanka", "Sweden", "Switzerland",
            "Thailand", "Turkey", "UAE", "UK", "USA", "Vietnam"
        ];

        const citiesByCountry = {
            "Pakistan": ["Karachi", "Lahore", "Islamabad", "Rawalpindi", "Faisalabad", "Multan", "Peshawar", "Quetta"],
            "USA": ["New York", "Los Angeles", "Chicago", "Houston", "Phoenix", "Philadelphia", "San Antonio"],
            "India": ["Mumbai", "Delhi", "Bangalore", "Hyderabad", "Chennai", "Kolkata", "Pune"],
            "UK": ["London", "Manchester", "Birmingham", "Leeds", "Glasgow", "Liverpool"],
            // Add more as needed
        };

        // Initialize autocomplete
        function initAutocomplete(inputId, dropdownId, dataArray) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(dropdownId);

            input.addEventListener('input', function() {
                const value = this.value.toLowerCase();

                if (value.length === 0) {
                    dropdown.classList.add('hidden');
                    return;
                }

                const filtered = dataArray.filter(item =>
                    item.toLowerCase().includes(value)
                );

                if (filtered.length === 0) {
                    dropdown.classList.add('hidden');
                    return;
                }

                dropdown.innerHTML = filtered.slice(0, 10).map(item =>
                    `<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer font-inter" onclick="selectItem('${inputId}', '${dropdownId}', '${item}')">${item}</div>`
                ).join('');

                dropdown.classList.remove('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }

        function selectItem(inputId, dropdownId, value) {
            document.getElementById(inputId).value = value;
            document.getElementById(dropdownId).classList.add('hidden');

            // If country is selected, update cities
            if (inputId === 'country') {
                const cityInput = document.getElementById('city');
                cityInput.value = '';
                cityInput.disabled = false;
                cityInput.placeholder = `Search cities in ${value}...`;
            }
        }

        // City autocomplete with country filter
        function initCityAutocomplete() {
            const cityInput = document.getElementById('city');
            const cityDropdown = document.getElementById('cityDropdown');
            const countryInput = document.getElementById('country');

            cityInput.addEventListener('input', function() {
                const value = this.value.toLowerCase();
                const selectedCountry = countryInput.value;

                if (value.length === 0 || !selectedCountry) {
                    cityDropdown.classList.add('hidden');
                    return;
                }

                const cities = citiesByCountry[selectedCountry] || [];
                const filtered = cities.filter(city =>
                    city.toLowerCase().includes(value)
                );

                if (filtered.length === 0) {
                    cityDropdown.innerHTML = '<div class="px-4 py-2 text-gray-500 font-inter text-sm">No cities found. You can still type manually.</div>';
                    cityDropdown.classList.remove('hidden');
                    return;
                }

                cityDropdown.innerHTML = filtered.map(city =>
                    `<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer font-inter" onclick="selectItem('city', 'cityDropdown', '${city}')">${city}</div>`
                ).join('');

                cityDropdown.classList.remove('hidden');
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initAutocomplete('country', 'countryDropdown', countries);
            initCityAutocomplete();
            lucide.createIcons();
        });
    </script>
</body>

</html>