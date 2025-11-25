<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <section class="hero-section d-flex align-items-center justify-content-center flex-column">
        <h1 class="text-primary-foreground display-2">Purchase a <span class="text-primary font-prata">Property</span></h1>
    </section>
</body>

</html>