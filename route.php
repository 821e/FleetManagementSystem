<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Route Map</title>
    <style>
        body {
            padding-top: 20px;
            font-family: Arial, sans-serif;
        }

        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #085078 0%, #85D8CE  51%, #085078  100%);
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
            border: 0px;
        }
        .page-header:hover{
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #006d77;
            border: none;
        }

        .btn-primary:hover {
            background-color: #00505a;
        }


    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="myDiv">
    <?php include 'navbar_admin.php'; ?>
    <br>
    <div class="container">
        <div class="page-header foo">
            <h1>Route Map</h1>
        </div>

        <?php
        $connection = mysqli_connect('localhost', 'root', '', 'vehicle management');
        session_start();

        $destination = "";
        $pickupPoint = "";
        $distanceDestinationPickup = "";
        $distancePickupDestination = "";

        if (isset($_POST['submit'])) {
            $bookingId = $_POST['booking_id'];

            // Fetch the booking details from the database based on the booking ID
            $query = "SELECT `destination`, `pickup_point` FROM `booking` WHERE `booking_id`='$bookingId'";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $destination = $row['destination'];
                $pickupPoint = $row['pickup_point'];
            } else {
                // Booking ID not found or no results returned
                $destination = "";
                $pickupPoint = "";
            }
        }
        ?>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="booking_id" class="col-sm-3 control-label">Booking ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="booking_id" id="booking_id" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" name="submit" class="btn btn-primary">Show Route</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div id="map"></div>
                <div id="distance"></div>
                <div id="distancePickupDestination"></div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=your google api &libraries=places"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function animateMarker(marker, route, duration) {
            var speed = duration / route.length;
            let count = 0;
            let refreshIntervalId = setInterval(function() {
                count++;
                if (count < route.length) {
                    marker.setPosition(route[count]);
                } else {
                    clearInterval(refreshIntervalId);
                }
            }, speed);
        }

        function initMap() {
            var destination = "<?php echo $destination; ?>";
            var pickupPoint = "<?php echo $pickupPoint; ?>";

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: { lat: 0, lng: 0 },
            });
            directionsRenderer.setMap(map);

            directionsService.route(
                {
                    origin: pickupPoint,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                function (response, status) {
                    if (status !== 'OK') {
                        console.error('Directions request failed due to ' + status);
                        return;
                    }

                    // Render the directions on the map
                    directionsRenderer.setDirections(response);

                    // Create a marker to represent the vehicle
                    var vehicleMarker = new google.maps.Marker({
                        map: map,
                        position: response.routes[0].legs[0].start_location, // set initial position to the start of the first leg
                        icon: {
                            url: 'picture/car.png',
                            scaledSize: new google.maps.Size(50, 50) // sets the size to 50x50 pixels
                        }
                    });

                    // Create a path for the vehicle to follow
                    var vehiclePath = [];
                    var legs = response.routes[0].legs;
                    for (var i = 0; i < legs.length; i++) {
                        var steps = legs[i].steps;
                        for (var j = 0; j < steps.length; j++) {
                            var nextSegment = steps[j].path;
                            for (var k = 0; k < nextSegment.length; k++) {
                                vehiclePath.push(nextSegment[k]);
                            }
                        }
                    }

                    // Start the animation
                    animateMarker(vehicleMarker, vehiclePath, 30000); // vehicle will move in 30s
                }
            );
        }

        $(document).ready(function() {
            initMap();
        });


    </script>
</div>
</body>
</html>
