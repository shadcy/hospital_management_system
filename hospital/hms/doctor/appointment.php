<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
}

if (!isset($_SESSION['current_appt_id'])) {
    echo "<script>alert('You do not have an ongoing appointment.');</script>";
    echo "<script>window.location.href = 'appointment-history.php'</script>";
    exit;
}

$doctorName = "";

$query = mysqli_execute_query($con, "select fullName from users where id=?", [$_SESSION['id']]);
while ($row = mysqli_fetch_array($query)) {
    $doctorName = $row['fullName']; // storing the value in the variable
}

$query = mysqli_execute_query($con, "select * from users where id=?", [$_SESSION['current_appt_pId']]);
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <?php
    $pageName = 'Ongoing Appointment';
    include('../include/new-header.php');
    ?>
    <link rel="stylesheet" href="/assets/css/edoc.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <script>
        var appointmentId = <?php echo $_SESSION['current_appt_id'] ?>;
        var patientId = <?php echo $_SESSION['current_appt_pId'] ?>;
        var apptTimestamp = <?php echo $_SESSION['current_appt_timestamp'] ?>;
        var patientInfo = <?php echo json_encode($row); ?>;
        var warnOnLeaving = true;
    </script>
    <style>
        #pageCanvas {
            width: 100%;
            height: auto;
            max-width: 100%;
            /* Optional: set a maximum width if needed */
            display: block;
            /* Removes any default whitespace/spacing */
        }

        .loading-indicator {
            display: none;
            /* Initially hide the loading indicator */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            /* Semi-transparent background */
            z-index: 9999;
        }

        .loader {
            border: 5px solid #f3f3f3;
            /* Light gray border */
            border-top: 5px solid #3498db;
            /* Blue border on top */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include('./include/nav.php'); ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include('../include/navbar.php'); ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div id="loadingIndicator" class="loading-indicator">
                        <div class="loader"></div>
                        <p>Loading...</p>
                    </div>

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>
                        <!-- <div class="col-xl">
                                <div class="card mb-4"> -->
                        <!-- <div class="card-body"> -->
                        <!-- <div id="main"> -->

                        <div class="card">
                            <div class="table-responsive text-nowrap" style="padding: 5%;">
                                <h5>Document Editor</h5> <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                                    Editor
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-primary modeBtn current" type="button" id="drawBtn">
                                    Draw
                                </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-primary modeBtn" type="button" id="objecteraseBtn">
                                    Stroke Eraser
                                </button>
                                <div class="grid-container">
                                    <canvas id="pageCanvas" width="1240%" height="1754%"> </canvas>
                                    <!-- Enable Scrolling & Backdrop Offcanvas -->
                                    <div class="col-lg-4 col-md-6">

                                        <div class="mt-3">

                                            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                                                <div class="offcanvas-header">
                                                    <h5 id="offcanvasBothLabel" class="offcanvas-title">Editor</h5>
                                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                                    <p class="text-center">
                                                        <!-- Options -->
                                                        <!-- <section class="options" style="padding: 1%"> -->
                                                    <ul>
                                                        <li>
                                                            <label for="strokeStyle">Line Colour</label>
                                                            <div name="strokeStyle" class="color-selector">
                                                                <div class="color-preset" style="background-color: blue" onclick="setColor(event,'blue')"></div>
                                                                <div class="color-preset selected" style="background-color: black" onclick="setColor(event,'black')"></div>
                                                                <div class="color-preset" style="background-color: red" onclick="setColor(event,'red')"></div>

                                                                <input type="color" id="colorPicker" onchange="setColor(event,this.value)" />
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <label for="lineWidth">Line Width</label>
                                                            <br>
                                                            <div name="lineWidth" class="stroke-selector">
                                                                <div name="lineWidth" class="stroke-selector-inner">
                                                                    <button class="btn btn-primary" onclick="setWidth(2)">Thin 🖋️</button>
                                                                    <button class="btn btn-primary" onclick="setWidth(5)">Medium 🖋️</button>
                                                                    <button class="btn btn-primary" onclick="setWidth(10)">Thick 🖋️</button>
                                                                </div>
                                                                <br>
                                                                <input type="range" name="lineWidth" min="1" max="100" value="5" oninput="setWidth(this.value)" />
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <button class="btn btn-primary modeBtn" id="eraseBtn">Simple Eraser</button>
                                                        </li>
                                                        <li>
                                                            <button class="btn btn-outline-danger d-grid w-100" onclick="fabCanvas.cstmClearObjects()">Clear</button>
                                                        </li>
                                                        <li>
                                                            <button class="btn btn-primary" id="undoBtn">Undo</button>
                                                            <button class="btn btn-primary" id="redoBtn">Redo</button>
                                                        </li>
                                                        <li>

                                                            <button class="btn btn-outline-danger d-grid w-100" id="exportForm">Submit</button>
                                                        </li>
                                                    </ul>
                                                    <!-- </section> -->


                                                    <!-- Options -->

                                                    <!--  -->




                                                    </p>

                                                    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Enable Scrolling & Backdrop Offcanvas -->
                                </div>
                            </div>

                            <!-- Edoc Management -->

                            <div class="content-backdrop fade"></div>

                            <!-- Content wrapper -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Layout page -->


            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>

    </div>
    </div>
    </div>
    <!-- Main JS -->
    <!-- start: PDF GEN JAVASCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
    <script src="/vendor/fabric/fabric.js"></script>
    <script src="/assets/js/edoc/fabric_extension.js"></script>
    <script src="/assets/js/edoc/main.js"></script>
    <script src="/assets/js/edoc/appt_controls.js"></script>
    <?php include('../include/links.php'); ?>

    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });

        var confirmationMessage = 'Are you sure you want to leave? Your changes will not be saved.';

        window.addEventListener('beforeunload', function(e) {
            // Display a warning message, if needed
            if (warnOnLeaving) {
                // Standard for most browsers
                (e || window.event).returnValue = confirmationMessage;

                // For some older browsers
                return confirmationMessage;
            }
        });
    </script>


</body>



</html>