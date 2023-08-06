<?php
$connection = mysqli_connect("localhost", "root", "", "vehicle management");

session_start();

$veh_id = $_GET['busid'];

$sql = "SELECT * FROM `vehicle` WHERE veh_id='$veh_id' OR veh_reg='$veh_id'";
$res = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($res);

// Retrieve the oil consumption and distance crossed data from PHP variables
$oilConsumption = $row['oil_consumption'];
$distanceCrossed = $row['distance_crossed'];

// Call the function to update the charts with the retrieved data
echo '<script>updateCharts();</script>';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Management System</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<?php include 'navbar.php'; ?>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;"></div>

<div class="container">
    <div class="row">
        <div class="fb-profile-text" id="h1">
            <h2><?php echo $row['veh_reg']; ?></h2>
        </div>
        <hr>
        <div class="col-sm-3">
            <div class="fb-profile">
                <img height="250" width="250" align="left" class="fb-image-profile thumbnail userpic"
                     src="vehicle picture/<?php echo $row['veh_photo'] ?>" alt="dp" />
            </div>
        </div>

        <div class="col-sm-9">
            <div data-spy="scroll" class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_default_1" data-toggle="tab">About Vehicle</a>
                        </li>
                        <li>
                            <a href="#tab_default_2" data-toggle="tab">Oil Consumption & Distance</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <h4><strong>Brand</strong></h4>
                            <p><?php echo $row['brand']; ?></p>

                            <h4><strong>Color</strong></h4>
                            <p><?php echo $row['veh_color']; ?></p>

                            <h4><strong>Registration No</strong></h4>
                            <p><?php echo $row['veh_reg']; ?></p>

                            <h4><strong>Type</strong></h4>
                            <p><?php echo $row['veh_type']; ?></p>

                            <h4><strong>Chesis No</strong></h4>
                            <p><?php echo $row['chesisno']; ?></p>

                            <h4><strong>Vehicle Registration Date</strong></h4>
                            <p><?php echo $row['veh_regdate']; ?></p>

                            <h4><strong>Description</strong></h4>
                            <p><?php echo $row['veh_description']; ?></p>
                        </div>
                        <div class="tab-pane" id="tab_default_2">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Oil Consumption (Liters)</h4>
                                    <canvas id="oilChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <h4>Distance Crossed (Kilometers)</h4>
                                    <canvas id="distanceChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-sm-12">

    </div>
</div>

<script>
    // Retrieve the oil consumption and distance crossed data from PHP variables
    var oilConsumption = <?php echo $row['oil_consumption']; ?>;
    var distanceCrossed = <?php echo $row['distance_crossed']; ?>;

    // Get the chart canvas elements
    var oilChartCanvas = document.getElementById("oilChart").getContext("2d");
    var distanceChartCanvas = document.getElementById("distanceChart").getContext("2d");

    // Create the oil consumption chart
    var oilChart = new Chart(oilChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Oil Consumption'],
            datasets: [{
                label: 'Liters',
                data: [oilConsumption],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Liters'
                    }
                }
            }
        }
    });

    // Create the distance crossed chart
    var distanceChart = new Chart(distanceChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Distance Crossed'],
            datasets: [{
                label: 'Kilometers',
                data: [distanceCrossed],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Kilometers'
                    }
                }
            }
        }
    });

    // Update the chart data and redraw the charts when the values change
    function updateCharts() {
        oilChart.data.datasets[0].data[0] = oilConsumption;
        distanceChart.data.datasets[0].data[0] = distanceCrossed;
        oilChart.update();
        distanceChart.update();
    }
</script>


</body>

</html>
