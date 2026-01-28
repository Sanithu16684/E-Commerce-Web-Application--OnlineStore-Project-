<?php
include "connection.php";

include "header.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.warrenty,
    product.status_status_id,product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM 
    `product` INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id INNER JOIN 
    `brand` ON brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
    model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Single Product View - Online Shop</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
            <link rel="icon" href="resource/logo.svg" />
        </head>

        <body>


            <div class="container-fluid">
                <div class="row justify-content-center d-flex">
                    <!-- headerr Text -->
                    <p class="fs-1 text-primary mt-2 fw-bold text-center">Single Product View</p>
                    <hr>

                    <?php
                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                    $image_num = $image_rs->num_rows;

                    $image_data = $image_rs->fetch_assoc();

                    ?>

                    <div class="col-lg-4 text-start">
                        <div class="card text-bg-dark">
                            <img src="<?php echo $image_data["img_path"]; ?>" id="mainImg"
                                style="filter: brightness(50%) sepia(100);" class="card-img" alt="product image">
                            <div class="card-img-overlay d-flex align-self-end">
                                <div class="row">

                                    <?php
                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                    $image_num = $image_rs->num_rows;


                                    if ($image_num != 0) {
                                        for ($x = 0; $x < $image_num; $x++) {
                                            $image_data = $image_rs->fetch_assoc();

                                    ?>
                                            <div class="col-4">
                                                <img src="<?php echo $image_data["img_path"]; ?>" id="productImg<?php echo $image_data['product_id']; ?>" onclick="loadMainImg('<?php echo $image_data['img_path']; ?>');"
                                                    class="img-fluid border border-secondary-subtle border-5 rounded-4"
                                                    style="object-fit: cover; object-position: center;" alt="">
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <p class="text-success-emphasis fw-bold fs-3 text-center">Product Title</p>
                        <div class="border border-1"></div>
                        <p class="fs-2 mb-3 mt-3"> <?php echo $product_data["title"]; ?> </p>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="text-success-emphasis">Warranty : <span class="text-white fw-semibold"> <?php echo $product_data['warrenty'];?></span></p>
                            </div>
                            <div class="col-lg-4">
                                <p class="text-success-emphasis">Available Quantity : <span class="text-white fw-semibold"> <?php echo $product_data["qty"]; ?> Items</span></p>
                            </div>

                            <?php

                            $price = $product_data["price"];
                            $adding_price = ($price / 100) * 10;
                            $new_price = $price + $adding_price;
                            $difference = $new_price - $price;

                            ?>
                            <div class="col-lg-4">
                                <p class="text-success-emphasis">Price : <span class="text-white fw-semibold">Rs.
                                        <?php echo $price; ?> .00</span></p>
                            </div>
                            <div class="col-lg-3">
                                <p class="text-success-emphasis">Discount : <span class="text-white fw-semibold">Save Rs. <?php echo $difference; ?> .00 (10%)</span></p>
                            </div>
                        </div>
                        <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                            <div class="col-12">
                                <span>Quantity : </span>
                                <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text"
                                    class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1"
                                    id="qty_input" />

                                <div class="position-absolute qty-buttons">
                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                        <i class="bi bi-caret-up-fill text-primary fs-5"
                                            onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                    </div>
                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                        <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php
                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                            $seller_data = $seller_rs->fetch_assoc();
                            ?>
                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                <span class="fs-5 text-primary"><b>Seller : </b><?php echo $seller_data["fname"]; ?></span>
                            </div>
                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                <span class="fs-5 text-primary"><b>Sold : </b>100 Items</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row p-0">
                            <div class="col-lg-3 col-12">
                                <button class="btn btn-success" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                <button class="btn btn-primary" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                <?php

                                if (isset($_SESSION["u"])) {

                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' 
                                                                                        AND `product_id`='" . $product_data["id"] . "'");
                                    $watchlist_num = $watchlist_rs->num_rows;

                                    if ($watchlist_num == 1) {
                                        $watchlist_data = $watchlist_rs->fetch_assoc();
                                ?>
                                        <button class="px-5 btn btn-outline-info  border border-primary" onclick='removeFromWatchlist(<?php echo $watchlist_data["w_id"]; ?>);'>
                                            <i class="bi bi-heart-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="px-5 btn btn-outline-info border border-primary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                            <i class="bi bi-heart-fill text-white fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                        </button>
                                <?php
                                    }
                                }

                                ?>
                            </div>

                        </div>
                        <h1 class="my-4 text-decoration-underline">feedback</h1>
                        <div class="col-12 ">

                            <div class="row border border-1 border-dark rounded overflow-scroll me-0">

                                <?php

                                $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON 
                                feedback.user_email=user.email WHERE `product_id`='" . $pid . "'");

                                $feedback_num = $feedback_rs->num_rows;

                                for ($y = 0; $y < $feedback_num; $y++) {
                                    $feedback_data = $feedback_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 mt-1 mb-1 mx-1">
                                        <div class="row border border-1 border-dark rounded me-0">

                                            <div class="col-10 mt-1 mb-1 ms-0"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></div>
                                            <div class="col-2 mt-1 mb-1 me-0">

                                                <?php

                                                if ($feedback_data["type"] == 1) {
                                                ?><span class="badge bg-success">Positive</span><?php
                                                                                                } else if ($feedback_data["type"] == 2) {
                                                                                                    ?><span class="badge bg-warning">Neutral</span><?php
                                                                                                } else if ($feedback_data["type"] == 3) {
                                                                                                    ?><span class="badge bg-danger">Negative</span><?php
                                                                                                }

                                                                                                    ?>

                                            </div>

                                            <div class="col-12">
                                                <b><?php echo $feedback_data["feed"]; ?></b>
                                            </div>
                                            <div class="offset-6 col-6 text-end">
                                                <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php

                                }

                                ?>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="bootstrap.js"></script>
            <script src="script.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the inconvenience.Please try again later.");
    }
} else {
    echo ("Something Went Wrong.");
}
