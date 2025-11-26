<?php
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/index.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex justify-center items-center flex-col py-20">
        <div class="flex flex-col items-start justify-center gap-7 container">
            <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">Find a home <br>
                that suits <br>
                your
                <span class="text-primary-color  font-prata">Property</span>
            </h1>
            <p class="text-primary-foreground w-11/12 md:w-1/2 font-inter mt-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sed, neque accusamus omnis,
                necessitatibus
                commodi fuga esse cupiditate at minima soluta recusandae tempora illo labore. Reprehenderit non
                temporibus
                optio vel fugit numquam ratione, ea tempora saepe culpa voluptatem error deserunt corporis eum, earum
                odit
                aut sed a excepturi. Explicabo, omnis.
            </p>
            <div>
                <button class="button-primary">BECOME A MEMBER</button>
                <button class="button-secondary">REFER US</button>
            </div>
        </div>
    </main>

    <section class="pt-20 container pb-20">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-8 mb-12">
            <div>
                <p class="text-sm font-inter text-secondary-color uppercase tracking-wider mb-4">COMMUNITIES</p>
                <h2 class="text-5xl sm:text-6xl">
                    Exclusive Access
                    <br>
                    to Local Experts
                </h2>
            </div>
            <div class="lg:text-right">
                <p class="text-gray-600 font-inter mb-6 max-w-md">
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et
                </p>
            </div>
        </div>
        </div>
        <!-- PROPERTY TYPES SECTION -->
        <section class="py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"> <!-- Family House -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4"> <img
                            src="https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-4.png"
                            alt="Family House"
                            class="w-full h-[450px] object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl mb-1">FAMILY HOUSE</h3>
                            <p class="text-gray-600 font-inter text-sm">Start From $375K</p>
                        </div> <a href="#"
                            class="w-12 h-12 rounded-full border-2 border-current flex items-center justify-center hover:bg-primary-color hover:text-white hover:border-primary-color transition-all">
                            <i data-lucide="arrow-right" class="w-5 h-5"></i> </a>
                    </div>
                </div> <!-- Apartment -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4"> <img
                            src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800" alt="Apartment"
                            class="w-full h-[450px] object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl mb-1">APARTMENT</h3>
                            <p class="text-gray-600 font-inter text-sm">Start From $375K</p>
                        </div> <a href="#"
                            class="w-12 h-12 rounded-full border-2 border-current flex items-center justify-center hover:bg-primary-color hover:text-white hover:border-primary-color transition-all">
                            <i data-lucide="arrow-right" class="w-5 h-5"></i> </a>
                    </div>
                </div> <!-- Guest House -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4"> <img
                            src="https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-6-1.png"
                            alt="Guest House"
                            class="w-full h-[450px] object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl mb-1">GUEST HOUSE</h3>
                            <p class="text-gray-600 font-inter text-sm">Start From $375K</p>
                        </div> <a href="#"
                            class="w-12 h-12 rounded-full border-2 border-current flex items-center justify-center hover:bg-primary-color hover:text-white hover:border-primary-color transition-all">
                            <i data-lucide="arrow-right" class="w-5 h-5"></i> </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA SECTION - Looking to Buy or Sell a Home -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"> <!-- Left Content -->
                <div>
                    <div class="flex items-center mb-7">
                        <div>
                            <p class="text-sm font-inter text-secondary-color uppercase tracking-wider mb-4">NEVER
                                SETTLE</p>
                        </div>
                    </div>
                    <h2 class="text-5xl sm:text-6xl mb-6">Looking to Buy or Sell a Home?</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed"> At vero eos et accusamus et iusto odio
                        dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores
                        et quas molestias excepturi sint occaecati cupiditate non provident </p> <!-- Feature List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                    </div> <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4"> <button class="button-secondary-outline">LEARN MORE</button>
                        <button class="button-secondary">BECOME A MEMBER</button>
                    </div>
                </div> <!-- Right Image -->
                <div> <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800"
                        alt="Modern Architecture" class="w-full h-[500px] object-cover rounded-lg shadow-lg"> </div>
            </div>
        </section>

        <!-- STATS COUNTER SECTION -->
        <section class="py-20 border-t border-b border-gray-300">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8"> <!-- Stat 1 -->
                <div class="text-center">
                    <h3 class="text-5xl sm:text-6xl lg:text-7xl mb-3" data-target="20000">0</h3>
                    <p class="text-gray-600 font-inter text-sm uppercase tracking-wider">SATISFIED CLIENTS</p>
                </div> <!-- Stat 2 -->
                <div class="text-center">
                    <h3 class="text-5xl sm:text-6xl lg:text-7xl mb-3" data-target="30000">0</h3>
                    <p class="text-gray-600 font-inter text-sm uppercase tracking-wider">REAL ESTATE SALES</p>
                </div> <!-- Stat 3 -->
                <div class="text-center">
                    <h3 class="text-5xl sm:text-6xl lg:text-7xl mb-3" data-target="99">0</h3>
                    <p class="text-gray-600 font-inter text-sm uppercase tracking-wider">CLIENT SATISFACTION</p>
                </div> <!-- Stat 4 -->
                <div class="text-center">
                    <h3 class="text-5xl sm:text-6xl lg:text-7xl mb-3" data-target="10">0</h3>
                    <p class="text-gray-600 font-inter text-sm uppercase tracking-wider">WORK EXPERIENCE</p>
                </div>
            </div>
        </section>

        <!-- PROPERTY LISTINGS SECTION -->
        <section class="py-20">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-8 mb-12">
                <div>
                    <p class="text-sm font-inter text-secondary-color uppercase tracking-wider mb-4">PROPERTIES</p>
                    <h2 class="text-5xl sm:text-6xl">Find Home Listing<br>in Your Area</h2>
                </div>
                <div class="lg:text-right">
                    <p class="text-gray-600 font-inter mb-6 max-w-md">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et
                    </p>
                    <button class="button-secondary-outline">EXPLORE MORE</button>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap gap-4 mb-12">
                <button
                    class="px-6 py-3 rounded-full bg-secondary-color text-white font-inter text-sm font-semibold uppercase transition-all hover:bg-opacity-90">
                    APARTMENT
                </button>
                <button
                    class="px-6 py-3 rounded-full border-2 border-secondary-color text-secondary-color font-inter text-sm font-semibold uppercase transition-all hover:bg-secondary-color hover:text-white">
                    FAMILY HOUSE
                </button>
                <button
                    class="px-6 py-3 rounded-full border-2 border-secondary-color text-secondary-color font-inter text-sm font-semibold uppercase transition-all hover:bg-secondary-color hover:text-white">
                    COMMERCIAL BUILDING
                </button>
            </div>

            <!-- Property Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Property Card 1 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800"
                            alt="Lake Club Drive"
                            class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-2xl mb-2">Lake Club Drive</h3>
                    <p class="text-gray-600 font-inter text-sm mb-3">1220 LAKE CLUB DRIVE Greensboro</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-800 font-inter font-semibold text-lg">$6,495,000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-4 text-sm font-inter text-gray-600">
                            <span class="flex items-center gap-1">
                                <i data-lucide="bed" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="bath" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="warehouse" class="w-4 h-4"></i>
                                1-3
                            </span>
                        </div>
                        <button class="button-secondary-outline rounded-full text-sm px-6 whitespace-nowrap">
                            VIEW PROPERTY
                        </button>
                    </div>
                </div>

                <!-- Property Card 2 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800"
                            alt="Lake Club Drive"
                            class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-2xl mb-2">Lake Club Drive</h3>
                    <p class="text-gray-600 font-inter text-sm mb-3">1220 LAKE CLUB DRIVE Greensboro</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-800 font-inter font-semibold text-lg">$6,495,000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-4 text-sm font-inter text-gray-600">
                            <span class="flex items-center gap-1">
                                <i data-lucide="bed" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="bath" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="warehouse" class="w-4 h-4"></i>
                                1-3
                            </span>
                        </div>
                        <button class="button-secondary-outline rounded-full text-sm px-6 whitespace-nowrap">
                            VIEW PROPERTY
                        </button>
                    </div>
                </div>

                <!-- Property Card 3 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800"
                            alt="Lake Club Drive"
                            class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="text-2xl mb-2">Lake Club Drive</h3>
                    <p class="text-gray-600 font-inter text-sm mb-3">1220 LAKE CLUB DRIVE Greensboro</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-800 font-inter font-semibold text-lg">$6,495,000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex gap-4 text-sm font-inter text-gray-600">
                            <span class="flex items-center gap-1">
                                <i data-lucide="bed" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="bath" class="w-4 h-4"></i>
                                1-3
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="warehouse" class="w-4 h-4"></i>
                                1-3
                            </span>
                        </div>
                        <button class="button-secondary-outline rounded-full text-sm px-6 whitespace-nowrap">
                            VIEW PROPERTY
                        </button>
                    </div>
                </div>

            </div>
        </section>


        <!-- JOBS SERVICES SECTION -->
        <section class="py-20">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-5xl sm:text-6xl">View Best<br>Jobs Services</h2>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Service 1: Air Sealing -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1581094271901-8022df4466f9?w=800" alt="Air Sealing"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Air Sealing</h3>
                    </div>
                </div>

                <!-- Service 2: Arborist / Tree Service -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800"
                        alt="Arborist / Tree Service"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Arborist / Tree Service</h3>
                    </div>
                </div>

                <!-- Service 3: Interior Designer -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800"
                        alt="Interior Designer"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Interior Designer</h3>
                    </div>
                </div>

                <!-- Service 4: Concrete and Masonry -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800"
                        alt="Concrete and Masonry"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Concrete and Masonry</h3>
                    </div>
                </div>

                <!-- Service 5: Countertops -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1556912172-45b7abe8b7e1?w=800" alt="Countertops"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Countertops</h3>
                    </div>
                </div>

                <!-- Service 6: Fences / Decks -->
                <div class="group relative overflow-hidden rounded-lg h-96">
                    <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800" alt="Fences / Decks"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-white text-3xl font-prata">Fences / Decks</h3>
                    </div>
                </div>

            </div>
        </section>


        <!-- NEWS SECTION -->
        <section class="py-20">
            <div class="mb-12">
                <p class="text-sm font-inter text-secondary-color uppercase tracking-wider mb-4">THE NEWS</p>
                <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-8">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-prata leading-tight">
                        News about us<br>
                        and our activities
                    </h2>
                    <div class="lg:text-left">
                        <p class="text-gray-600 font-inter mb-6 max-w-md">
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum
                            deleniti atque corrupti quos dolores et
                        </p>
                        <button class="button-secondary-outline rounded-full">EXPLORE MORE</button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Large Featured News Item -->
                <div class="relative group">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800"
                        alt="Featured Property" class="w-full h-[500px] object-cover rounded-lg">

                    <div class="absolute bottom-6 left-6 bg-white rounded-full px-4 py-2 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Adam+Smiths&background=random" alt="Author"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-xs text-primary-color font-semibold font-inter uppercase">Robigan News</p>
                            <p class="text-xs text-gray-600 font-inter">Adam Smiths</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column with Stacked News Items -->
                <div class="flex flex-col gap-8">
                    <!-- News Item 1 -->
                    <div class="flex gap-6">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400"
                            alt="Property News" class="w-64 h-48 object-cover rounded-lg flex-shrink-0">
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-primary-color font-semibold font-inter uppercase mb-2">Robigan News
                            </p>
                            <h3 class="text-2xl font-prata mb-3">Lorem Ipsum dolor sit amets</h3>
                            <p class="text-gray-600 font-inter text-sm">
                                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                voluptatum
                                deleniti atque
                            </p>
                        </div>
                    </div>

                    <!-- News Item 2 -->
                    <div class="flex gap-6">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400"
                            alt="Property News" class="w-64 h-48 object-cover rounded-lg flex-shrink-0">
                        <div class="flex flex-col justify-center">
                            <p class="text-xs text-primary-color font-semibold font-inter uppercase mb-2">Robigan News
                            </p>
                            <h3 class="text-2xl font-prata mb-3">Lorem Ipsum dolor sit amets</h3>
                            <p class="text-gray-600 font-inter text-sm">
                                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                                voluptatum
                                deleniti atque
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Featured News -->
            <div class="mt-8 flex flex-col md:flex-row gap-6">
                <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=600" alt="Property News"
                    class="w-full md:w-1/2 h-64 object-cover rounded-lg">
                <div class="flex flex-col justify-center md:w-1/2">
                    <p class="text-xs text-primary-color font-semibold font-inter uppercase mb-2">Robigan News</p>
                    <h3 class="text-3xl font-prata mb-4">Lorem Ipsum dolor sit amets</h3>
                    <p class="text-gray-600 font-inter">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque
                    </p>
                </div>
            </div>
        </section>


    </section>


    <script>
        // Counter Animation
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const increment = target / 100;
            const duration = 2000; // 2 seconds
            const stepTime = duration / 100;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }

                // Format number with K suffix if >= 1000
                let displayValue;
                if (target >= 1000) {
                    displayValue = Math.floor(current / 1000) + 'K';
                } else if (suffix === '%') {
                    displayValue = Math.floor(current) + '%';
                } else if (suffix === '+') {
                    displayValue = Math.floor(current) + '+';
                } else {
                    displayValue = Math.floor(current);
                }

                element.textContent = displayValue;
            }, stepTime);
        }

        // Intersection Observer to trigger animation when in view
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    const counters = entry.target.querySelectorAll('[data-target]');

                    counters.forEach((counter, index) => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        let suffix = '';

                        // Determine suffix based on label
                        const label = counter.nextElementSibling.textContent;
                        if (label.includes('SATISFACTION')) {
                            suffix = '%';
                        } else if (label.includes('EXPERIENCE')) {
                            suffix = '+';
                        }

                        setTimeout(() => {
                            animateCounter(counter, target, suffix);
                        }, index * 100);
                    });
                }
            });
        }, observerOptions);

        // Observe the stats section
        document.addEventListener('DOMContentLoaded', () => {
            const statsSection = document.querySelector('[data-target]').closest('section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            const filterButtons = document.querySelectorAll('[class*="rounded-full"]').forEach(btn => {
                if (btn.textContent.includes('APARTMENT') || btn.textContent.includes('FAMILY HOUSE') || btn.textContent.includes('COMMERCIAL BUILDING')) {
                    btn.addEventListener('click', function () {
                        // Remove active state from all buttons
                        this.parentElement.querySelectorAll('button').forEach(b => {
                            b.classList.remove('bg-secondary-color', 'text-white');
                            b.classList.add('border-2', 'border-secondary-color', 'text-secondary-color');
                        });

                        // Add active state to clicked button
                        this.classList.add('bg-secondary-color', 'text-white');
                        this.classList.remove('border-2', 'border-secondary-color', 'text-secondary-color');
                    });
                }
            });
        });
    </script>

</body>

</html>