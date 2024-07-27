<?php
session_start();
if (isset($_SESSION['SESS_USER_TOKEN']) && trim($_SESSION['SESS_USER_TOKEN']) != '') {
    header("location: dashboard.php");
}

$err = '';
if (isset($_GET['signout'])) {
    $err = 'Signed out successfully';
} elseif (isset($_GET['expired'])) {
    $err = 'Session expired, please login again.';
}
if (isset($_POST['submit'], $_POST['email'], $_POST['password'])) {
    include('include/dbConnect.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $qryadmn = $db->prepare("SELECT * FROM orphanage_users WHERE email = '$email' AND password = '$password'");
    $qryadmn->execute();
    if ($qryadmn->rowcount() > 0) {
        $rowadmn = $qryadmn->fetch();
        $_SESSION['SESS_USER_ID'] = $rowadmn['id'];
        $_SESSION['SESS_USER_TOKEN'] = $rowadmn['token'];
        $_SESSION['SESS_USER_NAME'] = $rowadmn['name'];
        $_SESSION['SESS_USER_TYPE'] = $rowadmn['user_type'];
        $_SESSION['SESS_USER_EMAIL'] = $rowadmn['email'];
        header("location: dashboard.php");
        exit();
    } else {
        $err = 'Username or password is wrong! Try Again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ORPHANAGE</title>
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="p-5 text-center rounded-c" style="background-color: rgba(0,0,0,.75);">
                            <h1 class="text-white">ORPHANAGE</h1>
                            <form class="pt-5" action="" method="post" autocomplete="off">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control rounded-c bg-dark text-center text-white" placeholder="Enter username" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control rounded-c bg-dark text-center text-white" placeholder="Enter password" required>
                                </div>
                                <?php if ($err != '') {
                                    echo '<p class="text-danger text-center">' . $err . '</p>';
                                } ?>
                                <div class="mt-2">
                                    <button type="submit" name="submit" class="btn btn-block rounded-c btn-dark btn-lg font-weight-medium text-white">LOGIN TO ORPHANAGE</button>
                                </div>
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