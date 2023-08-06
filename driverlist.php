<?php
$connection = mysqli_connect("localhost", "root", "", "vehicle management");

session_start();

$sql = "SELECT * FROM `driver`";
$res = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Drivers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">

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

        table tbody td .image-box {
            display: flex;
            justify-content: center;
        }

        table tbody td .image-box img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table tbody td a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        /* Animation */
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        @keyframes bounceIn {
            0%,
            20%,
            40%,
            60%,
            80%,
            100% {
                transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                transform: translate3d(0, 0, 0);
            }
            40%,
            60% {
                transition-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                transform: translate3d(0, -30px, 0);
            }
            70% {
                transition-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                transform: translate3d(0, -15px, 0);
            }
            90% {
                transform: translate3d(0, -4px, 0);
            }
        }

        .bounceIn {
            animation-name: bounceIn;
        }
    </style>
</head>

<body>
<div id="myDiv">
    <?php include 'navbar.php'; ?>
    <br><br><br>
    <div class="container">
        <?php if (mysqli_num_rows($res) > 0) { ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="page-header animated tada">
                        <h1>Drive List</h1>
                    </div>
                    <table class="table foo">
                        <thead>
                        <tr>
                            <th>Profile Picture</th>
                            <th>Driver Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td>
                                    <div class="image-box">
                                        <img src="picture/<?php echo $row["drphoto"]; ?>" alt="dp">
                                    </div>
                                </td>
                                <td>
                                    <a href="driverprofile.php?driverid=<?php echo $row["driverid"]; ?>">
                                        <?php echo $row["drname"]; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3"></div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    window.sr = ScrollReveal();
    sr.reveal('.foo', { duration: 800 });
</script>
</body>
</html>
