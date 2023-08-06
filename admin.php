<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(to right, #135d5d 0%, #37969a 51%, #37969a 100%);
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

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        .row {
            margin-bottom: 20px;
        }

        .box {
            background-color: #2c7a7c;
            border: 1px solid #2c7a7c;
            padding: 30px;
            text-align: center;
            transition: transform .2s;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #fff;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box a {
            text-decoration: none;
            color: #fff;
        }

        .box h3 {
            font-size: 24px;
            font-weight: 600;
            margin-top: 20px;
        }

        .box i {
            font-size: 60px;
            margin-bottom: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<?php include 'navbar_admin.php' ?>
<div class="header">
    <h1>Admin Panel</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('newdriver.php')">
                <i class="fas fa-user-plus"></i>
                <h3>Add New Driver</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('newvehicle.php')">
                <i class="fas fa-car"></i>
                <h3>Add New Vehicle</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('bookinglist.php')">
                <i class="fas fa-book"></i>
                <h3>Booking</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('trip_details.php')">
                <i class="fas fa-route"></i>
                <h3>Trip Details</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('route.php')">
                <i class="fas fa-map-signs"></i>
                <h3>Route Tracking</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('Data_tracking.php')">
                <i class="fas fa-chart-line"></i>
                <h3>Data Tracking</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('submit_report.php')">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Accident Reports</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('maintenance.php')">
                <i class="fas fa-tools"></i>
                <h3>Maintenance</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" style="background-color: #2c7a7c;" onclick="navigateTo('enter_schedule.php')">
                <i class="fas fa-calendar-alt"></i>
                <h3>Schedule Adjustment</h3>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<!-- Font Awesome JS -->

<script>
    function navigateTo(url) {
        window.location.href = url;
    }
</script>
</body>

</html>
