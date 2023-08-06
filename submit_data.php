<?php

$connection = mysqli_connect("localhost", "root", "", "vehicle management");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = $_POST['veh_id'];
    $oil_consumption = (float)$_POST['oil_consumption'];
    $distance_crossed = (float)$_POST['distance_crossed'];


// Assuming 'veh_id' is the primary key in your 'vehicle' table
    $sql = "UPDATE `vehicle` SET `oil_consumption` = '$oil_consumption', `distance_crossed` = '$distance_crossed' WHERE `veh_id` = '$vehicle_id'";


    if (mysqli_query($connection, $sql)) {
        header("Location: Data_tracking.php?success=1"); // Redirect back to the analytics page with a success message
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>
