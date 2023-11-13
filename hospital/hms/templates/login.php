<!DOCTYPE html>
<html lang="en">
<?php $userTypeString = UserTypeAsString[$userType] ?>

<head>
    <title><?= $userTypeString ?> Login</title>

    <?php include_once("../include/head_links.php");
    echo generate_head_links("3", true); ?>
</head>

<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo margin-top-30">
                <a href="../../index.php">
                    <h2>IITB HMS | <?= $userTypeString ?> Login</h2>
                </a>
            </div>

            <div class="box-login">
                <form class="form-login" method="post">
                    <fieldset>
                        <legend>
                            Sign in to your account
                        </legend>
                        <p>
                            Please enter your name and password to log in.<br />
                            <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg'] = ""; ?></span>
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username">
                                <i class="fa fa-user"></i> </span>
                        </div>
                        <div class="form-group form-actions">
                            <span class="input-icon">
                                <input type="password" class="form-control password" name="password" placeholder="Password">
                                <i class="fa fa-lock"></i>
                            </span>
                            <a href="forgot-password.php">
                                Forgot Password ?
                            </a>
                        </div>
                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary pull-right" name="submit">
                                Login <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>


                    </fieldset>
                </form>

                <div class="copyright">
                    <span class="text-bold text-uppercase">IITB Hospital Management System</span>
                </div>

            </div>

        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/modernizr/modernizr.js"></script>
    <script src="../vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../vendor/switchery/switchery.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>

</body>
<!-- end: BODY -->

</html>