<?php
include "config.php";

if (isset($_SESSION["isLoggedIn"])) {
    session_unset();
    session_destroy();
    header("Location: " . BASE_URL);
    exit();
}

header("Location: " . BASE_URL);
exit();
