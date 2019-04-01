<?php

require_once 'include/common.php';
require_once 'include/token.php';


if(isset($_SESSION['cart'])){
    $foodArr = $_SESSION['cart'];
    // Replace this serviceURL to yours
    $serviceURL = "http://SMUImage:8081/orders";
// // Service invocation via GET
    $json = file_get_contents($serviceURL);

// // parsing the String in JSON format to objects so we can manipulate it by
// // looping etc
    $data = json_decode($json, TRUE);
    $order_list = $data['Order'];
    $order_id = 0;

    if(sizeof($order_list) > 0){
        $order_id = $order_list[sizeof($order_list)-1]['order_id'] +1; //assign new order_id
    }
    // echo($order_id);
    $customer_id =  $_SESSION['user'];
    // echo($customer_id);
    $driver_id = "NOT ASSIGNED YET";
    $status = 0;
    $_SESSION['order_list'] = array();

    foreach($foodArr as $food_id => $quantity){
    array_push($_SESSION['order_list'],array("order_id"=>$order_id,"customer_id"=>$customer_id,"food_id"=>$food_id, 
    "restaurant_id"=>$_SESSION['restaurant_id'],"driver_id"=>$driver_id,"status"=>$status,"quantity"=>$quantity));
    // echo "\$foodArr[$k] => $v.\n";
}

}else{
    $foodArr = null;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap libraries -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous"> -->

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
        <script src="get_value_of_input_box.js"></script>
</head>

<body>
<?php include 'include/header.php' ; ?>
<h1>Order Confirmation</h1>
    <div class="col-md-6">
    <form id ="form" method="post" action ="add-to-order.php">
        <table id="foodTable" class='table table-striped' id='food-list' border='1'>
            <tr>
                <th>No. </th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
         <?php 
         if($foodArr != null){
            $serviceURL = "http://SMUImage:8080/restaurants/".$_SESSION['restaurant_id'];
            $json = file_get_contents($serviceURL);
            $data = json_decode($json, TRUE);
            $food_list = $data['Food'];
            // $food_name = $food_list[0]['name'];
            // echo ($food_name);
            $total_price = 0;
            foreach($_SESSION['order_list'] as $k => $v){
                foreach($food_list as $index => $food){
                    if ($v['food_id'] == $food['food_id']){
                       echo "<tr><td>".($k+1)."</td>".
                                "<td>".$food['name']."</td>".
                                "<td>".$food['price']."</td>".
                                "<td>".$v['quantity']."</td></tr>";
                        $total_price += $food['price'] * $v['quantity'];
                    }
                }
            
            }
             
        }
        
        ?>
        </table>
        <!-- <input type='hidden' class= "order_List" id='orderArr' name="orderArr" value="<?php echo base64_encode(serialize($order_list))?>" > -->
        <?php
        if($foodArr == null){
            echo "<h2> No items in cart!! </h2>";
        }else{
           echo " <h4>Total: $". $total_price. "</h4>
                    <input type='submit' value='Confirm & Pay'> ";

        }
        ?>
        
        </form>

</body>


