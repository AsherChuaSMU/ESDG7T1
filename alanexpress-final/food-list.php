<!doctype html>
<html lang="en">
<?php
require_once 'include/common.php';
require_once 'include/token.php';
?>
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
<?php $foodArr = array(1); 
?>
    <?php include 'include/header.php' ; ?>
    <h1><?php echo $_GET['restaurant_name'];?></h1>
    <div class="col-md-6">
    <form id ="form" method="post" action ="add-to-cart.php">
        <table id="foodTable" class='table table-striped' id='food-list' border='1'>
            <tr>
                <th>Name </th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Add to cart</th>
            </tr>
        </table>
        <input type='hidden' class= "food_arr" id='foodArr' name="foodArr" value="[]" >
        <input type='hidden' class= "restaurant_id" id='restaurant_idd' name="restaurant_id" value="<?php echo $_GET['restaurant_id'];?>" >
        <input type="submit" value="Submit">
    </form>
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
                    "<td>" + foodList[i].price + "</td>" +
                    "<td><input type='number' name='quantity' id='quantity"+foodList[i].food_id+"' min='1' max='5' value='1' ></td>";
                    eachRow += "<td><input type='checkbox' name='chkFood' id='chkFood"+foodList[i].food_id+"' onclick='javascript:addDelFoodToArrayList("+foodList[i].food_id+")' value='"+foodList[i].food_id+"'></td>";
                    // eachRow += "<td><a href='add-to-cart.php?id=" + foodList[i].food_id + "'>" +
                    // "add to cart</a> </form>";

                rows += "<tr>" + eachRow + "</tr>";
            }
            $('#foodTable').append(rows);
        }) // $.get
            .fail(function () {
                $('#foodTable').empty();
                $('body').append("<label>There is a problem retrieving food data, please try again later.</label>");
            })

           
    });
    var foodArr = {}
    function addDelFoodToArrayList(food_id) {
        if (document.getElementById("chkFood"+food_id).checked) {
            var qty = document.getElementById("quantity"+food_id).value;
            var foodId = food_id;
            // var fdArr = $('#foodArr').val(); //retrieve array
            // fdArr = JSON.parse(foodArr);
            // alert(foodArr);
            foodArr[foodId] = qty;
        } else {
            delete foodArr[food_id];
            alert("You didn't check it! Let me check it for you.");
        }
        
        $('#foodArr').val(JSON.stringify(foodArr)); //store array
      
    }
  
</script>
</body>

</html>