<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
  </head>
  <body>
<script>
    var driver_id = "bye";//$_SESSION['user'];
    var serviceURL = "http://DESKTOP-MEDEL57:8081/orders";
    var rows = "";
    $(function () {
        $.get(serviceURL, function (data) {
            var orderList = data.Order;
            if (orderList == undefined) { // did not manage to call service
                $('#orderTable').empty();
                $('body').append("<label>There is a problem retrieving orderss data, please try again later.</label>");
            }

            for (var i = 0; i <orderList.length; i++) {
                if (orderList[i].status == "1"){
                eachRow =
                    "<td>" + orderList[i].order_id + "</td>" +
                    "<td>" + orderList[i].customer_id + "</td>" +
                    "<td>" + orderList[i].food_id + "</td>" +
                    "<td>" + orderList[i].quantity + "</td>" +
                    "<td>" + orderList[i].restaurant_id + "</td>" +
                    "<td><a href='directions.php?order_id=" + orderList[i].order_id + "&restaurant_id=" + orderList[i].restaurant_id + "&customer_id=" + orderList[i].customer_id +"&driver_id="+driver_id+"'>" +
                    "Deliver</a>";

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
    });
    </script>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      var userURL = "http://DESKTOP-MEDEL57:8082/users2";
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
                                handle_post(marker.getPosition().lat(),marker.getPosition().lng());
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
                        handle_post(marker.getPosition().lat(),marker.getPosition().lng());
                    }
                }
            });
        }
      }
      function handle_post(latitude, longitude){
        $.ajaxSetup({
          headers:{
            'Content-Type': "application/json"
          }
        });
        $.post(userURL, JSON.stringify(
          {
            "username": driver_id,
            "longitude": longitude,
            "latitude": latitude
          }
        ),
        function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
        });
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
                <input id="address" type="text" style="width:600px;" disabled/><br/>
                <input id="latitude" type="text" style="width:300px;" disabled/>
                <input id="longitude" type="text" style="width:300px;" disabled/><br/>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKTeCkUZ2ATFI9dxadr9Hh0RvsA-QfnMU&callback=initMap">
    </script>  
<h1>Orders Listing</h1>
    <div class="col-md-6">
        <table id="orderTable" class='table table-striped' id='restaurant-list' border='1'>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Food</th>
                <th>Qty</th>
                <th>Restaurant</th>
                <th></th>
            </tr>
        </table>
    </div>
</body>
</html>