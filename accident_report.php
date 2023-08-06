<?php
$connection = mysqli_connect("localhost", "root", "", "vehicle management");
session_start();

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle = $_POST["vehicle"];
    $driverName = $_POST["driver_name"];
    $accidentDate = $_POST["accident_date"];
    $accidentDescription = $_POST["accident_description"];

    // Process the accident photo upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["accident_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["accident_photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Error: The uploaded file is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Error: The file already exists.";
        $uploadOk = 0;
    }

    // Check the file size
    if ($_FILES["accident_photo"]["size"] > 500000) {
        echo "Error: The uploaded file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Error: Your file was not uploaded.";
    } else {
        // Move the uploaded file to the target directory
        $targetDirectory = "C:/xampp/htdocs/picture/";
        $targetFile = $targetDirectory . basename($_FILES["accident_photo"]["name"]);

        if (move_uploaded_file($_FILES["accident_photo"]["tmp_name"], $targetFile)) {
            // Insert the accident report into the database
            $sql = "INSERT INTO accident_reports (vehicle, driver_name, accident_date, accident_description, accident_photo) VALUES ('$vehicle', '$driverName', '$accidentDate', '$accidentDescription', '$targetFile')";
            if (mysqli_query($connection, $sql)) {
                echo "Accident report submitted successfully.";
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } else {
            echo "Error: There was an error uploading your file.";
        }
    }
}

$sql = "SELECT * FROM vehicle";
$res = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accident Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0;
        }

        .btn-primary {
            border-radius: 0;
        }

        /* Applied Style */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            border-radius: 5px;
        }
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h1>Accident Report</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="vehicle">Vehicle:</label>
            <select name="vehicle" id="vehicle" class="form-control">
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <option value="<?php echo $row["veh_id"]; ?>"><?php echo $row["veh_reg"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="driver_name">Driver Name:</label>
            <input type="text" name="driver_name" id="driver_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="accident_date">Accident Date:</label>
            <input type="date" name="accident_date" id="accident_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="accident_description">Accident Description:</label>
            <textarea name="accident_description" id="accident_description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="accident_photo">Accident Photo:</label>
            <input type="file" name="accident_photo" id="accident_photo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
