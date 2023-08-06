<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'vehicle management');

$select_query = "SELECT * FROM `booking` ORDER BY booking_id DESC";
$result = mysqli_query($connection, $select_query);

// Function to update the checked status of a booking
function updateCheckedStatus($booking_id, $status)
{
    global $connection;
    $update_query = "UPDATE `booking` SET `checked` = $status WHERE `booking_id` = $booking_id";
    mysqli_query($connection, $update_query);
}

// Function to update the finished status of a booking
function updateFinishedStatus($booking_id, $status)
{
    global $connection;
    $update_query = "UPDATE `booking` SET `finished` = $status WHERE `booking_id` = $booking_id";
    mysqli_query($connection, $update_query);
}

// Handle actions when release button is clicked
if (isset($_GET['release_id'])) {
    $release_id = $_GET['release_id'];

    // Update checked status to 1 (checked)
    updateCheckedStatus($release_id, 1);

    // Redirect to trip details page
    header("Location: tripdetails.php?booking_id=$release_id");
    exit();
}

// Handle actions when mark as finished button is clicked
if (isset($_GET['finish_id'])) {
    $finish_id = $_GET['finish_id'];

    // Update finished status to 1 (finished)
    updateFinishedStatus($finish_id, 1);

    // Redirect back to the booking list page
    header("Location: bookinglist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking list</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
</style>
<?php include 'navbar_admin.php'; ?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1 style="text-align: center;">Booking List</h1>
            </div>
            <table id="myTable" class="table table-bordered animated bounce">
                <thead>
                <th>Booking Id</th>
                <th>Name</th>
                <th>Type</th>
                <th>Delete</th>
                <th>Release</th>
                <th>Confirm Trip</th>
                <th>Checked</th>
                <th>Finished</th>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td>
                            <a class="btn btn-danger"
                               href="deletebooking.php?id=<?php echo $row['booking_id']; ?>">Delete</a>
                        </td>
                        <?php if ($row['confirmation'] == 0 or $row['finished'] == 1) { ?>
                            <td>
                                <a class="btn btn-default disabled"
                                   href="releasebooking.php?release_id=<?php echo $row['booking_id']; ?>">Release
                                    Vehicle</a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <a class="btn btn-default"
                                   href="releasebooking.php?release_id=<?php echo $row['booking_id']; ?>">Release
                                    Vehicle</a>
                            </td>
                        <?php } ?>
                        <?php if ($row['confirmation'] == '0') { ?>
                            <td>
                                <a class="btn btn-success"
                                   href="confirmbooking.php?id=<?php echo $row['booking_id']; ?>">Confirm</a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <a class="btn btn-success disabled"
                                   href="confirmbooking.php?id=<?php echo $row['booking_id']; ?>">Confirm</a>
                            </td>
                        <?php } ?>
                        <?php if ($row['checked'] == '0') { ?>
                            <td>No</td>
                        <?php } else { ?>
                            <td>Yes</td>
                        <?php } ?>
                        <?php if ($row['finished'] == '0') { ?>
                            <td>
                                <a class="btn btn-primary"
                                   href="bookinglist.php?finish_id=<?php echo $row['booking_id']; ?>">Mark as
                                    Finished</a>
                            </td>
                        <?php } else { ?>
                            <td>Yes</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    });
</script>
</html>
