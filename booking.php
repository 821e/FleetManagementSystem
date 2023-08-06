<?php
if (!isset($_SESSION)) {
    session_start();
}
$connection = mysqli_connect('localhost', 'root', '', 'vehicle management');

$username = $_SESSION['username'];

$query = "SELECT  `first_name`, `last_name`, `email` FROM `user` WHERE username='$username'";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=Your google APi&libraries=places&callback=initMap"></script>

    <style>
        body {
            position: relative;
        }

        body::after {
            content: "";
            background: url("picture/truck-routing-blog.gif");
            background-size: cover;
            filter: blur(20px);
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }
        .navbar-fixed-top.scrolled {
            background-color: ghostwhite;
            transition: background-color 200ms linear;
        }

        #map {
            height: 400px;
            width: 100%;
            margin-top: 50px;
        }

        #directions-panel {
            margin-top: 20px;
        }

        #duration {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            background-color: #f7f7f7;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #duration:before {
            content: '\f017'; /* Font Awesome icon code for clock */
            font-family: 'Font Awesome 5 Free', serif;
            font-weight: 900;
            margin-right: 10px;
            color: #006d77; /* Use your desired color */
        }

        #duration-text {
            color: #006d77; /* Use your desired color */
        }
    </style>

    <script>
        var map;
        var destMarker;
        var pickupMarker;
        var directionsService;
        var directionsDisplay;

        function initMap() {
            // Create a new map centered on a default location
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 12,
                styles: [
                    // Map styles
                ]
            });

            // Create a DirectionsService object to handle directions requests
            directionsService = new google.maps.DirectionsService();

            // Create a DirectionsRenderer object to display the directions on the map
            directionsDisplay = new google.maps.DirectionsRenderer({
                map: map,
                panel: document.getElementById('directions-panel') // Add a <div> for displaying the directions
            });

            // Initialize Google Maps Autocomplete for Destination
            var autocompleteDestination = new google.maps.places.Autocomplete(document.getElementById('destination'));

            // Initialize Google Maps Autocomplete for Pickup Point
            var autocompletePickup = new google.maps.places.Autocomplete(document.getElementById('pickup'));

            // When the destination input changes, update the destination marker position
            autocompleteDestination.addListener('place_changed', function () {
                var place = autocompleteDestination.getPlace();
                if (place.geometry) {
                    if (destMarker) {
                        destMarker.setMap(null);
                    }
                    destMarker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: 'Destination'
                    });
                    map.panTo(place.geometry.location);

                    // Calculate directions and display the route
                    calculateAndDisplayRoute();
                }
            });

            // When the pickup input changes, update the pickup marker position
            autocompletePickup.addListener('place_changed', function () {
                var place = autocompletePickup.getPlace();
                if (place.geometry) {
                    if (pickupMarker) {
                        pickupMarker.setMap(null);
                    }
                    pickupMarker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: 'Pickup Point'
                    });
                    map.panTo(place.geometry.location);

                    // Calculate directions and display the route
                    calculateAndDisplayRoute();
                }
            });
        }

        function calculateAndDisplayRoute() {
            if (pickupMarker && destMarker) {
                // Retrieve the origin and destination coordinates
                var origin = pickupMarker.getPosition();
                var destination = destMarker.getPosition();

                // Configure the directions request
                var request = {
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                // Send the directions request to the DirectionsService
                directionsService.route(request, function (result, status) {
                    if (status === google.maps.DirectionsStatus.OK) {
                        // Display the directions on the map
                        directionsDisplay.setDirections(result);

                        // Get the first route from the result
                        var route = result.routes[0];

                        // Extract the estimated duration in minutes
                        var duration = route.legs[0].duration.text;

                        // Display the estimated duration
                        document.getElementById('duration-text').textContent = 'Estimated Duration: ' + duration;
                    }
                });
            }
        }


        $(function () {
            $(document).scroll(function () {
                var $nav = $(".navbar-fixed-top");
                $a = $(".navbar-fixed-top");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $a.height());
            });

            // Initialize Google Maps Autocomplete for Destination
            var autocompleteDestination = new google.maps.places.Autocomplete(document.getElementById('destination'));

            // Initialize Google Maps Autocomplete for Pickup Point
            var autocompletePickup = new google.maps.places.Autocomplete(document.getElementById('pickup'));

            // Initialize datepicker for Date of Requirement
            $("#req_date").datepicker({
                dateFormat: "yy-mm-dd"
            });

            // Initialize datepicker for Date of Return
            $("#return_date").datepicker({
                dateFormat: "yy-mm-dd"
            });

            // Initialize timepicker for Time of Requirement
            $("#req_time").timepicker({
                interval: 30, // 30 minutes intervals
                scrollbar: true // Enable scrollbar
            });

            // Initialize timepicker for Time of Return
            $("#return_time").timepicker({
                interval: 30, // 30 minutes intervals
                scrollbar: true // Enable scrollbar
            });

            // Call the initMap function when the page is loaded
            initMap();
        });
    </script>

