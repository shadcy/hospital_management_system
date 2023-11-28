<!DOCTYPE html>
<html lang="en">
<?php $userTypeString = UserTypeAsString[$userType] ?>

<head>
    <title><?= $userTypeString ?> Login</title>


    <?php include_once("../include/csslinks.php");
    ?>
</head>

<body>

    <!-- Register -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner" style="padding: 10%;">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->

                        <!-- /Logo -->
                        <h4 class="mb-2">Hey <?= $userTypeString ?> ! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg'] = ""; ?></span>
                        <form id="formAuthentication" class="form-login" method="post">
                            <div class="form-group">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="username" placeholder="Enter your username" autofocus />
                            </div>
                            <br>
                            <div class="form-group form-actions">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="forgot-password.php">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control password" name="password" placeholder="Password" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-primary d-grid w-100" type="submit" name="submit">Sign in</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="#">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->





                <?php include_once("../include/links.php"); ?>

                <script>
                    jQuery(document).ready(function() {
                        Main.init();
                        Login.init();
                    });
                </script>
            </div>
        </div>
    </div>

</body>
<!-- end: BODY -->

</html>