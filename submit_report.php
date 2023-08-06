<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Reports</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
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
        body {
            font-family: Arial, sans-serif;
            padding-top: 20px;
            background-color: #f2f2f2;
        }

        .report-container {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .report-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #006d77;
        }

        .report-container p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .report-container img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .page-header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
            color: #006d77;
        }
    </style>
</head>
<body>
<?php include 'navbar_admin.php'; ?>
<div class="container">
    <div class="page-header">
        <br>

        <h1>View Reports</h1>
    </div>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "vehicle management");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the accident reports from the database
    $sql = "SELECT * FROM accident_reports";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display the accident reports
        while ($row = mysqli_fetch_assoc($result)) {
            $report_id = $row["id"];
            $vehicle = $row["vehicle"];
            $driver_name = $row["driver_name"];
            $accident_date = $row["accident_date"];
            $accident_description = $row["accident_description"];
            $accident_photo = $row["accident_photo"];
            $image_data = base64_encode($accident_photo); // Encode the image data as base64

            echo '<div class="report-container">';
            echo "<h2>Accident Report ID: " . $report_id . "</h2>";
            echo "<p><strong>Vehicle:</strong> " . $vehicle . "</p>";
            echo "<p><strong>Driver Name:</strong> " . $driver_name . "</p>";
            echo "<p><strong>Accident Date:</strong> " . $accident_date . "</p>";
            echo "<p><strong>Accident Description:</strong> " . $accident_description . "</p>";
            echo "<p><strong>Accident Photo:</strong></p>";
            echo '<div class="text-center"><img src="data:image/jpeg;base64,' . $image_data . '"/></div>';
            echo "</div>";
        }
    } else {
        echo "<p class='text-center'>No accident reports found.</p>";
    }

    mysqli_close($connection);
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
