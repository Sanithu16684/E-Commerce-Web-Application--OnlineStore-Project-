<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Online Shop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body onload="viewCart();">
<a href="https:/wa.me/94743027842"  target="_blank" class="whatsapp_float"><i class="fa-brands fa-whatsapp fs-2 whatsapp-icon"></i></a>
    

    <div class="container-fluid">
        <div class="row">

            <?php

            include "connection.php";

            include "header.php";




            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>
                <div class="col-12 pt-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php" class="fs-3">Home</a></li>
                            <li class="breadcrumb-item active fs-3" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>



                <div class="col-12 border border-1 border-primary rounded mb-3">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label justify-content-center cheader d-flex fw-bold">Cart &nbsp;&nbsp;<i class="bi bi-cart4 text-success" style="font-size: 50px;"></i></label>
                        </div>

                        

                        <div class="col-12">
                            <hr />
                        </div>



                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <!-- <div class="col-12 emptyCart text-white"></div> -->
                                    <i class="bi bi-cart-plus col-12 text-white text-center" style="font-size: 200px;"></i>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Basket yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php
                        } else {
                        ?>


                            <section class="h-100 h-custom">
                                <div class="container py-5 h-100">
                                    <div class="row d-flex justify-content-center align-items-center h-100">
                                        <div class="col-12">
                                            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                                                <div class="card-body p-0">
                                                    <div class="row g-0">
                                                        <div class="col-lg-8">
                                                            <div class="p-5">
                                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                                    <h1 class="fw-bold mb-0 text-white">Shopping Cart</h1>

                                                                    <h6 class="mb-0 fs-5 text-muted"><?php echo $cart_num; ?> items</h6>
                                                                </div>
                                                                <hr class="my-4">

                                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                                    


                                                                    <!-- products -->
                                                                    <div class="col-12">
                                                                        <div class="row">

                                                                            <?php

                                                                            for ($x = 0; $x < $cart_num; $x++) {
                                                                                $cart_data = $cart_rs->fetch_assoc();

                                                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                                                                $product_data = $product_rs->fetch_assoc();

                                                                                $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                                                                $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                                                                                $address_data = $address_rs->fetch_assoc();

                                                                                $ship = 0;

                                                                                if ($address_data["did"] == 2) {
                                                                                    $ship = $product_data["delivery_fee_colombo"];
                                                                                    $shipping = $shipping + $ship;
                                                                                } else {
                                                                                    $ship = $product_data["delivery_fee_other"];
                                                                                    $shipping = $shipping + $ship;
                                                                                }

                                                                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                                                $seller_data = $seller_rs->fetch_assoc();
                                                                                $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                                                            ?>
                                                                                <div class="card mb-3 mx-0 col-12">
                                                                                    <div class="row g-0">
                                                                                        <div class="col-md-12 mt-3 mb-3">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <span class="fw-bold text-white-50 fs-5">Seller :</span>&nbsp;
                                                                                                    <span class="fw-bold text-white fs-5"><?php echo $seller; ?></span>&nbsp;
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <hr>

                                                                                        <div class="col-md-4">

                                                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                                                                <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                                                            </span>

                                                                                        </div>
                                                                                        <div class="col-md-5">
                                                                                            <div class="card-body">

                                                                                                <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                                                                <span class="fw-bold text-white-50">Colour :</span> &nbsp;
                                                                                                <?php
                                                                                                $cart_product_clr_rs =Database::search("SELECT * FROM `product_has_color` INNER JOIN `color` ON `product_has_color`.color_clr_id=`color`.clr_id WHERE `product_has_color`.product_id='".$product_data["id"]."';");
                                                                                                $cart_product_clr_Data =$cart_product_clr_rs->fetch_assoc();
                                                                                            
                                                                                                ?>

                                                                                                <span class="fw-bold text-white"><?php echo $cart_product_clr_Data["clr_name"]; ?></span>|

                                                                                                &nbsp; <span class="fw-bold text-white-50">Condition : Used</span>
                                                                                                <br>
                                                                                                <span class="fw-bold text-white-50 fs-5">Price :</span>&nbsp;
                                                                                                <span class="fw-bold text-white fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                                                                <br>
                                                                                                <span class="fw-bold text-white-50 fs-5">Quantity :</span>&nbsp;
                                                                                                <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" min="1" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num">
                                                                                                <br><br>
                                                                                                <span class="fw-bold text-white-50 fs-5">Delivery Fee :</span>&nbsp;
                                                                                                <span class="fw-bold text-white fs-5">Rs.<?php echo $ship; ?>.00</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <div class="card-body d-grid">
                                                                                                <a class="btn btn-outline-success mb-2" href="singleProductView.php?id=<?php echo $product_data["id"]; ?>">Buy Now</a>
                                                                                                <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                                                                            </div>
                                                                                        </div>

                                                                                        <hr>

                                                                                        <div class="col-md-12 mt-3 mb-3">
                                                                                            <div class="row">
                                                                                                <div class="col-6 col-md-6">
                                                                                                    <span class="fw-bold fs-5 text-white-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                                                                </div>
                                                                                                <div class="col-6 col-md-6 text-end">
                                                                                                    <span class="fw-bold fs-5 text-white-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php

                                                                            }

                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                    <!-- products -->


                                                                </div>

                                                                <hr class="my-4">




                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 bg-grey">
                                                            <div class="p-5">
                                                                <!-- summary -->
                                                                <div class="col-12 ">
                                                                    <div class="row">

                                                                        <div class="col-12">
                                                                            <label class="form-label fs-3 fw-bold">Summary</label>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>

                                                                        <div class="col-6 mb-3">
                                                                            <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                                                        </div>

                                                                        <div class="col-6 text-end mb-3">
                                                                            <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <span class="fs-6 fw-bold">Shipping</span>
                                                                        </div>

                                                                        <div class="col-6 text-end">
                                                                            <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                                                        </div>

                                                                        <div class="col-12 mt-3">
                                                                            <hr />
                                                                        </div>

                                                                        <div class="col-6 mt-2">
                                                                            <span class="fs-4 fw-bold">Total</span>
                                                                        </div>

                                                                        <div class="col-6 mt-2 text-end">
                                                                            <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                                                        </div>

                                                                        <div class="col-12 mt-3 mb-3 d-grid">
                                                                            <button class="btn btn-primary fs-5 fw-bold" onclick="cartCheckOut();">CHECKOUT</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- summary -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>




                        <?php
                        }

                        ?>

                    </div>
                </div>
            <?php
            } else {
                ?>
                
                <h1 class="text-center my-5 text-danger">Please Login And Try Again</h1>

                <?php
            }
            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>