</head>

<body>
<?php include 'navbar.php'; ?>
<br>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1 style="text-align:center;">Booking</h1>
        </div>
        <div id="map-column" class="col-md-6">
            <div id="map"></div>
            <div id="directions-panel"></div>
            <div id="duration">
            </div>
        </div>
        <div id="form-column" class="col-md-6">
            <form class="animated bounce" action="bookingaction.php" method="post">
                <!-- Name -->
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['first_name'] . " " . $row['last_name']; ?>" required>
                </div>

                <!-- Department -->
                <div class="form-group">
                    <label for="department"><b>Department</b></label>
                    <input id="department" type="text" class="form-control" name="department" placeholder="Department" required>
                </div>

                <!-- Vehicle Type -->
                <div class="form-group">
                    <label><b>Vehicle Type</b></label> &nbsp;
                    <label><input type="radio" name="type" value="car">Car</label> &nbsp;
                    <label><input type="radio" name="type" value="bus">Bus</label>
                    <label><input type="radio" name="type" value="Van">Van</label>
                    <label><input type="radio" name="type" value="Truck">Truck</label>


                </div>

                <!-- Date of Requirement -->
                <div class="form-group">
                    <label for="req_date"><b>Date of Requirement</b></label>
                    <input id="req_date" type="text" class="form-control" name="req_date" placeholder="Day the car is needed" required>
                    <input id="req_time" type="text" class="form-control" name="req_time">
                </div>

                <!-- Date of Return -->
                <div class="form-group">
                    <label for="return_date"><b>Date of Return</b></label>
                    <input id="return_date" type="text" class="form-control" name="return_date" placeholder="Day the car is returned" required>
                    <input id="return_time" type="text" class="form-control" name="return_time">
                </div>

                <!-- Destination -->
                <div class="form-group">
                    <label for="destination"><b>Destination</b></label>
                    <input id="destination" type="text" class="form-control" name="destination" placeholder="Car Destination" required>
                </div>

                <!-- Duration -->
                <div class="form-group">
                    <label for="duration"><b>Estimated Duration:</b></label>
                    <span id="duration-text"></span>
                </div>

                <!-- Pickup Point -->
                <div class="form-group">
                    <label for="pickup"><b>Pickup Point</b></label>
                    <input id="pickup" type="text" class="form-control" name="pickup" placeholder="Pickup Point" required>
                </div>

                <!-- Reason for Booking -->
                <div class="form-group">
                    <label for="reason"><b>Reason for booking</b></label>
                    <input id="reason" type="text" class="form-control" name="reason" placeholder="Reason for booking the vehicle">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input id="email" type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                </div>

                <!-- Mobile -->
                <div class="form-group">
                    <label for="mobile"><b>Mobile</b></label>
                    <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Mobile No" required>
                </div>

                <input type="hidden" name="username" value="<?php echo $username; ?>">

                <!-- Submit Button -->
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success">
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>


<script>
    // Wait for the page to load before initializing the map
    $(document).ready(function() {
        initMap();
    });
</script>

</body>

</html>
