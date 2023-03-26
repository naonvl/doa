<?php
@session_start();
@error_reporting(E_ALL & ~E_NOTICE);
@ob_start();

include("app/include/sambung.php");
include("app/include/functions.php");
include("app/include/function_login.php");
//include("app/include/queryfunctions.php");

if (($_SESSION["logged"] == 1)) {
	header("Location: main.php");
}

?>

<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from travl.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Dec 2021 15:47:22 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Doa Ritel Dashboard Bootstrap 5 Template" />
    <meta property="og:title" content="Doa Ritel Dashboard Bootstrap 5 Template" />
    <meta property="og:description" content="Doa Ritel Dashboard Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Doa Ritel Login</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="#"><img src="images/logo-doa-mobile.png" style="width: 150px;height: auto;" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>User Name</strong></label>
                                            <input type="text" class="form-control" id="username" name="username" required value="">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" id="password" name="password" required value="">
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" name="login" id="login" value="Sign in" class="btn btn-primary btn-block" >
                                        </div>
                                    </form>

                                    <?php                               
                                        if (!empty($_POST["login"])){                                           
                                            switch($_POST["login"]){    
                                                case "Sign in":
                                                    Login();
                                                    break;
                                                case "Logout":
                                                    echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#0033CC\"><b>Session successful ended.</b></font></center>";
                                                    //setcookie("data_login","",time()-60);
                                                    //ob_start();
                                                    session_unset();
                                                    session_destroy();
                                                    header("Location: home.php");
                                                    break;  
                                            }
                                        } 
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

<!-- Mirrored from travl.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Dec 2021 15:47:22 GMT -->

</html>
