<?php
include('include/auth.php');
include('include/dbConnect.php');
$balanceC = 0;


if (isset($_POST['doctor_name'], $_POST['doctor_place'], $_POST['doctor_phone'], $_POST['doctor_experience'],  $_POST['doctor_email'], $_POST['doctor_password']))
{
    $doctor_name = $_POST['doctor_name'];
    $doctor_place = $_POST['doctor_place'];
    $doctor_phone = $_POST['doctor_phone'];
    $doctor_experience = $_POST['doctor_experience'];
    $doctor_email = $_POST['doctor_email'];
    $doctor_password = $_POST['doctor_password'];
    $user_type = "doctor";

    $statement = $db->prepare('INSERT INTO orphanage_users  (name, user_type, email, password) VALUES (:name, :user_type, :email, :password)');
    $statement->execute(['name' => $doctor_name,'user_type' => $user_type,'email' => $doctor_email,'password' => $doctor_password]);

    $doctor_id = $db->lastInsertId();

    $statement1 = $db->prepare('INSERT INTO orphanage_doctors ( doctor_place, doctor_phone, doctor_experience, doctor_id) VALUES (:doctor_place, :doctor_phone, :doctor_experience, :doctor_id)');
    $statement1->execute(['doctor_place' => $doctor_place,'doctor_phone' => $doctor_phone,'doctor_experience' => $doctor_experience,'doctor_id' => $doctor_id]);


    header("location:doctors.php");
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
                                            <h3 class="text-center mb-0 me-1 w-100 text-white">ADD NEW DOCTOR</h3>
                                        </div>
                                    </div>
                                    <form method="post" action="newdoctor.php" autocomplete="off">
                                        <div class="card-body bg-dark pb-0">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Doctor Name</label>
                                                        <input type="text" name="doctor_name" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Place</label>
                                                        <input type="text" name="doctor_place" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Phone</label>
                                                        <input type="text" name="doctor_phone" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Experience</label>
                                                        <input type="text" name="doctor_experience" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Email</label>
                                                        <input type="email" name="doctor_email" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="text-white">Password</label>
                                                        <input type="password" name="doctor_password" class="form-control rounded-c" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center bg-dark">
                                            <div class="btn-group">
                                                <a href="dashboard.php" class="btn btn-danger text-white" style="border-radius: 2rem 0 0 2rem;">DASHBAORD</a>
                                                <a href="doctors.php" class="btn btn-warning text-white" style="border-radius: 0 0 0 0;">CANCEL</a>
                                                <button type="submit" name="submit" class="btn btn-success text-white" style="border-radius: 0 2rem 2rem 0;">SAVE</button>
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