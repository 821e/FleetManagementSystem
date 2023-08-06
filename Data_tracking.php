<?php
$connection = mysqli_connect("localhost", "root", "", "vehicle management");

// Retrieve the vehicle data from the database
$sql = "SELECT * FROM `vehicle`";
$res = mysqli_query($connection, $sql);
$vehicles = mysqli_fetch_all($res, MYSQLI_ASSOC);

// Calculate total oil consumption and distance crossed for all vehicles
$totalOilConsumption = array_sum(array_column($vehicles, 'oil_consumption'));
$totalDistanceCrossed = array_sum(array_column($vehicles, 'distance_crossed'));

// Create arrays to hold the oil consumption and distance crossed data for all vehicles
$oilConsumptionData = array();
$distanceCrossedData = array();

foreach ($vehicles as $vehicle) {
    $oilConsumptionData[] = $vehicle['oil_consumption'];
    $distanceCrossedData[] = $vehicle['distance_crossed'];
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "Data updated successfully!";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Data Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">




    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 20px;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
             background: linear-gradient(90deg, rgb(19, 93, 93) 0%, rgb(44, 122, 124) 100%);
             padding: 20px;
             color: #fff;
             text-align: center;
             border-radius: 8px;

        }

        h4 {
            text-align: center;
            color: #006d77;
            margin-bottom: 10px;
        }

        hr {
            border-color: #ddd;
        }

        .row {
            margin-bottom: 30px;
        }

        .chart-container {
            max-height: 400px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }
    </style>
</head>

<body>
<div class="container">
    <?php include 'navbar_admin.php'; ?>

    <h2>Vehicle Data Analytics</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4>Enter Oil Consumption & Distance Crossed Data</h4>
            <form action="submit_data.php" method="post">
                <div class="form-group">
                    <label for="vehicle">Select Vehicle:</label>
                    <select class="form-control" name="veh_id" id="vehicle" required>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <option value="<?php echo $vehicle['veh_id']; ?>"><?php echo $vehicle['veh_reg']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="oil_consumption">Oil Consumption (Liters):</label>
                    <input type="number" class="form-control" name="oil_consumption" id="oil_consumption" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="distance_crossed">Distance Crossed (Kilometers):</label>
                    <input type="number" class="form-control" name="distance_crossed" id="distance_crossed" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Data</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 chart-container">
            <h4>Total Oil Consumption: <?php echo $totalOilConsumption; ?> Liters</h4>
            <canvas id="oilChart"></canvas>
        </div>
        <div class="col-md-6 chart-container">
            <h4>Total Distance Crossed: <?php echo $totalDistanceCrossed; ?> Kilometers</h4>
            <canvas id="distanceChart"></canvas>
        </div>
    </div>

    <hr>

    <div class="chart-container">
        <h4>Oil Consumption and Distance Crossed Comparison</h4>
        <canvas id="dataChart"></canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Data per Vehicle</h4>
        <table id="dataTable" class="display">
            <thead>
            <tr>
                <th>Vehicle Registration</th>
                <th>Oil Consumption (Liters)</th>
                <th>Distance Crossed (Kilometers)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($vehicles as $vehicle): ?>
                <tr>
                    <td><?php echo $vehicle['veh_reg']; ?></td>
                    <td><?php echo $vehicle['oil_consumption']; ?></td>
                    <td><?php echo $vehicle['distance_crossed']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Retrieve the oil consumption and distance crossed data from PHP variables
    var oilConsumptionData = <?php echo json_encode($oilConsumptionData); ?>;
    var distanceCrossedData = <?php echo json_encode($distanceCrossedData); ?>;

    // Get the chart canvas elements
    var oilChartCanvas = document.getElementById("oilChart").getContext("2d");
    var distanceChartCanvas = document.getElementById("distanceChart").getContext("2d");
    var dataChartCanvas = document.getElementById("dataChart").getContext("2d");

    // Create the oil consumption chart
    var oilChart = new Chart(oilChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($vehicles)); ?>,
            datasets: [{
                label: 'Oil Consumption (Liters)',
                data: oilConsumptionData,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create the distance crossed chart
    var distanceChart = new Chart(distanceChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($vehicles)); ?>,
            datasets: [{
                label: 'Distance Crossed (Kilometers)',
                data: distanceCrossedData,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create the data chart
    var dataChart = new Chart(dataChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($vehicles)); ?>,
            datasets: [{
                label: 'Oil Consumption (Liters)',
                data: oilConsumptionData,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Distance Crossed (Kilometers)',
                data: distanceCrossedData,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>

</body>

</html>
