<!DOCTYPE html>
<?php

// require_once 'include/session.php';
require_once 'include/common.php';

$user_id = $_SESSION['user'];


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
<h1>Restaurant Listing</h1>
    <div class="col-md-6">
        <table id="restaurantsTable" class='table table-striped' id='restaurant-list' border='1'>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Description</th>
                <th></th>
            </tr>
        </table>
    </div>

  <script>
  
  $(document).ready(function(){
     // Change serviceURL to your own
     var serviceURL = "<?php echo $_SESSION['url']?>:8080/restaurants1/<?php echo $user_id;?>";
        var rows = "";
        $.get(serviceURL, function (data) {
            var restaurant = data.restaurant_id; //the arr is in data.Book of the JSON

            if (restaurant == undefined) { // did not manage to call service
                $('#restaurantsTable').empty();
                $('body').append("<label>There is a problem retrieving restaurants data, please try again later.</label>");
            }

            // // for loop to setup each table row with obtained book data
            // for (var i = 0; i < restaurantList.length; i++) {
            //     eachRow =
            //         "<td>" + restaurantList[i].name + "</td>" +
            //         "<td>" + restaurantList[i].address + "</td>" +
            //         "<td>" + restaurantList[i].description + "</td>" +
            //         "<td><a href='edit-restaurant.php?restaurant_id=" + restaurantList[i].restaurant_id + "&restaurant_name=" + restaurantList[i].name +"'>" +
            //         "View</a>";

            //     rows += "<tr>" + eachRow + "</tr>";
            // }

                 eachRow =
                    "<td>" + data.name + "</td>" +
                    "<td>" + data.address + "</td>" +
                    "<td>" + data.description + "</td>" +
                    "<td><a href='edit-restaurant.php?restaurant_id=" + data.restaurant_id + "&restaurant_name=" + data.name +"'>" +
                    "Edit Food List</a>";

            rows += "<tr>" + eachRow + "</tr>";
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