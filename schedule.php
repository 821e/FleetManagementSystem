<?php
if (!isset($_SESSION)) {
    session_start();
}
$connection = mysqli_connect('localhost', 'root', '', 'vehicle management');

$query = "SELECT booking_id, name, username, department, type, req_date, req_time, ret_date, ret_time, veh_reg FROM `booking` WHERE confirmation='confirmed'";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
    </style>

    <meta charset="UTF-8">
    <title>Schedule</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'navbar.php'; ?>
< class="container">
<br/> <br>
<h1>Schedule Table</h1>
<meta name="viewport" content="width=device-width, initial-scale=1">
<table id="scheduleTable" class="display">
    <thead>
    <tr>
        <th>Name</th>
        <th>Department</th>
        <th>Type</th>
        <th>From Date</th>
        <th>From Time</th>
        <th>Return Date</th>
        <th>Return Time</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['department'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['req_date'] ?></td>
            <td><?= $row['req_time'] ?></td>
            <td><?= $row['ret_date'] ?></td>
            <td><?= $row['ret_time'] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>

<script>
    $(document).ready(function() {
        $('#scheduleTable').DataTable();
    });
</script>
</body>

</html>
