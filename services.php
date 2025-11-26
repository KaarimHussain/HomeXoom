<?php
include "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/services.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex items-center py-20">
        <div class="container flex flex-col items-start justify-center">
            <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">
                Our <span class="text-primary-color font-prata">Services</span>
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
    <!-- SERVICES SECTIONS -->
    <section class="min-h-screen container">

        <!-- Section 1: Our Team -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-5xl sm:text-6xl mb-6">Our Team</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident
                    </p>
                    <button class="button-secondary">BECOME A MEMBER</button>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800" alt="Modern Property"
                        class="w-full h-[500px] object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </section>

        <!-- Section 2: A Boutique Lifestyle -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800" alt="Classic Property"
                        class="w-full h-[500px] object-cover rounded-lg shadow-lg">
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-5xl sm:text-6xl mb-6">A Boutique Lifestyle</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident
                    </p>
                    <button class="button-secondary">BECOME A MEMBER</button>
                </div>
            </div>
        </section>

        <!-- Section 3: Results -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-5xl sm:text-6xl mb-6">Results</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident
                    </p>
                    <button class="button-secondary">BECOME A MEMBER</button>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800"
                        alt="Charming Property" class="w-full h-[500px] object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </section>

        <!-- Section 4: Blogs -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800" alt="Luxury Property"
                        class="w-full h-[500px] object-cover rounded-lg shadow-lg">
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-5xl sm:text-6xl mb-6">Blogs</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident
                    </p>
                    <button class="button-secondary">BECOME A MEMBER</button>
                </div>
            </div>
        </section>

        <!-- Section 5: Looking to Buy or Sell a Home? (CTA Section) -->
        <section class="py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-sm font-inter text-gray-500 uppercase tracking-wider mb-4">NEVER SETTLE</p>
                    <h2 class="text-5xl sm:text-6xl mb-6">Looking to Buy or Sell a Home?</h2>
                    <p class="text-gray-600 font-inter mb-8 leading-relaxed">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident
                    </p>

                    <!-- Feature List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-6 h-6 rounded-full border-2 border-current flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <p class="text-gray-600 font-inter">At vero eos et accusamus et iusto</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <button class="button-secondary-outline">LEARN MORE</button>
                        <button class="button-secondary">BECOME A MEMBER</button>
                    </div>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800"
                        alt="Modern Architecture" class="w-full h-[600px] object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </section>

        <!-- CTA -->
        <?php include "Components/cta.php"; ?>
    </section>

    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>
</body>

</html>