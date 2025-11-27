<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled - <?php echo TTITLE ?></title>
</head>

<body class="bg-gray-100 font-inter flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="x" class="text-red-600 w-8 h-8"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Cancelled</h1>
        <p class="text-gray-600 mb-6">You have cancelled the payment process. No charges were made.</p>
        <a href="realtor-dashboard.php" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition">
            Return to Dashboard
        </a>
    </div>
</body>

</html>