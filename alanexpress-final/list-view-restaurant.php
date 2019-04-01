<!doctype html>
<html lang="en">

<?php
require_once 'include/common.php';
require_once 'include/token.php';
if(!isset($_SESSION['user'])){
    //great facebook user
    //user type = facebook user 

    $_SESSION['user'] = urldecode($_GET['user']);



}
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
</head>

<body>
<?php include 'include/header.php' ; ?>
    <h1>Restaurant Listing</h1>
    <div class="col-md-6">
        <table id="restaurantsTable" class='table table-striped' id='restaurant-list' border='1'>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Description</th>
                <th>View</th>
                <!-- <th><?php echo $_SESSION['user'] ?></th> -->
            </tr>
        </table>
    </div>
<script>
    $(function () {
        // Change serviceURL to your own
        var serviceURL = "http://SMUImage:8080/restaurants";
        var rows = "";
        $.get(serviceURL, function (data) {
            var restaurantList = data.Restaurant; //the arr is in data.Book of the JSON

            if (restaurantList == undefined) { // did not manage to call service
                $('#restaurantsTable').empty();
                $('body').append("<label>There is a problem retrieving restaurants data, please try again later.</label>");
            }

            // for loop to setup each table row with obtained book data
            for (var i = 0; i < restaurantList.length; i++) {
                eachRow =
                    "<td>" + restaurantList[i].name + "</td>" +
                    "<td>" + restaurantList[i].address + "</td>" +
                    "<td>" + restaurantList[i].description + "</td>" +
                    "<td><a href='food-list.php?restaurant_id=" + restaurantList[i].restaurant_id + "&restaurant_name=" + restaurantList[i].name +"'>" +
                    "View</a>";

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