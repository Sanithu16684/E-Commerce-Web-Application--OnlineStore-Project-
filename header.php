<!DOCTYPE html>

<html data-bs-theme="dark">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="collapse.css">
    <link rel="icon" href="resource/logo.svg" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class=" col-4 col-lg-1 logo" style="height: 60px;" onclick="window.location='home.php';"></div>
            <div class="col-12 col-lg-2 align-self-center mt-2">




                <?php
                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];
                ?>
                    <span class="text-lg-start text-white fs-6"><b>Welcome. Hi</b></span> |
                    <span class="text-lg-start text-info fs-5"><?php echo $data["fname"]; ?></span> |
                    <span class="text-lg-start fw-bold fs-5 signout" onclick="signout();">Signout</span>
                <?php

                } else {
                ?>
                    <a href="index.php" class="text-decoration-none fs-5 fw-bold">Sign In or Register</a> |
                <?php
                }

                ?>

            </div>

            <div class="col-lg-6 justify-content-center align-self-center">
                <div class="row mb-3" id="searchBar">



                    <div class="col-12 col-lg-6">

                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="form-select" style="max-width: 250px;" id="basic_search_select">
                                <option value="0">All Categories</option>
                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3" onclick="basicSearch(0);" style="z-index: 10;">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="advancedSearch.php" class="text-decoration-none fs-5 link-secondary fw-bold">Advanced Sort</a>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-2 align-self-end" style="text-align: end;">
                <div class="row justify-content-end">



                    <!-- dropdown -->
                    <div class="col-1 dropdown">
                        <button class="btn btn-outline-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#dropdownoffcanvase" aria-controls="dropdownoffcanvase"><i class="bi bi-list-task fs-4"></i></button>
                    </div>


                    <div class="offcanvas offcanvas-end" tabindex="-1" id="dropdownoffcanvase" aria-labelledby="dropdownoffcanvaseLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="mt-4">
                            <span class="px-5 text-center py-3"><a class="dropdown-item fs-3" href="userProfile.php">My Profile</a></span>
                            <span class="px-5 text-center py-3"><a class="dropdown-item fs-3" href="watchlist.php">Watchlist</a></span>
                            <span class="px-5 text-center py-3"><a class="dropdown-item fs-3" href="purchasingHistory.php">Purchase History</a></span>
                            </div>
                            
                        </div>
                    </div>

                    <!-- dropdown -->



                    <div class="col-1 ms-5 ms-lg-5 mt-1 " onclick="window.location='cart.php';"><i class="bi bi-cart3 fs-3"></i></div>

                </div>
            </div>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>