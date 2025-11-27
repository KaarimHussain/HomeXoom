<?php
// ===============================
// GLOBAL CONFIGURATION
// ===============================

// Website title (use anywhere)

define("TTITLE", "HOMEXOOM - THE GATEWAY TO BUY, SELL, BID OR RENT");

// Base URL (public path)
define("BASE_URL", "http://localhost/HomeXoom");

// Root directory (local filesystem path)
define("ROOT_DIR", __DIR__);

// Public asset URLs
define("STYLES_URL", BASE_URL . "/Styles");
define("JS_URL", BASE_URL . "/js");
define("COMPONENT_URL", BASE_URL . "/Components");

// Directories (local paths)
define("STYLES_DIR", ROOT_DIR . "/Styles");
define("JS_DIR", ROOT_DIR . "/js");
define("COMPONENT_DIR", ROOT_DIR . "/Components");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Load Composer Autoloader
require_once __DIR__ . '/vendor/autoload.php';

require_once ROOT_DIR . '/Helpers/SubscriptionExpiryHelper.php';

use HomeXoom\Helpers\SubscriptionExpiryHelper;

SubscriptionExpiryHelper::autoCheck();

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Stripe Configuration
define("STRIPE_SECRET_KEY", $_ENV['STRIPE_SECRET_KEY'] ?? '');
define("STRIPE_PUBLISHABLE_KEY", $_ENV['STRIPE_PUBLISHABLE_KEY'] ?? '');
define("STRIPE_WEBHOOK_SECRET", $_ENV['STRIPE_WEBHOOK_SECRET'] ?? '');
define("STRIPE_PRICE_ID", $_ENV['STRIPE_PRICE_ID'] ?? '');
?>

<!-- Global elements and styling -->
<link rel="stylesheet" href="<?php echo STYLES_URL ?>/base.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="<?php echo STYLES_URL ?>/header.css?v=<?php echo time(); ?>">
<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary-color': 'var(--primary-color)',
                    'secondary-color': 'var(--secondary-color)',
                    'primary-foreground': 'var(--primary-foreground)',
                    'secondary-foreground': 'var(--secondary-foreground)',
                    'text-color': 'var(--text-color)',
                    'bg-primary': 'var(--bg-primary)',
                    'bg-secondary': 'var(--bg-secondary)',
                },
                fontFamily: {
                    'inter': ['Inter', 'sans-serif'],
                    'prata': ['Prata', 'serif'],
                }
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();
    });
</script>