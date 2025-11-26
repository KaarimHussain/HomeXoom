<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/forgot-password.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <div class="hero-section">
        <div class="min-h-screen flex items-center justify-center py-20 px-4">
            <div class="w-full max-w-lg">
                <!-- Forgot Password Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div
                            class="mx-auto w-16 h-16 bg-primary-color rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="key" class="w-8 h-8 text-white"></i>
                        </div>
                        <h2 class="text-4xl md:text-5xl mb-3">Forgot Password?</h2>
                        <p class="text-gray-600 font-inter">No worries! Enter your email and we'll send you reset
                            instructions</p>
                    </div>

                    <!-- Forgot Password Form -->
                    <form action="" method="POST" class="space-y-6" id="forgot-password-form">
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
                            <p class="mt-2 text-xs text-gray-500 font-inter">
                                We'll send a password reset link to this email
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="button-primary w-full">
                            Send Reset Link
                        </button>

                        <!-- Back to Login -->
                        <div class="text-center">
                            <a href="<?php echo BASE_URL ?>/login.php"
                                class="inline-flex items-center gap-2 text-sm font-inter text-primary-color hover:text-secondary-color transition-colors">
                                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                                Back to Login
                            </a>
                        </div>
                    </form>

                    <!-- Success Message (Hidden by default) -->
                    <div id="success-message" class="hidden mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="text-sm font-semibold text-green-800 font-inter mb-1">Email Sent!</h4>
                                <p class="text-sm text-green-700 font-inter">
                                    Check your inbox for password reset instructions. Don't forget to check your spam
                                    folder.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Help Text -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-semibold font-inter mb-2 flex items-center gap-2">
                            <i data-lucide="help-circle" class="w-4 h-4 text-gray-600"></i>
                            Need Help?
                        </h4>
                        <p class="text-xs text-gray-600 font-inter mb-2">
                            If you don't receive an email within a few minutes:
                        </p>
                        <ul class="text-xs text-gray-600 font-inter space-y-1 ml-4 list-disc">
                            <li>Check your spam or junk folder</li>
                            <li>Make sure you entered the correct email</li>
                            <li>Contact our support team for assistance</li>
                        </ul>
                    </div>
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

        // Handle form submission
        document.getElementById('forgot-password-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const submitButton = this.querySelector('button[type="submit"]');
            const successMessage = document.getElementById('success-message');

            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i data-lucide="loader" class="w-5 h-5 inline animate-spin mr-2"></i>Sending...';
            lucide.createIcons();

            // Simulate API call (replace with actual API call)
            setTimeout(() => {
                // Hide form
                this.classList.add('hidden');

                // Show success message
                successMessage.classList.remove('hidden');
                lucide.createIcons();

                // Reset button (in case form is shown again)
                submitButton.disabled = false;
                submitButton.textContent = 'Send Reset Link';
            }, 1500);
        });
    </script>
</body>

</html>