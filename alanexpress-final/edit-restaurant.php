<?php
require_once 'include/common.php';
require_once 'include/token.php';
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
<?php $foodArr = array(1); 
?>
    <h1><?php echo $_GET['restaurant_name'];?></h1>
    <div class="col-md-6">
   
        <table id="foodTable" class='table table-striped' id='food-list' border='1'>
            <tr>
                <th>Name </th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </table>
        <!-- <input type='hidden' class= "food_arr" id='foodArr' name="foodArr" value="[]" >
        <input type='hidden' class= "restaurant_id" id='restaurant_idd' name="restaurant_id" value="<?php echo $_GET['restaurant_id'];?>" > -->
    <!-- <form id ="form" method="post" action ="add-new-food.php">   -->
    <table id="foodTable2" class='table table-striped' id='food-list2' border='1'>
            <tr>
                <th>Name </th>
                <th>Price</th>
                <th></th>
            </tr>
            <tr>
                <td><input type="text" name="FoodNameAdd" id= "FoodNameAdd" size="10" ></td>
                <td><input type="text" name="FoodPriceAdd" id="FoodPriceAdd"  size="10"></td>
                <input type='hidden' class= "restaurant_id" id='restaurant_id' name="restaurant_id" value="<?php echo $_GET['restaurant_id'];?>" >
                <td><button type="submit " onclick="javascript:addFood()" >Add New Food</button></td>
            </tr>
        </table> 
        <!-- <input type="submit" value="Add Food"> -->
    <!-- </form> -->
    </div>

<script>
    $(function () {
        // Change serviceURL to your own

        var serviceURL = "<?php echo $_SESSION['url']?>:8080/restaurants/<?php echo $_GET['restaurant_id'];?>";
        var rows = "";
        $.get(serviceURL, function (data) {
            var foodList = data.Food; //the arr is in data.Book of the JSON

            if (foodList == undefined) { // did not manage to call service
                $('#foodTable').empty();
                $('body').append("<label>There is a problem retrieving food data, please try again later.</label>");
            }

            // for loop to setup each table row with obtained book data
            for (var i = 0; i < foodList.length; i++) {
    
                eachRow =  "<td>" + foodList[i].name + "</td>" +
                    "<td>" + foodList[i].price + "</td>";
                    eachRow += " <td><form id ='form' method='post' action ='edit-food.php'>"+
                    "<input type='hidden' class= 'foodID' id='foodID' name='foodID' value='"+foodList[i].food_id+"'>"+
                    "<input type='hidden' class= 'foodName' id='foodName' name='foodName' value='"+foodList[i].name+"'>"+
                    "<input type='hidden' class= 'foodPrice' id='foodPrice' name='foodPrice' value='"+foodList[i].price+"'>"+
                    "<input type='hidden' class= 'restaurantID' id='restaurantID' name='restaurantID' value='"+foodList[i].restaurant_id+"'>"+
                    "<input type='submit' value='Edit'></form></td>";
                    // eachRow += "<td><a href='add-to-cart.php?id=" + foodList[i].food_id + "'>" +
                    // "add to cart</a> </form>";

                    eachRow += 
                    "<td><input type='hidden' class= 'foodID' id='foodID' name='foodID' value='"+foodList[i].food_id+"'>"+
                    "<input type='hidden' class= 'foodName' id='foodName' name='foodName' value='"+foodList[i].name+"'>"+
                    "<input type='hidden' class= 'foodPrice' id='foodPrice' name='foodPrice' value='"+foodList[i].price+"'>"+
                    "<input type='hidden' class= 'restaurantID' id='restaurantID' name='restaurantID' value='"+foodList[i].restaurant_id+"'>"+
                    "<button type='submit' onclick='javascript:delFood("+foodList[i].food_id+")' >Delete Food</button></td>";

                rows += "<tr>" + eachRow + "</tr>";
            }
            $('#foodTable').append(rows);
        }) // $.get
            .fail(function () {
                $('#foodTable').empty();
                $('body').append("<label>There is a problem retrieving food data, please try again later.</label>");
            })

           
    });
    function addFood(){
    var restaurantID = <?php echo $_GET['restaurant_id']; ?>;
    var foodPrice = document.getElementById('FoodPriceAdd').value;
    // alert('what the'); 
    var foodName = document.getElementById('FoodNameAdd').value;
    // alert("bb");
    $.ajaxSetup({
        headers:{
            'Content-Type':"application/json"
        }
    });
        
        $.post( "<?php echo $_SESSION['url']?>:8080/restaurants2",
            JSON.stringify(
            {
                "name": ""+foodName+"",
                "price": foodPrice,
                "restaurant_id": restaurantID
     
            }) 
    ,function(data, status){
        alert ("Data: "+data+ "\nStatus: "+status);
    });

    // window.location.reload();
    // window.location.reload(true); 

    refresh();
}

function delFood(foodID){
    var food_id = foodID;
    // alert(food_id);
    var serviceURL = "<?php echo $_SESSION['url']?>:8080/restaurants3/"+food_id;

        $.ajax({
    url: serviceURL,
    type: 'DELETE',
    success: function(result) {
        // Do something with the result
        // alert("daebak");
    }
});
    refresh();
}

function refresh() {

setTimeout(function () {
    location.reload()
}, 100);
}
  
</script>
</body>

</html>