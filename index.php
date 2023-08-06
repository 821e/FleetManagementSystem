<?php
$connection = mysqli_connect("localhost", "root", "", "vehicle management");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
    .parallax {
        /* The image used */
        background-image: url("img/Wise_Trans.svg");
        height: 100%;

        /* Set a specific height */
        min-height: 700px;

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .parallax1 {
        /* The image used */
        background-image: url("bus_wesley-shen.jpg");
        height: 100%;

        /* Set a specific height */
        min-height: 600px;

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .navbar-fixed-top.scrolled {
        background-color: ghostwhite;
        transition: background-color 200ms linear;
    }

    .hero-text {
        font-size: 50px;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }

    .jumbotron {
        background-color: #f8f8f8;
    }

    .jumbotron h2 {
        animation: bounce 1s infinite;
    }

    .btn {
        background-image: linear-gradient(to right, #085078 0%, #85D8CE  51%, #085078  100%);
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }
    .btn:hover{
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .container {
        margin-top: 50px;
    }

    .page-header {
        padding: 20px 0;
        margin: 40px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .img-responsive {
        max-width: 100%;
        height: auto;
    }

    .footer {
        background-color: #2f2f2f;
        color: #fff;
        padding-top: 70px;
        padding-bottom: 70px;
    }

    .footer p {
        margin: 0;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-30px);
        }
        60% {
            transform: translateY(-15px);
        }
    }

</style>

<body data-spy="scroll" data-target=".navbar" data-offset="50" onload="myFunction()">
<?php include 'navbar.php';?>

<div class="parallax" style="background-image: url('img/Wise_Trans.svg'); height: 100%; min-height: 700px; background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="hero-text" style="text-align: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">
        <h1 class="animated rubberBand" style="font-size: 50px; margin-bottom: 20px;">TransWise Fleet Management System</h1>
        <p style="font-size: 20px;">A management system where you can easily manage vehicles</p>

        <?php if (isset($_SESSION['username']) == true) { ?>
            <a class="btn btn-primary btn-lg" href="booking.php" >
                Book a Vehicle
            </a>
        <?php } else { ?>
            <a class="btn btn-primary btn-lg" href="login.php" >
                Login To Book A Vehicle
            </a>
        <?php } ?>
    </div>
</div>

<div>
    <br><br>
    <div id="bus_route" class="container">
        <div class="page-header">
            <h2 style="text-align: center">Route Map</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><b>Your journey with us start from here</b></p>
                <img src="bus_aleksandr-popov.jpg" class="img-responsive">
            </div>
            <div class="col-md-6">
                <br>
                <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d7968.10796305025!2d101.74469636021317!3d3.0802652875815726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x31cc35aeedb3ae79%3A0x5a104ead29754df4!2sMRT%20Taman%20Connaught%20Pintu%20A%2C%20Kuala%20Lumpur%2C%20Federal%20Territory%20of%20Kuala%20Lumpur!3m2!1d3.078785!2d101.74606!4m5!1s0x31cc3552432c4f3d%3A0xe0a8533e39fe97bc!2sUCSI%20University%20Block%20C%2C%20BLOCK%20C%2C%20Taman%20Connaught%2C%20Kuala%20Lumpur%2C%20Federal%20Territory%20of%20Kuala%20Lumpur!3m2!1d3.0786813!2d101.7332642!5e0!3m2!1sar!2smy!4v1686531740574!5m2!1sar!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p>The Bus Route</p>
            </div>
        </div>
    </div>

    <br>
    <div class="page-header">
    </div>
    <div class="parallax1"></div>
    <div id="driver" class="container">

        <div class="row">
            <div class="col-md-12">

            </div>
        </div>

    </div>



    <div id="bus" class="container">
        <div class="page-header">
            <h2 style="text-align: center";>Our Mission </h2>
        </div>
        <div class="row">
            <div class="col-md-6">

                <img src="abdirisaq.jpg" class="img-responsive">
            </div>
            <div class="col-md-6">
                <p style="font-size:20px;"><b>Our mission is to provide our customers with a reliable and secure fleet management system that helps them improve efficiency, productivity, and compliance. We believe that a reliable and secure fleet management system is essential for any business that relies on vehicles. Our mission is to provide our customers with the best possible solution to help them improve their operations.</b></p>
            </div>

        </div>
    </div>



    <p></p>

</div>

<footer style="background-color: #2f2f2f;
        color: #fff; padding-top: 70px;
        padding-bottom: 70px;" class="container-fluid text-center">
    <p>All rights reserved by Abdirisaq</p>
</footer>


<script>
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".navbar-fixed-top");
            $a = $(".parallax");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $a.height());
        });
    });

</script>


<script>
    window.sr = ScrollReveal();
    sr.reveal('.foo', { duration: 800 });
    sr.reveal('.foo1', { duration: 800, origin: 'top' });
</script>

</body>
</html>
