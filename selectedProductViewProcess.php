<?php

include("connection.php");

$id = $_GET["id"];



$selected_product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
$selected_product_data = $selected_product_rs->fetch_assoc();

$selected_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $id . "'");
$selected_img_data = $selected_img_rs->fetch_assoc();

?>


<div class="offcanvas-header">
    <h3 class="offcanvas-title text-decoration-underline" id="offcanvasExampleLabel"><?php echo $selected_product_data["title"]; ?></h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <div class="justify-content-center d-flex">
        <img src="<?php echo $selected_img_data["img_path"]; ?>" alt="">
    </div>
    <div class="mt-5 d-flex">
        <p class="fs-4">Title :</p>
        <span class="badge card-text text-white mb-1 fs-4"><?php echo $selected_product_data["title"]; ?></span><br />
    </div>
    <div class="d-flex">
        <p class="fs-4">Price :</p>
        <span class="card-text fw-bold text-white fs-4">Rs. <?php echo $selected_product_data["price"]; ?> .00</span><br />
    </div>
    <div class="d-flex">
        <p class="fs-4 text-success ">Available Stock :</p>
        <span class="card-text fw-bold text-white fs-4">&nbsp;&nbsp;<?php echo $selected_product_data["qty"]; ?> Items</span><br />
    </div>
    <div class="d-flex">
        <p class="fs-4">Discription :</p>
        <span class="card-text fw-bold text-white fs-6"><?php echo $selected_product_data["description"]; ?></span><br />
    </div>

    <div class="justify-content-center mt-5 d-flex">
        <button class="col-12 btn btn-primary fs-4" onclick="window.location='singleProductView.php?id=<?php echo $selected_product_data['id'];?>'">Buy Now &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-credit-card-2-back fs-4"></i></button>
    </div>
</div>

<?php

?>