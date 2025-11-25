<nav class="fixed top-0 z-50 p-1 lg:p-3 header w-full">
    <div class="container mx-auto flex items-center justify-between">
        <a class="navbar-brand" href="#">
            <img src="<?php echo BASE_URL ?>/Images/Logo.png" class="img-fluid w-24 sm:w-56" alt="HomeXoom Logo">
        </a>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 text-secondary-color bg-white rounded-md focus:outline-none">
            <i data-lucide="menu"></i>
        </button>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center gap-8">
            <ul class="flex gap-6 m-0 p-0 list-none">
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Home</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Buy</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Sell</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Listing</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Services</a></li>
                <li><a class="nav-link text-secondary-foreground hover:text-primary-color transition-colors"
                        href="#">Our Team</a></li>
            </ul>
            <div class="flex items-center gap-3">
                <button class="button-primary">Login</button>
                <button class="button-accent">Register</button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 opacity-0"></div>

        <!-- Mobile Menu Sidebar -->
        <div id="mobile-menu"
            class="fixed top-0 right-0 h-screen w-64 bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-xl flex flex-col">
            <div class="p-4 flex justify-between items-center border-b">
                <h5 class="text-xl font-prata text-secondary-color">HomeXoom</h5>
                <button id="close-menu-btn" class="p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <div class="p-4 flex-grow overflow-y-auto">
                <ul class="flex flex-col gap-4 list-none p-0 m-0">
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Home</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Buy</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Sell</a></li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Listing</a>
                    </li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Services</a>
                    </li>
                    <li><a class="block text-secondary-color hover:text-primary-color font-inter" href="#">Our Team</a>
                    </li>
                </ul>
                <div class="mt-6 flex flex-col gap-3">
                    <button class="button-primary w-full">Login</button>
                    <button class="button-accent w-full">Register</button>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');

        function toggleMenu() {
            const isClosed = mobileMenu.classList.contains('translate-x-full');
            if (isClosed) {
                mobileMenu.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                // Small delay to allow display:block to apply before opacity transition
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