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
    <title>Buy - <?php echo TTITLE; ?></title>
    <link rel="stylesheet" href="<?php echo STYLES_URL ?>/buy.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include COMPONENT_DIR . "/header.php"; ?>
    <main class="hero-section d-flex align-items-center justify-content-center flex-column py-5">
        <h1 class="text-primary-foreground display-2">Purchase a <span class="text-primary font-prata">Property</span>
        </h1>
        <p class="text-primary-foreground w-50 text-center ">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sed, neque accusamus omnis, necessitatibus
            commodi fuga esse cupiditate at minima soluta recusandae tempora illo labore. Reprehenderit non temporibus
            optio vel fugit numquam ratione, ea tempora saepe culpa voluptatem error deserunt corporis eum, earum odit
            aut sed a excepturi. Explicabo, omnis.
        </p>
    </main>
    <section class="min-h-100vh container py-5">
        <!-- Header Section -->
        <h1 class="display-3">
            Search Now
        </h1>
        <form action="" class="d-flex align-items-center justify-content-center gap-5">
            <div class="d-flex flex-column gap-2 align-items-center justify-content-center w-full">
                <select name="" id="" class="input">
                    <option value="" selected disabled>Select An City</option>
                    <option value="Karachi">Karachi</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Faisalabad">Faisalabad</option>
                    <option value="Rawalpindi">Rawalpindi</option>
                    <option value="Multan">Multan</option>
                </select>
                <select name="" id="" class="input">
                    <option value="" selected disabled>Select An Country</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="India">India</option>
                    <option value="China">China</option>
                    <option value="Srilanka">Srilanka</option>
                    <option value="Afganistan">Afganistan</option>
                </select>
                <select name="" id="" class="input">
                    <option value="" selected disabled>Property Type</option>
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Office">Office</option>
                    <option value="Shop">Shop</option>
                    <option value="Warehouse">Warehouse</option>
                </select>
            </div>
            <div class="d-flex flex-column gap-2 align-items-center justify-content-center w-full">
                <input type="text" class="input" placeholder="Zip / Postal Code">
                <select name="" id="" class="input">
                    <option value="" selected disabled>Price Range</option>
                    <option value="1000000">1000000</option>
                    <option value="2000000">2000000</option>
                    <option value="3000000">3000000</option>
                    <option value="4000000">4000000</option>
                    <option value="5000000">5000000</option>
                </select>
                <select name="" id="" class="input">
                    <option value="" selected disabled>Area Type</option>
                    <option value="Square Feet">Square Feet</option>
                    <option value="Square Meter">Square Meter</option>
                    <option value="Hectare">Hectare</option>
                    <option value="Acre">Acre</option>
                </select>
            </div>
            <div>
                <button class="button-secondary">Search</button>
            </div>
        </form>
        <!-- ========= -->
        <!-- Properties -->
        <div class="row mt-5">
            <?php
            foreach ($data as $items) {
                ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Card -->
                    <div class="d-flex flex-column gap-3 mb-3">
                        <img src="<?php echo $items['image']; ?>" alt=""
                            class="img-fluid object-fit-cover object-position-center">
                        <div class="d-flex py-3 gap-2 flex-column">
                            <h2 class="h3 fw-semibold"><?php echo $items['title']; ?></h2>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <small class="text-body-secondary"><?php echo $items['location']; ?></small>
                                <small class="text-body-secondary fw-bold h5"><?php echo $items['price']; ?></small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="d-flex gap-1 align-items-center justify-content-around w-full">
                                    <small class="fw-bold text-secondary-color">
                                        <i data-lucide="bed"></i>
                                        <?php echo $items['bedrooms']; ?>
                                    </small>
                                    <small class="fw-bold text-secondary-color">
                                        <i data-lucide="bath"></i>
                                        <?php echo $items['bathrooms']; ?>
                                    </small>
                                    <small class="fw-bold text-secondary-color">
                                        <i data-lucide="circle-parking"></i>
                                        <?php echo $items['garage']; ?>
                                    </small>
                                </div>
                                <div class="w-full d-flex justify-content-end">
                                    <button class="button-secondary-outline rounded-pill text-sm">View Details</button>
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
</body>

</html>