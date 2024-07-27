<?php
include('include/auth.php');
include('include/dbConnect.php');
$donor_id=$_GET['donor_id'];
$qry_orphanage_users = $db->prepare("SELECT * FROM  orphanage_users WHERE id = '$donor_id'");
$qry_orphanage_users->execute();
$row = $qry_orphanage_users->fetch();

$qry_orphanage_details = $db->prepare("SELECT * FROM orphanage_donors WHERE donor_id='".$row['id']."'");
    $qry_orphanage_details->execute();
    $row1 = $qry_orphanage_details->fetch();

if (isset($_POST['id'], $_POST['donor_name'], $_POST['donor_email'], $_POST['donor_password'], $_POST['donor_phone'], $_POST['donor_place'], $_POST['donor_age'] )) {
    $donor_name = $_POST['donor_name'];
    $donor_email = $_POST['donor_email'];
    $donor_password = $_POST['donor_password'];
    $donor_phone = $_POST['donor_phone'];
    $donor_place = $_POST['donor_place'];
    $donor_age = $_POST['donor_age'];
    $id = $_POST['id'];

    $stmt = $db->prepare("UPDATE orphanage_users SET name = :name, email = :email, password = :password WHERE id = :id");
    $stmt->execute([':name' => $donor_name,':email' => $donor_email, ':password' => $donor_password, ':id' => $id]);

    $stmt = $db->prepare("UPDATE orphanage_donors SET donor_phone = :donor_phone, donor_place = :donor_place, donor_age = :donor_age WHERE donor_id = :id");
    $stmt->execute([':donor_phone' => $donor_phone,':donor_place' => $donor_place, ':donor_age' => $donor_age, ':id' => $id]);

    header("location:donors.php");
}
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
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">EDIT DONOR</h3>
                                        </div>
                                    </div>
                                    <form method="post" action="editdonor.php" autocomplete="off">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <div class="card-body bg-dark pb-0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Name</label>
                                                        <input type="text" name="donor_name" class="form-control rounded-c" value="<?php echo $row['name'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Email</label>
                                                        <input type="email" name="donor_email" class="form-control rounded-c" value="<?php echo $row['email'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Password</label>
                                                        <input type="password" name="donor_password" class="form-control rounded-c" value="<?php echo $row['password'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Phone</label>
                                                        <input type="text" name="donor_phone" class="form-control rounded-c" value="<?php echo $row1['donor_phone'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Place</label>
                                                        <input type="text" name="donor_place" class="form-control rounded-c" value="<?php echo $row1['donor_place'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Age</label>
                                                        <input type="text" name="donor_age" class="form-control rounded-c" value="<?php echo $row1['donor_age'] ?>" required>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer text-center bg-dark">
                                            <div class="btn-group">
                                                <a href="dashboard.php" class="btn btn-warning text-white" style="border-radius: 2rem 2rem 2rem 2rem;">DASHBAORD</a>&nbsp;
                                                <a href="donors.php" class="btn btn-danger text-white" style="border-radius: 2rem 2rem 2rem 2rem;">CANCEL</a>&nbsp;
                                                <button type="submit" name="submit" class="btn btn-success text-white" style="border-radius: 2rem 2rem 2rem 2rem;">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
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