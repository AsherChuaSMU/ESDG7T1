<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>Travel Modes in Directions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div id="content">
    <a href="driverLocation.php">Return to home</a>
</div>
<script>
    var driver_id = "<?php echo $_GET["driver_id"]; ?>";
    var restaurant_id = "<?php echo $_GET["restaurant_id"]; ?>";
    var currOrder_id = "<?php echo $_GET["order_id"]; ?>";
    var ordersURL = "http://DESKTOP-MEDEL57:8081/orders2/"+ currOrder_id;
    
    updateOrder(currOrder_id);
    function updateOrder(orderID){
        $.ajaxSetup({
          headers:{
            'Content-Type': "application/json"
          }
        });
        $.post(ordersURL, JSON.stringify(
          {
            "order_id": orderID,
            "status": "2"
          }
        ),
        function(data, status){
          alert("Status: " + status + "\nOrder status has been updated");
          $("#test").append("<h1>Thank you for your service</h1>");
        });
      }
</script>
</body>
</html>