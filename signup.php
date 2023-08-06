<?php
$connection=mysqli_connect("localhost","root","","vehicle management");

session_start();
$msg="";

if(isset($_POST['submit'])){
    $firstname= mysqli_real_escape_string($connection,strtolower($_POST['firstname']));
    $lastname= mysqli_real_escape_string($connection,strtolower($_POST['lastname']));
    $email= mysqli_real_escape_string($connection,strtolower($_POST['email']));
    $username= mysqli_real_escape_string($connection,strtolower($_POST['username']));
    $password= mysqli_real_escape_string($connection,strtolower($_POST['password']));


    $signup_query= "INSERT INTO `user`(`user_id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES ('','$firstname','$lastname','$email','$username','$password')";

    $check_query= "SELECT * FROM `user` WHERE username='$username' or email='$email'";

    $check_res=mysqli_query($connection,$check_query);

    if(mysqli_num_rows($check_res)>0){
        $msg= '<div class="alert alert-warning" style="margin-top:30px;">
                      <strong>Failed!</strong> Username or Email already exists.
                      </div>';

    }

    else{
        $signup_res= mysqli_query($connection,$signup_query);
        $msg= '<div class="alert alert-success" style="margin-top:30px;">
                      <strong>Success!</strong> Registration Successful.
                      </div>';

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f8f8f8;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
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
            padding: 15px;
            font-size: 16px;
            width: 100%;
        }

        .btn-success:hover {
            background-color: #237071FF;
        }

        .alert {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .alert-success {
            background-color: #3CB371FF;
        }

        .alert-warning {
            background-color: #FFA500FF;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<?php include 'navbar.php';?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $msg; ?>
            <div class="page-header">
                <h1 style="text-align: center;">Sign Up</h1>
            </div>
            <form class="form-horizontal animated bounce" action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Lastname">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
