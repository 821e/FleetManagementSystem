<?php
if (!isset($_SESSION)) {
    session_start();
}

$username = $_GET['id'];
//echo $username;

$connection = mysqli_connect('localhost', 'root', '', 'vehicle management');

$query = "SELECT booking.booking_id, booking.req_date, booking.ret_date, booking.destination, booking.veh_reg, booking.driverid, vehicle.distance_crossed, vehicle.oil_consumption FROM booking LEFT JOIN vehicle ON booking.veh_reg = vehicle.veh_reg WHERE booking.username = '$username'";

$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My account</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            margin: 20px 0;
            color: #006d77;
        }

        table {
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        table thead th {
            text-align: center;
            font-weight: bold;
            background-color: #006d77;
            color: #fff;
            padding: 10px;
        }

        table tbody td {
            text-align: center;
            padding: 10px;
        }
        h1 {
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
        h1:hover{
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="buslist.php">Vehicle</a></li>
                    <li><a href="driverlist.php">Driver</a></li>
                    <li><a href="route.php">Bus Route</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="myaccount.php?id=<?php echo $_SESSION['username']; ?>">My Account</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="index.php">Visit Site</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="page-header">
            <h1 style="text-align: center;">My account</h1>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th>Booking Id</th>
                <th>Requested Date</th>
                <th>Return Date</th>
                <th>Destination</th>
                <th>Vehicle Registration</th>
                <th>Driver</th>
                <th>Total Km</th>
                <th>Oil Consumption</th>
            </tr>
            </thead>

            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['req_date']; ?></td>
                    <td><?php echo $row['ret_date']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><a href="busprofile.php?busid=<?php echo $row['veh_reg'] ?>"><?php echo $row['veh_reg'] ?></a></td>
                    <td><a href="driverprofile.php?driverid=<?php echo $row['driverid'] ?>"><?php echo $row['driverid'] ?></a></td>
                    <td><?php echo $row['distance_crossed']; ?> km</td>
                    <td><?php echo $row['oil_consumption']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
