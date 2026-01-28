<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Online Shop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body onload="viewCart();">
<a href="https:/wa.me/94743027842"  target="_blank" class="whatsapp_float"><i class="fa-brands fa-whatsapp fs-2 whatsapp-icon"></i></a>

    <div class="container-fluid">
        <div class="row">

            <?php 
            include "connection.php";
            include "header.php";


            if (isset($_SESSION["u"])) {

                $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
                watchlist.product_id=product.id INNER JOIN `product_has_color` ON 
                product_has_color.product_id=product.id INNER JOIN `color` ON 
                product_has_color.color_clr_id=color.clr_id INNER JOIN `condition` ON 
                product.condition_condition_id=condition.condition_id INNER JOIN `user` ON 
                product.user_email=user.email WHERE watchlist.user_email='" . $_SESSION["u"]["email"] . "'");

                $watchlist_num = $watchlist_rs->num_rows;

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-primary rounded mb-2">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label justify-content-center wheader d-flex fs-1 fw-bolder">Watchlist &hearts;</label>
                                </div>


                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                                    <nav aria-label="breadcrumb ">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item mt-lg-3"><a href="home.php" class="fs-4">Home</a></li>
                                            <li class="breadcrumb-item active fs-1" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active fs-4" aria-current="page" href="#">My Watchlist</a>
                                    </nav>
                                </div>

                                <?php

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <!-- <div class="col-12 emptyView"></div> -->
                                            <i class="bi bi-bookmark-heart col-12 text-white text-center" style="font-size: 250px;"></i>
                                            <div class="col-12 text-center">
                                                <label class="form-label title08 fs-1 fw-bold" style="text-transform: capitalize;">You have no items in your Favourites
                                                    yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $list_id = $watchlist_data["w_id"];
                                            ?>

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12" onclick="window.location='singleProductView.php?id=<?php echo $watchlist_data['product_id'];?>'">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <?php


                                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">

                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $watchlist_data["title"]; ?></h5>

                                                                <span class="fs-5 fw-bold text-white-50">Colour : <?php echo $watchlist_data["clr_name"]; ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;

                                                                <span class="fs-5 fw-bold text-white-50">Condition : <?php echo $watchlist_data["condition_name"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-white-50">Rs. <?php echo $watchlist_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white-50">Quantity
                                                                    :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-white-50"><?php echo $watchlist_data["qty"]; ?> Items available</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white-50">Seller :</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white-50">
                                                                    <?php echo $watchlist_data["fname"] . " " . $watchlist_data["lname"]; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                
                                                                <a href="#" class="btn btn-outline-warning mb-2" onclick='addToCartWachlist(<?php echo $watchlist_data["product_id"]; ?>);'>Add to Cart</a>
                                                                <a href="#" class="btn btn-outline-danger" 
                                                                onclick='removeFromWatchlist(<?php echo $list_id; ?>);'>
                                                                    Remove
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- have products -->
                                <?php
                                }

                                ?>
                            </div>
                        </div>
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
</body>

</html>