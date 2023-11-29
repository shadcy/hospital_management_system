<?php
// Get the requested URL path
$requestPath = $_SERVER['REQUEST_URI'];

// Define the patterns for admin, doctor, and patient URLs
$adminPattern = '/hms/admin/';
$doctorPattern = '/hms/doctor/';
$patientPattern = '/hms/patient/';

$hmsMatch = true;
// Check if the requested path matches any of the patterns
if (strpos($requestPath, $adminPattern) === 0) {
    $redirectURL = $adminPattern . 'dashboard.php';
} elseif (strpos($requestPath, $doctorPattern) === 0) {
    $redirectURL = $doctorPattern . 'dashboard.php';
} elseif (strpos($requestPath, $patientPattern) === 0) {
    $redirectURL = $patientPattern . 'dashboard.php';
} else {
    $redirectURL = '/';
    $hmsMatch = false;
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Error 404</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets2/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets2/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets2/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets2/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets2/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/assets2/vendor/css/pages/page-misc.css" />
    <!-- Helpers -->
    <script src="/assets2/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets2/js/config.js"></script>
</head>

<body>
    <!-- Content -->










    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <title>Download Our App</title>
    </head>

    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Your App Name</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Download App</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Download App Section -->
        <section class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Download Our App</h2>
                    <p>Get the latest and greatest features by downloading our app today!</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-primary">Download for iOS</a>
                        <a href="#" class="btn btn-success">Download for Android</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Add an image of your app or any relevant image here -->
                    <img src="app-screenshot.png" alt="App Screenshot" class="img-fluid">
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-dark text-light text-center py-3">
            <p>&copy; 2023 Your App Name. All rights reserved.</p>
        </footer>

        <!-- Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </body>

    </html>




































    <!-- / Content -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets2/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets2/vendor/libs/popper/popper.js"></script>
    <script src="/assets2/vendor/js/bootstrap.js"></script>
    <script src="/assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets2/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets2/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>