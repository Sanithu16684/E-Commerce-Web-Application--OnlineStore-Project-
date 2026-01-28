<?php

include "connection.php";

?>

<!DOCTYPE html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Online Store</title>

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    
<a href="https:/wa.me/94743027842"  target="_blank" class="whatsapp_float"><i class="fa-brands fa-whatsapp fs-2 whatsapp-icon"></i></a>
    <div class="container-fluid">
<div class="box3">
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        <div class="row">
        


            <?php include "header.php"; ?>
            <?php include "img_slider.php"; ?>



                              
                   

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    

                    <?php
                    $category_rs2 = Database::search("SELECT * FROM `category`");
                    $category_num2 = $category_rs2->num_rows;

                    for ($y = 0; $y < $category_num2; $y++) {
                        $category_data2 = $category_rs2->fetch_assoc();
                    ?>
                        <!-- Category Name -->

                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $category_data2["cat_name"]; ?>" aria-expanded="false" aria-controls="<?php echo $category_data2["cat_name"]; ?>">
                                        <?php echo $category_data2["cat_name"]; ?>
                                    </button>
                                </h2>
                                <div id="<?php echo $category_data2["cat_name"]; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12">
                                            <div class="row justify-content-center gap-2">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                    AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                                $product_num = $product_rs->num_rows;

                                                for ($z = 0; $z < $product_num; $z++) {
                                                    $product_data = $product_rs->fetch_assoc();

                                                ?>



                                                    <section class="col-lg-2 section01" onclick="window.location='singleProductView.php?id=<?php echo $product_data['id'];?>'">
                                                        <div class="cd-grid">
                                                            <a class="cd" href="#">
                                                                <?php
                                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                $img_data = $img_rs->fetch_assoc();
                                                                ?>
                                                                <img src="<?php echo $img_data["img_path"]; ?>" class="cd-backg w-100 h-100" />
                                                                <div class="cd-content">
                                                                    <h3 class="cd-heding"><?php echo $product_data["title"]; ?></h3>
                                                                    <p class="cd-cat">Rs. <?php echo $product_data["price"]; ?>.00</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </section>

                                                <?php
                                                }

                                                ?>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!-- products -->
                    <?php
                    }

                    ?>




                </div>
            </div>


            <?php include "footer.php"; ?>

        </div>
    </div>



    <script>
        AOS.init();
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>