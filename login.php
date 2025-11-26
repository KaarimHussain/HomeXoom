<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/login.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>

    <div class="hero-section">
        <div class="min-h-screen flex items-center justify-center py-20 px-4">
            <div class="w-full max-w-lg">
                <!-- Login Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-4xl md:text-5xl mb-3">Welcome Back</h2>
                        <p class="text-gray-600 font-inter">Sign in to your account to continue</p>
                    </div>

                    <!-- Login Form -->
                    <form action="" method="POST" class="space-y-6">
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

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium font-inter mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" required
                                    placeholder="Enter your password" c
                                    class="input pl-10 w-full h-12 outline-none border-b border-zinc-900 focus:border-primary-color">
                                <button type="button" id="toggle-password"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i data-lucide="eye" class="w-5 h-5 text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-primary-color focus:ring-primary-color">
                                <label for="remember-me" class="ml-2 block text-sm font-inter text-gray-700">
                                    Remember me
                                </label>
                            </div>
                            <div>
                                <a href="<?php echo BASE_URL ?>/forgot-password.php"
                                    class="text-sm font-inter text-primary-color hover:text-secondary-color transition-colors">
                                    Forgot password?
                                </a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="button-primary w-full">
                            Sign In
                        </button>
                    </form>

                    <!-- Sign Up Link -->
                    <p class="mt-8 text-center text-sm font-inter text-gray-600">
                        Don't have an account?
                        <a href="<?php echo BASE_URL ?>/register.php"
                            class="font-medium text-primary-color hover:text-secondary-color transition-colors">
                            Sign up now
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
    </script>
</body>

</html>