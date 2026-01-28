<?php
session_start();
require "connection.php";


if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];
    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $uemail . "'");
    $address_rs_num = $address_rs->num_rows;

    $total = 0;
    $subTotal = 0;
    $shipping = 0;

    $cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON `cart`.`product_id`=`product`.`id` WHERE `cart`.`user_email`='" . $uemail . "'");
    $cart_num = $cart_rs->num_rows;

    $address_data = $address_rs->fetch_assoc();
    $address = $address_data["line1"] . "," . $address_data["line2"];
    $city_id = $address_data["city_city_id"];

    $district_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $city_id . "'");
    $district_data = $district_rs->fetch_assoc();
    $district_id = $district_data["district_district_id"];

    for ($x = 0; $x < $cart_num; $x++) {

        $cart_data = $cart_rs->fetch_assoc();

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();

        $total = $total + ($product_data["price"] * $cart_data["qty"]);

        $ship = 0;

        if ($district_id == 9) {
            $ship = $product_data["delivery_fee_colombo"];
            $shipping = $shipping + $product_data["delivery_fee_colombo"];
        } else {
            $ship = $product_data["delivery_fee_other"];
            $shipping = $shipping + $product_data["delivery_fee_other"];
        }
    }

    $array;

    $order_id = uniqid();
    $item = "Cart Items";
    $amount = ((int)$total) + (int)$shipping;

    $fname = $_SESSION["u"]["fname"];
    $lname = $_SESSION["u"]["lname"];
    $mobile = $_SESSION["u"]["mobile"];
    $uaddress = $address;
    $city = $district_data["city_name"];

    $merchant_id = "1225572";
        $merchant_secret = "Mzc3ODY1Mzk2NjIwMDQwNjQ2NzEyODQxOTMzNDExOTI0MjEyMTkw";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );
    
    $array["id"] = $order_id;
    $array["item"] = $item;
    $array["amount"] = $amount;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["mobile"] = $mobile;
    $array["address"] = $uaddress;
    $array["city"] = $city;
    $array["umail"] = $uemail;
    $array["mid"] = $merchant_id;
    $array["msecret"] = $merchant_secret;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    echo json_encode($array);
} else {
    echo ("1");
}
