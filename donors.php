<?php
//========================Code for database connection============================================
include('include/auth.php');
include('include/dbConnect.php');
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
                            <div class="col-lg-8 offset-lg-2 grid-margin stretch-card">
                                <div class="card rounded-c overflow-hidden">

                                    
                                    <div class="card-body bg-info pb-0">
                                        <div class="d-flex align-items-center mb-0 border-bottom pb-3">
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">DONOR DETAILS</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table bg-dark text-white table-bordered table-striped" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <h4>Name</h4>
                                                    </th>
                                                    <th scope="col">
                                                        <h4>phone</h4>
                                                    </th>
                                                    <th scope="col">
                                                        <h4>place</h4>
                                                    </th>
                                                    <th scope="col">
                                                        <h4>Age</h4>
                                                    </th>
                                                     
                                                    <th scope="col" width="30%">
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $qry_orphanage_users = $db->prepare("SELECT * FROM  orphanage_users WHERE user_type='donor'");
                                            $qry_orphanage_users->execute();

                                            for ($i = 0; $row = $qry_orphanage_users->fetch(); $i++) {

                                                $qry_orphanage_details = $db->prepare("SELECT * FROM orphanage_donors WHERE donor_id='".$row['id']."'");
                                                $qry_orphanage_details->execute();
                                                $row1 = $qry_orphanage_details->fetch();
                                            ?>
                                                <tr>
                                                    <th>
                                                        <h6 class="text-white"><?php echo $row['name'] ?></h6>
                                                    </th>
                                                    <th>
                                                        <h6 class="text-white"><?php echo $row1['donor_phone'] ?></h6>
                                                    </th>
                                                    <th>
                                                        <h6 class="text-white"><?php echo $row1['donor_place'] ?></h6>
                                                    </th>
                                                     <th>
                                                        <h6 class="text-white"><?php echo $row1['donor_age'] ?></h6>
                                                    </th>
                                                    
                                                    <th>
                                                        <h6>
                                                        <a href="editdonor.php?donor_id=<?php echo $row['id'] ?>" class="btn btn-primary" style="border-radius: 2rem 2rem 2rem 2rem;">EDIT</a>
                                                        <a href="viewdonor.php?donor_id=<?php echo $row['id'] ?>" class="btn btn-primary" style="border-radius: 2rem 2rem 2rem 2rem;">VIEW</a>




                                                        
                                                       
                                                       <a href="#" data-href="deletedonor.php?donor_id=<?php echo $row['id'] ?>" class="btn btn-danger" style="border-radius: 2rem 2rem 2rem 2rem;" data-bs-toggle="modal" data-bs-target="#donordelete">DELETE</a>
        </a>

                                                        </h6>
                                                    </th>
                                                    
                                                </tr>
                                            <?php 
                                                }
                                            ?>


                                           
                                        </table>
                                    </div>
                                    <div class="card-footer text-center bg-dark">
                                        <div class="btn-group">
                                            <a href="dashboard.php" class="btn btn-danger text-white" style="border-radius: 2rem 2rem 2rem 2rem;">DASHBOARD</a>&nbsp;
                                            <a href="newdonor.php" class="btn btn-primary" style="border-radius: 2rem 2rem 2rem 2rem;">ADD NEW DONOR</a>

                                           
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




<div class="modal fade" id="donordelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Are you sure?
            </div>
            <div class="modal-body">
                Do you really want to delete these records?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
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
        $('#donordelete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>