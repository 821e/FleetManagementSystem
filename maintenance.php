<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maintenance Page</title>

    <!-- Include CSS and JS libraries -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            padding-top: 20px;
            font-family: Arial, sans-serif;
        }

        .page-header {
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


        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        form label {
            font-weight: bold;
        }

        form select,
        form input[type="text"],
        form input[type="date"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form select {
            cursor: pointer;
        }

        .btn-primary {
            background-color: #006d77;
            border: none;
            padding: 10px 20px;
            color: #fff;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #00566b;
        }
    </style>
</head>

<body>
<div id="myDiv">
    <?php include 'navbar_admin.php'; ?>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header animated bounceIn">
                    <h1>Maintenance Form</h1>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="vehicle">Select Vehicle:</label>
                        <select class="form-control" name="vehicle" id="vehicle" required>
                            <?php
                            // Database connection
                            $connection = mysqli_connect("localhost", "root", "", "vehicle management");

                            // Fetch the list of vehicles from the database
                            $sql = "SELECT * FROM `vehicle`";
                            $res = mysqli_query($connection, $sql);

                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<option value="' . $row["veh_id"] . '">' . $row["veh_reg"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task">Maintenance Task:</label>
                        <input type="text" class="form-control" name="task" id="task" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" id="date" required>
                    </div>
                    <div class="form-group">
                        <label for="issue">Issue:</label>
                        <select class="form-control" name="issue" id="issue" required>
                            <?php
                            // Fetch the list of possible issues from a separate table
                            $issuesSql = "SELECT * FROM `issues`";
                            $issuesRes = mysqli_query($connection, $issuesSql);

                            while ($issueRow = mysqli_fetch_assoc($issuesRes)) {
                                echo '<option value="' . $issueRow["issue"] . '">' . $issueRow["issue"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="picture">Upload Picture:</label>
                        <input type="file" class="form-control" name="picture" id="picture" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include ScrollReveal and any other scripts you need -->
<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
<script>
    window.sr = ScrollReveal();
    sr.reveal('.animated', {
        duration: 800
    });
</script>
</body>

</html>
