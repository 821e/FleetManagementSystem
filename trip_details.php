<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            font-family: Arial, sans-serif;
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

        .table-container {
            max-width: 100%;
            overflow-x: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .table tbody td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>View Trip Details</h1>
    </div>
    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "vehicle management");

    // Function to fetch booking
    function fetchBooking()
    {
        global $connection;

        $query = "SELECT * FROM booking";
        $result = mysqli_query($connection, $query);

        return $result;
    }

    // Fetch booking from the database
    $booking = fetchBooking();
    include 'navbar_admin.php';
    ?>
    <div class="table-container">
        <table class="table">
            <thead>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Department</th>
                <th>Type</th>
                <th>Request Date</th>
                <th>Request Time</th>
                <th>Return Date</th>
                <th>Return Time</th>
                <th>Destination</th>
                <th>Pickup Point</th>
                <th>Reasons</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Confirmation</th>
                <th>Checked</th>
                <th>Vehicle Registration</th>
                <th>Driver ID</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($booking)) { ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['req_date']; ?></td>
                    <td><?php echo $row['req_time']; ?></td>
                    <td><?php echo $row['ret_date']; ?></td>
                    <td><?php echo $row['ret_time']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['pickup_point']; ?></td>
                    <td><?php echo $row['resons']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['confirmation']; ?></td>
                    <td><?php echo $row['checked']; ?></td>
                    <td><?php echo $row['veh_reg']; ?></td>
                    <td><?php echo $row['driverid']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
