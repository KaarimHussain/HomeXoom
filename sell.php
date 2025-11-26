<?php
include "config.php";

// Temporary Data
$data =
    [
        [
            "id" => 1,
            "image" => "https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-10-3.png",
            "title" => "Lake Club Drive",
            "location" => "1220 LAKE CLUB DRIVE Greensboro",
            "price" => "$6,495,000",
            "bedrooms" => 5,
            "bathrooms" => 3,
            "garage" => 2,
        ],
        [
            "id" => 1,
            "image" => "https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-10-3.png",
            "title" => "Lake Club Drive",
            "location" => "1220 LAKE CLUB DRIVE Greensboro",
            "price" => "$6,495,000",
            "bedrooms" => 5,
            "bathrooms" => 3,
            "garage" => 2,
        ],
        [
            "id" => 1,
            "image" => "https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-10-3.png",
            "title" => "Lake Club Drive",
            "location" => "1220 LAKE CLUB DRIVE Greensboro",
            "price" => "$6,495,000",
            "bedrooms" => 5,
            "bathrooms" => 3,
            "garage" => 2,
        ],
        [
            "id" => 1,
            "image" => "https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-10-3.png",
            "title" => "Lake Club Drive",
            "location" => "1220 LAKE CLUB DRIVE Greensboro",
            "price" => "$6,495,000",
            "bedrooms" => 5,
            "bathrooms" => 3,
            "garage" => 2,
        ],
        [
            "id" => 1,
            "image" => "https://homexoom.initialdraftdemo.com/wp-content/uploads/2025/11/Rectangle-10-3.png",
            "title" => "Lake Club Drive",
            "location" => "1220 LAKE CLUB DRIVE Greensboro",
            "price" => "$6,495,000",
            "bedrooms" => 5,
            "bathrooms" => 3,
            "garage" => 2,
        ],
    ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section flex items-center justify-center flex-col py-20">
        <h1 class="text-primary-foreground text-5xl sm:text-7xl font-prata">Sell a <span
                class="text-primary-color font-prata">Property</span>
        </h1>
        <p class="text-primary-foreground w-11/12 md:w-1/2 text-center font-inter mt-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sed, neque accusamus omnis, necessitatibus
            commodi fuga esse cupiditate at minima soluta recusandae tempora illo labore. Reprehenderit non temporibus
            optio vel fugit numquam ratione, ea tempora saepe culpa voluptatem error deserunt corporis eum, earum odit
            aut sed a excepturi. Explicabo, omnis.
        </p>
    </main>
    <section class="min-h-screen container mx-auto py-20">
        <!-- Header Section -->
        <h1 class="text-4xl sm:text-6xl font-prata mb-8">
            Search Now
        </h1>
        <form class="flex flex-col md:flex-row items-center justify-center gap-8">
            <div class="flex flex-col gap-4 items-center justify-center w-full">
                <select name="" id="" class="input bg-transparent">
                    <option value="" selected disabled>Select An City</option>
                    <option value="Karachi">Karachi</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Faisalabad">Faisalabad</option>
                    <option value="Rawalpindi">Rawalpindi</option>
                    <option value="Multan">Multan</option>
                </select>
                <select name="" id="" class="input bg-transparent">
                    <option value="" selected disabled>Select An Country</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="India">India</option>
                    <option value="China">China</option>
                    <option value="Srilanka">Srilanka</option>
                    <option value="Afganistan">Afganistan</option>
                </select>
                <select name="" id="" class="input bg-transparent">
                    <option value="" selected disabled>Property Type</option>
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Office">Office</option>
                    <option value="Shop">Shop</option>
                    <option value="Warehouse">Warehouse</option>
                </select>
            </div>
            <div class="flex flex-col gap-4 items-center justify-center w-full">
                <input type="text" class="input bg-transparent" placeholder="Zip / Postal Code">
                <select name="" id="" class="input bg-transparent">
                    <option value="" selected disabled>Price Range</option>
                    <option value="1000000">1000000</option>
                    <option value="2000000">2000000</option>
                    <option value="3000000">3000000</option>
                    <option value="4000000">4000000</option>
                    <option value="5000000">5000000</option>
                </select>
                <select name="" id="" class="input bg-transparent">
                    <option value="" selected disabled>Area Type</option>
                    <option value="Square Feet">Square Feet</option>
                    <option value="Square Meter">Square Meter</option>
                    <option value="Hectare">Hectare</option>
                    <option value="Acre">Acre</option>
                </select>
            </div>
            <div>
                <button class="button-secondary whitespace-nowrap">Search</button>
            </div>
        </form>
        <!-- ========= -->
        <!-- Properties -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            <?php
            foreach ($data as $items) {
                ?>
                <div class="w-full">
                    <!-- Card -->
                    <div class="flex flex-col gap-4 mb-4">
                        <img src="<?php echo $items['image']; ?>" alt=""
                            class="w-full h-64 object-cover object-center rounded-lg">
                        <div class="flex py-3 gap-2 flex-col">
                            <h2 class="text-2xl font-semibold font-prata"><?php echo $items['title']; ?></h2>
                            <div class="flex items-center justify-between gap-2">
                                <small class="text-gray-500 font-inter"><?php echo $items['location']; ?></small>
                                <small
                                    class="text-gray-500 font-bold text-lg font-inter"><?php echo $items['price']; ?></small>
                            </div>
                            <div class="flex items-center justify-between gap-2 mt-2">
                                <div class="flex gap-4 items-center justify-start w-full">
                                    <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                        <i data-lucide="bed" class="w-4 h-4"></i>
                                        <?php echo $items['bedrooms']; ?>
                                    </small>
                                    <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                        <i data-lucide="bath" class="w-4 h-4"></i>
                                        <?php echo $items['bathrooms']; ?>
                                    </small>
                                    <small class="font-bold text-secondary-color flex items-center gap-1 font-inter">
                                        <i data-lucide="circle-parking" class="w-4 h-4"></i>
                                        <?php echo $items['garage']; ?>
                                    </small>
                                </div>
                                <div class="w-full flex justify-end">
                                    <button class="button-secondary-outline rounded-full text-sm whitespace-nowrap">View
                                        Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
        <!-- ========= -->
        <!-- CTA -->
        <?php include "Components/cta.php"; ?>
        <!-- ========= -->
        <!-- NEWS -->
        <?php include "Components/news.php"; ?>
        <!-- ========= -->
    </section>
    <section class="container mx-auto py-10">
        <!-- FOOTER -->
        <?php include "Components/footer.php"; ?>
    </section>
</body>

</html>