<?php
include('include/auth.php');
include('include/dbConnect.php');
//$driver_id=$_GET['driver_id'];
$driver_id=1;
$highspeed=array();
$created_at=array();
$qry = $db->prepare("SELECT * FROM driverbahaviour_drivers_history WHERE driver_id  = '" . $driver_id . "' ORDER BY created_at DESC LIMIT 0,5");
$qry->execute();
for ($i = 0; $row = $qry->fetch(); $i++) {
    $highspeed[] = $row['highspeed'];
    $created_at[]=$row['created_at'];
}

$highspeed=implode('","', $highspeed);
$highspeed='"'.$highspeed.'"';
$created_at=implode('","', $created_at);
$created_at='"'.$created_at.'"';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DRIVER BEHAVIOUR</title>
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body style="background-image: url('images/auth/lockscreen-bg2.jpg');">
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapsper p-0">
            <?php include("nav.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper" style="background-color: rgba(0,0,0,0);">
                    <div class="row">
                        
                            <div class="col-lg-8 offset-lg-2 grid-margin stretch-card">
                                <div class="card rounded-c overflow-hidden">
                                    <div class="card-header bg-dark pb-0">
                                        <div class="d-flex align-items-center mb-0 border-bottom pb-3">
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">DRIVER SPEED REPORT</h3>
                                        </div>
                                    </div>
                                    <div class="card-body bg-dark pb-0">
                                            <div class="row">
                                                <canvas id="myChart" style="max-width: 500px;" width="100%" height="100%"></canvas>
                                            </div>
                                        
                                        <div class="card-footer text-center bg-dark">
                                            <div class="btn-group">
                                                <a href="dashboard.php" class="btn btn-danger text-white" style="border-radius: 2rem 2rem 2rem 2rem;">DASHBAORD</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $created_at;?>],
          datasets: [{
            label: '# of UNITS',
            data: [<?php echo $highspeed;?>],
            backgroundColor: [
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255,99,132,1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
        });
    </script>
</body>

</html>