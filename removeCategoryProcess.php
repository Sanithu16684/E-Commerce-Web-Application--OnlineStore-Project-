<?php
include ("connection.php");

$cat_id = $_GET["id"];


$category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='".$cat_id."'");
$category_num = $category_rs->num_rows;



if($category_num == 0){
    echo ("Something went wrong. Please try again later.");
}else{
    $category_data = $category_rs->fetch_assoc();

    Database::iud("DELETE FROM `category` WHERE `cat_id`='".$cat_id."'");
    echo ("success");
    
}

?>