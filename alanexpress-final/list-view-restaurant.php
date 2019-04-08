<!doctype html>
<html lang="en">

<?php
require_once 'include/common.php';
require_once 'include/token.php';
if(!isset($_SESSION['user'])){
    //great facebook user
    //user type = facebook user 
    $username = urldecode($_GET['user']);
    $_SESSION['token'] = $token;
    $_SESSION['user'] = $username;
    $_SESSION['gender'] = $_GET['gender'];
    $token = generate_token($username);
    $_SESSION['token'] = $token;
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
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>Alan Express</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
<script>
    var user_id = "<?php echo($_SESSION['user']); ?>";
    // alert(user_id);
</script>
<div id="map"></div>

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      var userURL = "<?php echo $_SESSION['url']?>:8082/users2";
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 18
        });
        infoWindow = new google.maps.InfoWindow;
        var geocoder = new google.maps.Geocoder;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            marker = new google.maps.Marker({
                        position: pos,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        map: map
                    });
                    google.maps.event.addListener(marker, 'click', function(event) {
                      updatePosition();
                    });
 
                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        updatePosition();
                    });
            geocoder.geocode({
                        'latLng': pos
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                $('#latitude,#longitude').show();
                                $('#address').val(results[0].formatted_address);
                                $('#latitude').val(marker.getPosition().lat());
                                $('#longitude').val(marker.getPosition().lng());
                                infoWindow.setContent(results[0].formatted_address);
                                infoWindow.open(map, marker);
                                handle_PosPost(marker.getPosition().lat(),marker.getPosition().lng());
                            }
                        }
                    });
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        function updatePosition() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#address').val(results[0].formatted_address);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infoWindow.setContent(results[0].formatted_address);
                        infoWindow.open(map, marker);
                        handle_PosPost(marker.getPosition().lat(),marker.getPosition().lng());
                    }
                }
            });
        }
      }
      function handle_PosPost(latitude, longitude){
        $.ajaxSetup({
          headers:{
            'Content-Type': "application/json"
          }
        });
        $.post(userURL, JSON.stringify(
          {
            "username": user_id,
            "longitude": longitude,
            "latitude": latitude
          }
        ));
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
                <!-- <input id="address" type="text" style="width:600px;" disabled/><br/>
                <input id="latitude" type="text" style="width:300px;" disabled/>
                <input id="longitude" type="text" style="width:300px;" disabled/><br/> -->
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKTeCkUZ2ATFI9dxadr9Hh0RvsA-QfnMU&callback=initMap">
    </script>  
    <?php include "include/header.php";?>
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
        var serviceURL = "<?php echo $_SESSION['url']?>:8080/restaurants";
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