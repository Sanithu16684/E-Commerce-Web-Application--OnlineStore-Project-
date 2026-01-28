<?php

include "connection.php";

$id = $_GET["id"];

if(!isset($_GET["id"])){
    echo "Somthing Went Wrong Try Again";
}else{
    $order_rs = Database::search("SELECT * FROM `invoice` WHERE `invoice_id`='".$id."'");
    $order_data = $order_rs->fetch_assoc();
    if($order_data['status']=="0"){
        Database::iud("UPDATE `invoice` SET `status`='1' WHERE `invoice_id`='".$id."'");
    }else{
        Database::iud("UPDATE `invoice` SET `status`='0' WHERE `invoice_id`='".$id."'") ;
    }
    echo "success";
    
}

?>