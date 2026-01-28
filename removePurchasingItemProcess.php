<?php

include "connection.php";

$list_id = $_GET["id"];


$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `invoice_id`='".$list_id."'");
$invoice_num = $invoice_rs->num_rows;


if($invoice_num == 0){
    echo ("Something went wrong. Please try again later.");
}else{
    $invoice_data = $invoice_rs->fetch_assoc();

    Database::iud("DELETE FROM `invoice` WHERE `invoice_id`='".$list_id."'");
    echo ("success");
}

?>