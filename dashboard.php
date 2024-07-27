<?php
include('include/auth.php');
include('include/dbConnect.php');
$balanceC = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ORPHANAGE</title>
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
                        <?php if ($_SESSION['SESS_USER_TYPE'] == 'orphanage') { ?>
                            <div class="col-lg-4 offset-lg-4 grid-margin stretch-card">
                                <div class="card rounded-c overflow-hidden">
                                    <div class="card-body bg-warning pb-0">
                                        <div class="d-flex align-items-center mb-0 border-bottom pb-3">
                                            <h3 class="text-center mb-0 me-1 w-100">ORPHANAGE</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table bg-dark text-white table-bordered table-striped">
                                            <thead id="loadData">
                                                <tr>
                                                    <th colspan="2" style="text-align: center; background:#3b3a3d">
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                function autoRefresh() {
                                    $("#loadData").load("user.php");
                                }
                                setInterval('autoRefresh()', 2000);
                            </script>
                        <?php } elseif ($_SESSION['SESS_USER_TYPE'] == 'admin') { ?>
                            <div class="col-lg-8 offset-lg-2 grid-margin stretch-card">
                                <div class="card rounded-c overflow-hidden">

                                    
                                    <div class="card-body bg-info pb-0">
                                        <div class="d-flex align-items-center mb-0 border-bottom pb-3">
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">ORPAHANAGE</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table  id="loadData" class="table bg-dark text-white table-bordered table-striped">
                                            
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
<!--                                     <div class="card-footer text-center bg-dark">
                                        <div class="btn-group">
                                            <a href="newdriver.php" class="btn btn-primary" style="border-radius: 2rem 2rem 2rem 2rem;">ADD NEW DRIVER</a>
                                           
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <script>
                                function autoRefresh() {
                                    $("#loadData").load("admin.php");
                                }
                                setInterval('autoRefresh()', 2000);
                            </script>
                        <?php } ?>
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
</body>
</html>