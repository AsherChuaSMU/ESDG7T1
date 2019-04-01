<?php

require_once 'include/common.php';
require_once 'include/token.php';

$array_cart = json_decode($_POST['foodArr']);
$restaurant_id = $_POST['restaurant_id'];
$_SESSION['cart'] = $array_cart ;
// echo '<pre>'; print_r($foodArr); echo '</pre>';
$_SESSION['restaurant_id'] = $restaurant_id;


header("Location:add-to-cart-view.php");
?>