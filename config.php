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
?>

<!-- Global elements and styling -->
<link rel="stylesheet" href="<?php echo STYLES_URL ?>/base.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="<?php echo STYLES_URL ?>/header.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="<?php echo BASE_URL ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="<?php echo BASE_URL ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--  -->