<?php

require_once 'include/common.php';
require_once 'include/token.php';

$foodName = $_POST['FoodName'];
$foodPrice = $_POST['FoodPrice'];
$restaurantId = $_POST['restaurant_id'];


echo ($foodName);
// echo ($foodPrice);
// echo ($restaurantId);


// header('Location: ' . $_SERVER['HTTP_REFERER']);
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
<script>
$(document).ready(function(){
    var restaurantID = <?php echo $restaurantId; ?>;
    var foodPrice = <?php echo $foodPrice; ?>;
    alert('what the'); 
    var foodName = "<?php echo $foodName; ?>";
    alert("bb");
    
   
   
    $.ajaxSetup({
        headers:{
            'Content-Type':"application/json"
        }
    });
        
        $.post( "http://SMUImage:8080/restaurants2",
            JSON.stringify(
            {
                "name": ""+foodName+"",
                "price": foodPrice,
                "restaurant_id": restaurantID
     
            }) 
    ,function(data, status){
        alert ("Data: "+data+ "\nStatus: "+status);
    });
});

  
</script>
</body>
</html>