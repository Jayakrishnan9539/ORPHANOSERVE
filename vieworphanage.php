<?php
session_start();
include('include/dbConnect.php');
$orphanage_id=$_GET['orphanage_id'];
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
                        <?php if ($_SESSION['SESS_USER_TYPE'] == 'admin') { ?>
                            <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 grid-margin stretch-card">
                                <div class="card rounded-c overflow-hidden">
                                    <div class="card-header bg-dark pb-0">
                                        <div class="d-flex align-items-center mb-0 border-bottom pb-3">
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">ORPHANAGE DETAILS</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="loadData" class="table bg-dark text-white table-bordered">
                                            <tbody>
                                                <?php
                                                $qry_orphanage_users = $db->prepare("SELECT * FROM  orphanage_users WHERE id = '$orphanage_id'");
                                                $qry_orphanage_users->execute();
                                                $row = $qry_orphanage_users->fetch();

                                                $qry_orphanage_details = $db->prepare("SELECT * FROM orphanage_orphanages WHERE orphanage_id='".$row['id']."'");
                                                    $qry_orphanage_details->execute();
                                                    $row1 = $qry_orphanage_details->fetch();
                                                ?>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">Name</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row['name'] ?></h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">Email</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row['email'] ?></h6>
                                                    </th>
                                                </tr><tr>
                                                    <th>
                                                        <h4 class="mb-0">Password</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row['password'] ?></h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">Phone</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row1['orphanage_phone'] ?></h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">Place</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row1['orphanage_place'] ?></h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">Reg no</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row1['orphanage_regno'] ?></h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <h4 class="mb-0">No Of Members</h4>
                                                    </th>
                                                    <th>
                                                        <h6 class="mb-0"><?php echo $row1['orphanage_members'] ?></h6>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    
                                        <div class="card-footer text-center bg-dark">
                                            <div class="btn-group">
                                                <a href="dashboard.php" class="btn btn-warning text-white" style="border-radius: 2rem 2rem 2rem 2rem;">DASHBOARD</a>&nbsp;
                                                <a href="orphanage.php" class="btn btn-danger text-white" style="border-radius: 2rem 2rem 2rem 2rem;">CANCEL</a>
                                                
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
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
