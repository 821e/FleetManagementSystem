<?php
if (!isset($_SESSION)) {
    session_start();
}

$connection = mysqli_connect('localhost', 'root', '', 'vehicle management');
$msg = "";

if (isset($_POST['submit'])) {
    $drname = $_POST['drname'];
    $drjoin = $_POST['drjoin'];
    $drmobile = $_POST['drmobile'];
    $drnid = $_POST['drnid'];
    $drlicense = $_POST['drlicense'];
    $drlicensevalid = $_POST['drlicensevalid'];
    $draddress = $_POST['draddress'];
    $drphoto = $_FILES['file']['name'];

    //image Upload
    move_uploaded_file($_FILES['file']['tmp_name'], "picture/" . $_FILES['file']['name']);

    $res = false;
    $insert_query = "INSERT INTO `driver`(`driverid`, `drname`, `drjoin`, `drmobile`, `drnid`, `drlicense`, `drlicensevalid`, `draddress`, `drphoto`) VALUES ('','$drname','$drjoin','$drmobile','$drnid','$drlicense','$drlicensevalid','$draddress','$drphoto')";

    $res = mysqli_query($connection, $insert_query);

    if ($res == true) {
        $msg = "<script language='javascript'>
                   swal(
                        'Success!',
                        'Registration Completed!',
                        'success'
                    );
                </script>";
    } else {
        die('unsuccessful' . mysqli_error($connection));
    }
}

// Edit Driver functionality
if (isset($_POST['submitEdit'])) {
    $editDriverId = $_POST['editDriverId'];
    $editDriverName = $_POST['editDriverName'];
    $editDriverMobile = isset($_POST['editDriverMobile']) ? $_POST['editDriverMobile'] : '';
    $editDriverLicense = isset($_POST['editDriverLicense']) ? $_POST['editDriverLicense'] : '';
    $editDriverAddress = isset($_POST['editDriverAddress']) ? $_POST['editDriverAddress'] : '';
    $editDriverPhoto = '';

    // Check if a new photo is uploaded
    if (isset($_FILES['editDriverPhoto']) && $_FILES['editDriverPhoto']['size'] > 0) {
        $editDriverPhoto = $_FILES['editDriverPhoto']['name'];
        move_uploaded_file($_FILES['editDriverPhoto']['tmp_name'], "picture/" . $_FILES['editDriverPhoto']['name']);
    }

    // Update the driver's name, mobile number, license number, and address in the database
    $update_query = "UPDATE `driver` SET `drname`='$editDriverName'";

    if (!empty($editDriverMobile)) {
        $update_query .= ", `drmobile`='$editDriverMobile'";
    }

    if (!empty($editDriverLicense)) {
        $update_query .= ", `drlicense`='$editDriverLicense'";
    }

    if (!empty($editDriverAddress)) {
        $update_query .= ", `draddress`='$editDriverAddress'";
    }

    if (!empty($editDriverPhoto)) {
        $update_query .= ", `drphoto`='$editDriverPhoto'";
    }

    $update_query .= " WHERE `driverid`='$editDriverId'";

    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        // Driver updated successfully
        $msg = "<script language='javascript'>
                   swal(
                        'Success!',
                        'Driver Updated!',
                        'success'
                    );
                </script>";
    } else {
        // Failed to update the driver
        $msg = "<script language='javascript'>
                   swal(
                        'Error!',
                        'Failed to update the driver!',
                        'error'
                    );
                </script>";
    }
}
// Fetch Drivers for the dropdown
$fetch_drivers_query = "SELECT driverid, drname FROM `driver`";
$fetch_drivers_result = mysqli_query($connection, $fetch_drivers_query);


