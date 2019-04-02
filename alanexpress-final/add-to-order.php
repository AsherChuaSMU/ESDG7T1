<?php
// $order_list = unserialize(base64_decode($_POST['orderArr']));
require_once 'include/common.php';
require_once 'include/protect.php';

include 'stripephp/charge.php';

$order_list = $_SESSION['order_list'];
$restaurant_id = $_SESSION['restaurant_id'];



unset($_SESSION["cart"]);
unset($_SESSION["restaurant_id"]);
// Replace this serviceURL to yours
$serviceURL = $_SESSION['url'].":8081/orders1";

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap libraries -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" -->
        <!-- crossorigin="anonymous"> -->

    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
        <script src="get_value_of_input_box.js"></script>
</head>

<body>
<?php include 'include/header.php' ; ?>
<h1>Order Confirmed</h1>
    <div class="col-md-6">
    <form id ="form" method="post" action ="list-view-restaurant.php">
        <table id="foodTable" class='table table-striped' id='food-list' border='1'>
            <tr>
                <th>No. </th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
         <?php 
         $serviceURL = $_SESSION['url'].":8080/restaurants/".$restaurant_id;
         $json = file_get_contents($serviceURL);
         $data = json_decode($json, TRUE);
         $food_list = $data['Food'];
         // $food_name = $food_list[0]['name'];
         // echo ($food_name);
         $total_price = 0;
         foreach($order_list as $k => $v){
             foreach($food_list as $index => $food){
                 if ($v['food_id'] == $food['food_id']){
                    echo "<tr><td>".($k+1)."</td>".
                             "<td>".$food['name']."</td>".
                             "<td>".$food['price']."</td>".
                             "<td>".$v['quantity']."</td></tr>";
                     $total_price += $food['price'] * $v['quantity'];
                 }
             }
         
         }?>
        </table>
         
        <h4>Total: $ <?php echo $total_price ?></h4>

         <h2>Thank you for purchasing! Your order is on the way!</h2> 
         <input type="submit" value="Back to Home"> 
        </form>
<script>
$(document).ready(function(){
    var order_list = <?php echo json_encode($order_list); ?>;
    $.ajaxSetup({
        headers:{
            'Content-Type':"application/json"
        }
    });
    for(var i=0; i<order_list.length; i++){
        
        $.post( "<?php echo $_SESSION['url']?>:8081/orders1",
            JSON.stringify(
            {
                "order_id": order_list[i]['order_id'],
                "customer_id": ""+order_list[i]['customer_id']+"",
                "food_id": order_list[i]['food_id'],
                "restaurant_id": order_list[i]['restaurant_id'],
                "driver_id": order_list[i]['driver_id'],
                "status": order_list[i]['status'],
                "quantity": order_list[i]['quantity']
            }) 
            );
    // ,function(data, status){
    //     alert ("Data: "+data+ "\nStatus: "+status);
    // }
    // );
    }
});


</script>


</body>
