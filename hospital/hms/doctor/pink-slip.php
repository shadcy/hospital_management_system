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
$doctorName = "";
if (isset($_SESSION['id'])) {
    $query = mysqli_execute_query($con, "select fullName from users where id=?", [$_SESSION['id']]);
    while ($row = mysqli_fetch_array($query)) {
        $doctorName = $row['fullName']; // storing the value in the variable
    }
}
?>





<?php $userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <?php
    $pageName = 'Pink Slip';
    include('../include/new-header.php');
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <link href="/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="PinkSlip_Gen/style.css" rel="stylesheet">

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
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span>Generate Pink Slip</h4>

                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">

                                    <div class="mainContainer">

                                        <div class="left">




                                            <form action="mail.php" method="post">
                                                <label for="studentroll">Student's Roll No:</label>
                                                <input type="text" name="studentroll" id="studentroll" required>
                                                <label for="achievement">Reason:</label>
                                                <input type="text" name="achievement" id="achievement" required>
                                                <label for="doctorname">Doctor's Name:</label>
                                                <input type="text" name="doctorname" id="doctorname" value="<?php echo $doctorName; ?>">
                                                <div class="row">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <div class="col-md-6">
                                                            <label for="fromDate">Valid from:</label>
                                                            <input type="text" class="form-control datepicker" id="fromDate" placeholder="Select From Date">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="toDate">To:</label>
                                                            <input type="text" class="form-control datepicker" id="toDate" placeholder="Select To Date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="btn-group btn-group-justified text-center">
                                                        <div class="col-md-6">
                                                            <button class="btn btn-primary btn-lg" type="button" onclick="generateCertificate()">
                                                                Preview
                                                            </button>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                                                                Generate
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                                                    <div class="offcanvas-header">
                                                        <h5 id="offcanvasBothLabel" class="offcanvas-title">IIT Bombay Hospital</h5>
                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <br>
                                                    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                                        <p class="text-center">

                                                            IIT Bombay Hospital Management System
                                                        <div class="format-selector">
                                                            <label for="format">Download Format:
                                                                <select id="format">
                                                                    <!-- <option value="pdf">PDF</option> -->
                                                                    <option value="png">PNG</option>
                                                                    <option value="jpeg">JPEG</option>
                                                                    <option value="pdf">PDF</option>
                                                                </select></label>
                                                        </div>
                                                        <br>
                                                        </p>
                                                        <button type="button" class="btn btn-primary mb-2 d-grid w-100" onclick="downloadCertificate()">Generate</button>


                                                        <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>


                                            <div id="signatureContainer">
                                                <canvas id="signatureCanvas" width="400" height="200"></canvas>
                                                <div id="signatureFooter">
                                                    <p id="signatureInstructions">Click and drag to sign</p><button id="clearCanvas" type="button" class="btn btn-secondary" onclick="clearSignatureCanvas()">Clear Signature</button>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                    <canvas id="pinkslip" width="800" height="600"></canvas>

                                </div>
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
    <script src="./PinkSlip_Gen/script_v2.js"></script>

    <?php include('../include/links.php'); ?>
    <?php include_once("../include/body_scripts.php") ?>

    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });

        $('.input-daterange').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: '-d'
        });
    </script>


</body>

</html>