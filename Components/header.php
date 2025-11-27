<nav class="fixed top-0 left-0 right-0 z-50 p-1 lg:p-3 header max-w-7xl mx-auto">
    <div class="container mx-auto px-4 flex items-center justify-between">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>">
            <img src="<?php echo BASE_URL ?>/Images/Logo.png" class="img-fluid w-30 sm:w-56" alt="HomeXoom Logo">
        </a>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 text-secondary-color bg-white rounded-md focus:outline-none">
            <i data-lucide="menu"></i>
        </button>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center gap-8">
            <ul class="flex gap-6 m-0 p-0 list-none">
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>">Home</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>/buy.php">Buy</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>/sell.php">Sell</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>/listing.php">Listing</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>/services.php">Services</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="<?php echo BASE_URL ?>/our-team.php">Our Team</a></li>
            </ul>
        </div>
        <?php
        if (!isset($_SESSION["isLoggedIn"])) {
        ?>
            <div class="hidden lg:flex items-center gap-3">
                <a href="<?php echo BASE_URL ?>/login.php">
                    <button class="button-primary">Login</button>
                </a>
                <a href="<?php echo BASE_URL ?>/register.php">
                    <button class="button-accent">Register</button>
                </a>
            </div>
        <?php
        }
        if (isset($_SESSION["isLoggedIn"])) {
        ?>
            <div class="hidden lg:flex items-center gap-3">
                <a href="<?php echo BASE_URL ?>/profile.php">
                    <button class="button-primary">Profile</button>
                </a>
                <a href="<?php echo BASE_URL ?>/logout.php">
                    <button class="button-accent">Logout</button>
                </a>
            </div>
        <?php
        }
        ?>


        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 opacity-0"></div>

        <!-- Mobile Menu Sidebar -->
        <div id="mobile-menu"
            class="fixed lg:hidden top-0 right-0 h-screen w-64 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-xl flex flex-col">
            <div class="p-4 flex justify-between items-center border-b">
                <h5 class="text-xl font-prata text-secondary-color">HomeXoom</h5>
                <button id="close-menu-btn" class="p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <div class="p-4 flex-grow overflow-y-auto">
                <ul class="flex flex-col gap-4 list-none p-0 m-0">
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>">Home</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>/buy.php">Buy</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>/sell.php">Sell</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>/listing.php">Listing</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>/services.php">Services</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter"
                            href="<?php echo BASE_URL ?>/our-team.php">Our Team</a></li>
                </ul>
                <?php
                if (!isset($_SESSION["isLoggedIn"])) {
                ?>
                    <div class="mt-6 flex flex-col gap-3">
                        <a href="<?php echo BASE_URL ?>/login.php">
                            <button class="button-primary w-full">Login</button>
                        </a>
                        <a href="<?php echo BASE_URL ?>/register.php">
                            <button class="button-accent w-full">Register</button>
                        </a>
                    </div>
                <?php
                }
                if (isset($_SESSION["isLoggedIn"])) {
                ?>
                    <div class="mt-6 flex flex-col gap-3">
                        <a href="<?php echo BASE_URL ?>/profile.php">
                            <button class="button-primary w-full">Profile</button>
                        </a>
                        <a href="<?php echo BASE_URL ?>/logout.php">
                            <button class="button-accent w-full">Logout</button>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');

        function toggleMenu() {
            const isClosed = mobileMenu.classList.contains('translate-x-full');
            if (isClosed) {
                mobileMenu.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                mobileMenu.classList.add('translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        menuBtn.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    });
</script>