// Delete Driver functionality
if (isset($_POST['submitDelete'])) {
    $deleteDriverId = $_POST['deleteDriverId'];

    // Delete the driver from the database based on the given driver ID
    $delete_query = "DELETE FROM `driver` WHERE `driverid`='$deleteDriverId'";
    $delete_result = mysqli_query($connection, $delete_query);

    if ($delete_result) {
        // Driver deleted successfully
        $msg = "<script language='javascript'>
                   swal(
                        'Success!',
                        'Driver Deleted!',
                        'success'
                    );
                </script>";
    } else {
        // Failed to delete the driver
        $msg = "<script language='javascript'>
                   swal(
                        'Error!',
                        'Failed to delete the driver!',
                        'error'
                    );
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Driver</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="animate.css">
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
<br>

<div class="container">
    <div class="row">

        <div class="page-header">
            <h1 style="text-align: center;">New Driver Form</h1>
            <?php echo $msg; ?>

        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-6 animated bounceIn">
            <br>

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#addDriver">Add Driver</a></li>
                <li><a data-toggle="tab" href="#editDriver">Edit Driver</a></li>
                <li><a data-toggle="tab" href="#deleteDriver">Delete Driver</a></li>
            </ul>

            <div class="tab-content">
                <!-- Add Driver Tab -->
                <div id="addDriver" class="tab-pane fade in active">
                    <br>
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                        <div class="input-group">
                            <span class="input-group-addon"><b>Driver Name</b></span>
                            <input id="drname" type="text" class="form-control" name="drname" placeholder="Name">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Mobile</b></span>
                            <input id="drmobile" type="text" class="form-control" name="drmobile" placeholder="Mobile No">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Driver Joining Date</b></span>
                            <input id="drjoin" type="text" class="form-control" name="drjoin" placeholder="Joining date">
                        </div>
                        <br>

                        <script>
                            $(function () {
                                $("#drjoin").datepicker();
                            });
                        </script>

                        <div class="input-group">
                            <span class="input-group-addon"><b>National ID</b></span>
                            <input id="drnid" type="text" class="form-control" name="drnid" placeholder="Nid No">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>License No</b></span>
                            <input id="drlicense" type="text" class="form-control" name="drlicense" placeholder="License No">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>License End Date</b></span>
                            <input id="drlicensevalid" type="text" class="form-control" name="drlicensevalid"
                                   placeholder="Validity date">
                        </div>
                        <br>

                        <script>
                            $(function () {
                                $("#drlicensevalid").datepicker();
                            });
                        </script>

                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Driver Address</b></span>
                            <textarea rows="5" id="draddress" type="text" class="form-control"
                                      name="draddress" placeholder="Address"></textarea>
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Photo</b></span>
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="input-group">
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>

                <!-- Edit Driver Tab -->
                <div id="editDriver" class="tab-pane fade">
                    <br>
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <span class="input-group-addon"><b>Select Driver</b></span>
                            <select id="editDriverId" class="form-control" name="editDriverId">
                                <?php while ($driver = mysqli_fetch_assoc($fetch_drivers_result)) : ?>
                                    <option value="<?php echo $driver['driverid']; ?>">
                                        <?php echo $driver['drname']; ?>
                                    </option>
                                <?php endwhile; ?>
                                <?php mysqli_data_seek($fetch_drivers_result, 0); ?> <!-- Reset the result pointer for reuse -->
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Driver Name</b></span>
                            <input id="editDriverName" type="text" class="form-control" name="editDriverName" placeholder="Driver Name">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Mobile</b></span>
                            <input id="editDriverMobile" type="text" class="form-control" name="editDriverMobile" placeholder="Mobile No">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>License No</b></span>
                            <input id="editDriverLicense" type="text" class="form-control" name="editDriverLicense" placeholder="License No">
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Address</b></span>
                            <textarea rows="5" id="editDriverAddress" type="text" class="form-control" name="editDriverAddress" placeholder="Address"></textarea>
                        </div>
                        <br>

                        <div class="input-group">
                            <span class="input-group-addon"><b>Photo</b></span>
                            <input type="file" class="form-control" name="editDriverPhoto">
                        </div>

                        <br>

                        <div class="input-group">
                            <input type="submit" name="submitEdit" class="btn btn-success" value="Edit Driver">
                        </div>
                    </form>
                </div>
                <!-- ... (Previous code remains unchanged) -->

                <!-- Delete Driver Tab -->
                <div id="deleteDriver" class="tab-pane fade">
                    <br>
                    <form class="form-horizontal" action="" method="post">
                        <div class="input-group">
                            <span class="input-group-addon"><b>Select Driver</b></span>
                            <select id="deleteDriverId" class="form-control" name="deleteDriverId">
                                <?php while ($driver = mysqli_fetch_assoc($fetch_drivers_result)) : ?>
                                    <option value="<?php echo $driver['driverid']; ?>">
                                        <?php echo $driver['drname']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <br>
                        <div class="input-group">
                            <input type="submit" name="submitDelete" class="btn btn-danger" value="Delete Driver">
                        </div>
                    </form>
                </div>

</body>

</html>


</div>
</body>

</html>
