<?php
require_once 'include/common.php';
require_once 'include/token.php';

$foodId = $_POST['foodID'];
$foodName = $_POST['foodName'];
$foodPrice = $_POST['foodPrice'];
$restaurantID = $_POST['restaurantID'];

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
<?php include 'include/header-owner.php' ; ?>

    <h1><?php echo $_GET['restaurant_name'];?></h1>
    <div class="col-md-6">

        <table id="foodTable" class='table table-striped' id='food-list' border='1'>
            <tr>
                <th>Name </th>
                <th>Price</th>
                <th></th>
            </tr>
            <tr>
                <td><input type="text" name="FoodName" id= "FoodName" value=<?php echo $foodName?> size="10" ></td>
                <td><input type="text" name="FoodPrice" id="FoodPrice" value=<?php echo $foodPrice?> size="10"></td>
                <td><button type="submit" onclick="javascript:editFood()">Done</button></td>
            </tr>
        </table>
        <!-- <input type='hidden' class= "food_arr" id='foodArr' name="foodArr" value="[]" >
        <input type='hidden' class= "restaurant_id" id='restaurant_idd' name="restaurant_id" value="<?php echo $_GET['restaurant_id'];?>" > -->
  
      

    <form id ="form" method="post" action ="owner-view.php">   
        <input type="submit" value="Cancel">
    </form>
    </div>

<script>
function editFood(){
    // alert('what the');
    var foodID = <?php echo $foodId; ?>;
    var foodName = document.getElementById('FoodName').value;
    var foodPrice = document.getElementById('FoodPrice').value;
    var restaurantID = <?php echo $restaurantID; ?>;
    // alert(foodID + " " + " "+foodName + " "+ foodPrice + " "+restaurantID);
    $.ajaxSetup({
        headers:{
            'Content-Type':"application/json"
        }
    });
        
        $.post( "http://SMUImage:8080/restaurants1",
            JSON.stringify(
            {
                "food_id": foodID,
                "name": ""+foodName+"",
                "price": foodPrice,
                "restaurant_id": restaurantID
     
            }) 
    ,function(data, status){
        alert ("Data: "+data+ "\nStatus: "+status);
    });
}
  
</script>
</body>

</html>