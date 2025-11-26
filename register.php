<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/register.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <div class="hero-section">
        <div class="min-h-screen flex items-center justify-center pb-20 pt-36 px-4">
            <div class="w-full max-w-lg">
                <!-- Register Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-4xl md:text-5xl mb-3">Create Account</h2>
                        <p class="text-gray-600 font-inter">Sign up to get started with us</p>
                    </div>

                    <!-- Register Form -->
                    <form action="" method="POST" class="space-y-6">
                        <!-- User Type Selection -->
                        <div>
                            <label class="block text-sm font-medium font-inter mb-3">I want to</label>
                            <div class="grid grid-cols-2 gap-4">
                                <input checked type="radio" id="buyer" name="user_type" value="buyer"
                                    class="hidden peer/buyer" required>
                                <label for="buyer"
                                    class="flex flex-col items-center justify-center p-6 border-2 border-gray-300 rounded-lg cursor-pointer transition-all hover:border-primary-color peer-checked/buyer:border-primary-color peer-checked/buyer:bg-primary-color peer-checked/buyer:text-white">
                                    <i data-lucide="shopping-bag" class="w-8 h-8 mb-2"></i>
                                    <span class="font-inter font-semibold">Buy</span>
                                </label>

                                <input type="radio" id="seller" name="user_type" value="seller"
                                    class="hidden peer/seller">
                                <label for="seller"
                                    class="flex flex-col items-center justify-center p-6 border-2 border-gray-300 rounded-lg cursor-pointer transition-all hover:border-primary-color peer-checked/seller:border-primary-color peer-checked/seller:bg-primary-color peer-checked/seller:text-white">
                                    <i data-lucide="home" class="w-8 h-8 mb-2"></i>
                                    <span class="font-inter font-semibold">Sell</span>
                                </label>
                            </div>
                        </div>

                        <!-- Full Name Input -->
                        <div>
                            <label for="fullname" class="block text-sm font-medium font-inter mb-2">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="text" id="fullname" name="fullname" required
                                    placeholder="Enter your full name"
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium font-inter mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email" required placeholder="Enter your email"
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                            </div>
                        </div>

                        <!-- Phone Number Input -->
                        <div>
                            <label for="phone" class="block text-sm font-medium font-inter mb-2">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number"
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium font-inter mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" required
                                    placeholder="Create a password"
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                                <button type="button" id="toggle-password"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i data-lucide="eye" class="w-5 h-5 text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium font-inter mb-2">Confirm
                                Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="password" id="confirm-password" name="confirm-password" required
                                    placeholder="Confirm your password"
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                                <button type="button" id="toggle-confirm-password"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i data-lucide="eye" class="w-5 h-5 text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 mt-1 rounded border-gray-300 text-primary-color focus:ring-primary-color">
                            <label for="terms" class="ml-2 block text-sm font-inter text-gray-700">
                                I agree to the <a href="#"
                                    class="text-primary-color hover:text-secondary-color transition-colors">Terms and
                                    Conditions</a> and <a href="#"
                                    class="text-primary-color hover:text-secondary-color transition-colors">Privacy
                                    Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="button-primary w-full">
                            Create Account
                        </button>
                    </form>


                    <!-- Sign In Link -->
                    <p class="mt-8 text-center text-sm font-inter text-gray-600">
                        Already have an account?
                        <a href="<?php echo BASE_URL ?>/login.php"
                            class="font-medium text-primary-color hover:text-secondary-color transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // Toggle Password Visibility
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        });

        // Toggle Confirm Password Visibility
        document.getElementById('toggle-confirm-password').addEventListener('click', function () {
            const confirmPasswordInput = document.getElementById('confirm-password');
            const icon = this.querySelector('i');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                confirmPasswordInput.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        });

        // Password Match Validation
        document.querySelector('form').addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>

</html>