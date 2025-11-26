<?php
include "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Teams - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/our-teams.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex items-center py-20">
        <div class="container flex flex-col items-start justify-center">
            <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">
                Our <span class="text-primary-color font-prata">Teams</span>
            </h1>
            <p class="text-primary-foreground w-11/12 md:w-1/2 font-inter mt-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sed, neque accusamus omnis,
                necessitatibus
                commodi fuga esse cupiditate at minima soluta recusandae tempora illo labore. Reprehenderit non
                temporibus
                optio vel fugit numquam ratione, ea tempora saepe culpa voluptatem error deserunt corporis eum, earum
                odit
                aut sed a excepturi. Explicabo, omnis.
            </p>
        </div>
    </main>
    <!-- OUR TEAM SECTION -->
    <section class="py-20 container min-h-screen mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Team Member 1 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">C.E.O</p>
            </div>

            <!-- Team Member 2 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">D.M</p>
            </div>

            <!-- Team Member 3 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">G.M</p>
            </div>

            <!-- Team Member 4 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">MANAGER</p>
            </div>

            <!-- Team Member 5 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">SALES DIRECTOR</p>
            </div>

            <!-- Team Member 6 -->
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400" alt="John Doe"
                    class="w-full h-96 object-cover mb-4">
                <h3 class="text-2xl mb-1">JOHN DOE</h3>
                <p class="text-gray-600 font-inter text-sm">AGENT</p>
            </div>

        </div>

        <!-- CTA -->
        <?php include "Components/cta.php"; ?>
    </section>

    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>
</body>

</html>