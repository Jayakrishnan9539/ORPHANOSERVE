<?php
include('include/auth.php');
include('include/dbConnect.php');
$orphanage_id=$_GET['orphanage_id'];
$qry_orphanage_users = $db->prepare("SELECT * FROM  orphanage_users WHERE id = '$orphanage_id'");
$qry_orphanage_users->execute();
$row = $qry_orphanage_users->fetch();

$qry_orphanage_details = $db->prepare("SELECT * FROM orphanage_orphanages WHERE orphanage_id='".$row['id']."'");
    $qry_orphanage_details->execute();
    $row1 = $qry_orphanage_details->fetch();

if (isset($_POST['id'], $_POST['orphanage_name'], $_POST['orphanage_email'], $_POST['orphanage_password'], $_POST['orphanage_phone'], $_POST['orphanage_place'], $_POST['orphanage_regno'], $_POST['orphanage_members'] )) {
    $orphanage_name = $_POST['orphanage_name'];
    $orphanage_email = $_POST['orphanage_email'];
    $orphanage_password = $_POST['orphanage_password'];
    $orphanage_phone = $_POST['orphanage_phone'];
    $orphanage_place = $_POST['orphanage_place'];
    $orphanage_regno = $_POST['orphanage_regno'];
    $orphanage_members = $_POST['orphanage_members'];
    $id = $_POST['id'];

    $stmt = $db->prepare("UPDATE orphanage_users SET name = :name, email = :email, password = :password WHERE id = :id");
    $stmt->execute([':name' => $orphanage_name,':email' => $orphanage_email, ':password' => $orphanage_password, ':id' => $id]);

    $stmt = $db->prepare("UPDATE orphanage_orphanages SET orphanage_phone = :orphanage_phone, orphanage_place = :orphanage_place, orphanage_regno = :orphanage_regno, orphanage_members = :orphanage_members WHERE orphanage_id = :id");
    $stmt->execute([':orphanage_phone' => $orphanage_phone,':orphanage_place' => $orphanage_place, ':orphanage_regno' => $orphanage_regno,':orphanage_members' => $orphanage_members, ':id' => $id]);

    header("location:orphanage.php");
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
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">EDIT ORPHANAGE</h3>
                                        </div>
                                    </div>
                                    <form method="post" action="editorphanage.php" autocomplete="off">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <div class="card-body bg-dark pb-0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Name</label>
                                                        <input type="text" name="orphanage_name" class="form-control rounded-c" value="<?php echo $row['name'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Email</label>
                                                        <input type="email" name="orphanage_email" class="form-control rounded-c" value="<?php echo $row['email'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Password</label>
                                                        <input type="password" name="orphanage_password" class="form-control rounded-c" value="<?php echo $row['password'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Phone</label>
                                                        <input type="number" name="orphanage_phone" class="form-control rounded-c" value="<?php echo $row1['orphanage_phone'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Place</label>
                                                        <input type="text" name="orphanage_place" class="form-control rounded-c" value="<?php echo $row1['orphanage_place'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Reg No</label>
                                                        <input type="text" name="orphanage_regno" class="form-control rounded-c" value="<?php echo $row1['orphanage_regno'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">No Of members</label>
                                                        <input type="text" name="orphanage_members" class="form-control rounded-c" value="<?php echo $row1['orphanage_members'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center bg-dark">
                                            <div class="btn-group">
                                                <a href="dashboard.php" class="btn btn-warning text-white" style="border-radius: 2rem 2rem 2rem 2rem;">DASHBAORD</a>&nbsp;
                                                <a href="orphanage.php" class="btn btn-danger text-white" style="border-radius: 2rem 2rem 2rem 2rem;">CANCEL</a>&nbsp;
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