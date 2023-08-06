<?php
session_start();
$connection=mysqli_connect("localhost","root","","vehicle management");

$msg="";
if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($connection,strtolower($_POST['username']));

    $password=mysqli_real_escape_string($connection,$_POST['password']);

    $login_query="SELECT * FROM `admin` WHERE username='$username' and password='$password'";

    $login_res=mysqli_query($connection,$login_query);
    if(mysqli_num_rows($login_res)>0){
        $_SESSION['username']=$username;
        header('Location:admin.php');
    }
    else{
        $msg= '<div class="alert alert-danger alert-dismissable" style="margin-top:30px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Unsuccessful!</strong> Login Unsuccessful.
                  </div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f8f8f8;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 100px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-horizontal {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-control {
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
        }

        .input-group-addon {
            background-color: #2C7A7CFF;
            border-radius: 5px;
            border: none;
            color: #ffffff;
            min-width: 40px;
            text-align: center;
        }

        .input-group-addon i {
            color: #ffffff;
        }

        .btn-success {
            background-color: #2C7A7CFF;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            padding: 15px 30px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover,
        .btn-success:focus {
            background-color: #247076FF;
            outline: none;
        }

        .alert {
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert .close {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;
        }

        .alert .close:hover {
            opacity: 1;
        }

        a {
            color: #2C7A7CFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $msg; ?>
            <div class="page-header">
                <h1 style="text-align: center;">Admin Login</h1>
            </div>
            <form class="form-horizontal animated bounce" action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-block">Log in</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
