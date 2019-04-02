<!DOCTYPE html>
<?php

// require_once 'include/session.php';
require_once 'include/common.php';

$serviceURL = $_SESSION['url'].":8080/restaurants1/".$_SESSION['user'];
// // Service invocation via GET
    $json = file_get_contents($serviceURL);

// // parsing the String in JSON format to objects so we can manipulate it by
// // looping etc
    $data = json_decode($json, TRUE);

    $restaurant_id = $data['restaurant_id'];


?>
<html lang="en">
 
<head>
  <!-- HEAD
  This is where you put your jQuery, Bootstrap JS library imports
-->
<title>Alan Xpress</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <style>
    .container{
      background-color: rgb(240, 238, 238);
      margin-top: 50px;
      margin-bottom: 50px;
    }
    
    .panel-heading{
    color: rgb(25, 25, 255);
  }

  
  </style>

</head>

<body style="background-color:#FBEEE6;">
  <!-- BODY
  This is where you put your html presentation code and Bootstrap JS related
  tags, markups, etc
-->
<?php include 'include/header-owner.php' ; ?>
<h1>Order History</h1>
    <div class="col-md-6">
        <table id="restaurantsTable" class='table table-striped' id='restaurant-list' border='1'>
            <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Food ID</th>
                <th>Quantity</th>
                <th>Driver</th>
                <th>Status</th>
            </tr>
        </table>
    </div>

  <script>
  
  $(document).ready(function(){
     // Change serviceURL to your own
     var serviceURL = "<?php echo $_SESSION['url']?>:8081/orders4/<?php echo $restaurant_id ?>";
        var rows = "";
        $.get(serviceURL, function (data) {
            var orderList = data.Order; //the arr is in data.Order of the JSON

            if (orderList == undefined) { // did not manage to call service
                $('#restaurantsTable').empty();
                $('body').append("<label>There is a problem retrieving restaurants data, please try again later.</label>");
            }

            // for loop to setup each table row with obtained book data
            for (var i = 0; i < orderList.length; i++) {
                var order_status = 'Order has not been picked up';
                if(orderList[i].status == 1){
                  order_status = "Someone picked up the order and is on the way!"
                }else if(orderList[i].status == 2){
                  order_status = "Order has been delivered!"
                }
                eachRow =
                    "<td>" + (i+1) + "</td>" +
                    "<td>" + orderList[i].customer_id + "</td>" +
                    "<td>" + orderList[i].food_id + "</td>" +
                    "<td>" + orderList[i].quantity + "</td>" +
                    "<td>" + orderList[i].driver_id + "</td>" +
                    "<td>" + order_status + "</td>";
                    // "<td><a href='edit-restaurant.php?restaurant_id=" + restaurantList[i].restaurant_id + "&restaurant_name=" + restaurantList[i].name +"'>" +
                    // "View</a>";

                rows += "<tr>" + eachRow + "</tr>";
            }
            $('#restaurantsTable').append(rows);
        }) // $.get
            .fail(function () {
                $('#restaurantsTable').empty();
                $('body').append("<label>There is a problem retrieving restaurant  data, please try again later.</label>");
            })

});
</script>
</body>

</html>