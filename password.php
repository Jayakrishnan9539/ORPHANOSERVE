<?php
include("include/auth.php");
include('include/dbConnect.php');
$err = '';
$token = $_SESSION['SESS_USER_TOKEN'];

if (isset($_POST['cPassword'], $_POST['nPassword'], $_POST['rPassword'])) {
    $stmt = $db->prepare("SELECT * FROM users WHERE token = ? LIMIT 0,1");
    $stmt->bindParam(1, $token);
    $stmt->execute();
    $usercount = $stmt->rowCount();
    if ($usercount > 0) {
        $user_rows = $stmt->fetch(PDO::FETCH_ASSOC);
        if (trim($_POST['cPassword']) == $user_rows['password']) {
            if (trim($_POST['nPassword']) == trim($_POST['rPassword'])) {
                $nPassword = trim($_POST['nPassword']);
                $updateData = $db->prepare("UPDATE users SET password = :password WHERE token = :token");
                $updateData->bindParam(':password', $nPassword, PDO::PARAM_STR);
                $updateData->bindParam(':token', $token, PDO::PARAM_STR);
                $updateData->execute();
                $err = 'Password Updated.';
                header("location:logout.php");
            } else {
                $err = 'Repeat password is not matching.';
            }
        } else {
            $err = 'Current password is wrong.';
        }
    } else {
        $err = 'Somehting went wrong.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UPDATE PASSWORD | EBILL ONLINE</title>
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
    <style>
        .auth.lock-full-bg {
            background: url("../images/auth/lockscreen-bg2.jpg");
        }
    </style>
</head>

<body style="background-image: url('images/auth/lockscreen-bg2.jpg');">
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="p-5 text-center rounded-c" style="background-color: rgba(0,0,0,.75);">
                            <h1 class="text-white">UPDATE PASSWORD</h1>
                            <form class="pt-5" action="" method="post">
                                <div class="form-group">
                                    <input type="password" name="cPassword" placeholder="Current password" class="form-control rounded-c bg-dark text-center text-white" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="nPassword" placeholder="New password" class="form-control rounded-c bg-dark text-center text-white" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="rPassword" placeholder="Repeat new password" class="form-control rounded-c bg-dark text-center text-white" required>
                                </div>
                                <?php if ($err != '') {
                                    echo '<p class="text-danger text-center">' . $err . '</p>';
                                } ?>
                                <div class="mt-5">
                                    <button type="submit" name="submit" class="btn btn-block btn-success btn-lg rounded-c font-weight-medium w-50">UPDATE PASSWORD</button>
                                </div>
                                <br>
                                <a href="dashboard.php" class="text-white" style="text-decoration: none;">GO BACK</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
</body>

</html>