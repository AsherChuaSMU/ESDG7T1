<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>Travel Modes in Directions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
    <script>
    var driver_id = "<?php echo $_GET["driver_id"]; ?>";
    var restaurant_id = "<?php echo $_GET["restaurant_id"]; ?>";
    var currOrder_id = "<?php echo $_GET["order_id"]; ?>";
    var ordersURL = "http://SMUImage:8081/orders2/" + currOrder_id;
    var driverURL = "http://SMUImage:8082/users1/" + driver_id;
    var restaurantURL = "http://SMUImage:8080/restaurants/";
    var rows = ""
      $(function(){
        $.get(ordersURL, function (data) { //print current order list
            var orderList = data.Order;
            if (orderList == undefined) { // did not manage to call service
                $('#orderTable').empty();
                $('body').append("<label>There is a problem retrieving orders data, please try again later.</label>");
            }
            for (var i = 0; i <orderList.length; i++) {
                if (orderList[i].order_id == <?php echo $_GET["order_id"]; ?>){
                eachRow =
                    "<td>" + orderList[i].order_id + "</td>" +
                    "<td>" + orderList[i].customer_id + "</td>" +
                    "<td>" + orderList[i].food_id + "</td>" +
                    "<td>" + orderList[i].quantity + "</td>" +
                    "<td>" + orderList[i].restaurant_id + "</td>" +
                    "<td><a href='directionsCust.php?order_id=" + orderList[i].order_id + "&restaurant_id=" + orderList[i].restaurant_id +"&driver_id="+driver_id+"&customer_id="+orderList[i].customer_id+"'>" +
                    "Start Delivery</a></td>";
                rows += "<tr>" + eachRow + "</tr>";
                }
            }
            $('#orderTable').append(rows);
        })
        .fail(function () {
                $('#orderTable').empty();
                alert("Did you forget to run Tibco");
                $('body').append("<label>There is a problem retrieving order data, please try again later.</label>");
            })

        $.get(restaurantURL, function (data) {//get restaurant address
            var restaurantList = data.Restaurant;
            if (restaurantList == undefined) { // did not manage to call service
                alert("<label>There is a problem retrieving restaurant data, please try again later.</label>");
            }
            for (var i = 0; i <restaurantList.length; i++) {
                if (restaurantList[i].restaurant_id == restaurant_id){
                  $("#latitudeB").val(restaurantList[i].latitude);
                  $("#longitudeB").val(restaurantList[i].longitude);

                }
            }
        })
        .fail(function () {
                alert("Did you forget to run Tibco");
            })
        
        $.get(driverURL, function (data) {//get restaurant address
            var driverList = data;
            if (driverList == undefined) { // did not manage to call service
                alert("<label>There is a problem retrieving driver data, please try again later.</label>");
            }
                if (driverList.username == driver_id){
                  $("#latitudeA").val(driverList.latitude);
                  $("#longitudeA").val(driverList.longitude);
                  
                }
        })
        .fail(function () {
                alert("Did you forget to run Tibco");
            })
    });
      
    </script>
  </head>
  <body>
    <div id="floating-panel">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <div id="map"></div>
    <script>
        function initMap() {
      
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function(){calculateAndDisplayRoute(directionsService, directionsDisplay);};
        document.getElementById('orderTable').addEventListener('change', onChangeHandler);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
      }
  
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: new google.maps.LatLng(document.getElementById('latitudeA').value, document.getElementById('longitudeA').value),
          destination: new google.maps.LatLng(document.getElementById('latitudeB').value, document.getElementById('longitudeB').value), 
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <input id="addressA" type="text" style="width:600px;" value="My Location" disabled/><br/>
    <input id="latitudeA" type="text" style="width:300px;" disabled/>
    <input id="longitudeA" type="text" style="width:300px;" disabled/><br/>
    <input id="addressB" type="text" style="width:600px;" value="Restaurant Location" disabled/><br/>
    <input id="latitudeB" type="text" style="width:300px;" disabled/>
    <input id="longitudeB" type="text" style="width:300px;" disabled/><br/>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKTeCkUZ2ATFI9dxadr9Hh0RvsA-QfnMU&callback=initMap">
    </script>
    <h1>Order Details</h1>
    <div class="col-md-6">
        <table id="orderTable" class='table table-striped' id='restaurant-list' border='1'>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Food</th>
                <th>Qty</th>
                <th>Restaurant</th>
                <th>Arrived?</th>
            </tr>
        </table>
    </div>
  </body>
</html>