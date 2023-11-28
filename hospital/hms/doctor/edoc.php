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
} else {
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
        <title> <?php echo $userTypeString; ?> | E Doc Management</title>



        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


        <meta name="description" content="" />
        <?php include('../include/csslinks.php'); ?>
        <link rel="stylesheet" href="/assets/css/edoc.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
        <!-- <link rel="stylesheet" href="./style.css"> -->
        <style>
            #pageCanvas {
                width: 100%;
                height: auto;
                max-width: 100%;
                /* Optional: set a maximum width if needed */
                display: block;
                /* Removes any default whitespace/spacing */
            }
        </style>
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <?php include('../include/counter.php'); ?>
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
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span>Edoc Management</h4>

                            <!-- <div class="col-xl">
                                <div class="card mb-4"> -->
                            <!-- <div class="card-body"> -->
                            <!-- <div id="main"> -->

                            <div class="card">
                                <div class="table-responsive text-nowrap" style="padding: 5%;">
                                    <p>E Doc Management</p>

                                    <h5>Document Editor</h5> <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                                        Editor
                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-primary" type="button" id="drawBtn">
                                        Draw
                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-primary" type="button" id="objecteraseBtn">
                                        Stroke Eraser
                                    </button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select id="background-select" onchange="setBackground(this.value) " style="width: 25%;">
                                        <option value="edoc/prototyp.png">Medical Information</option>
                                        <option value="edoc/prototype2.png">Appointment Request</option>
                                    </select>

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
                                                                    <div class="color-preset" style="background-color: blue" onclick="setColor('blue')"></div>
                                                                    <div class="color-preset" style="background-color: black" onclick="setColor('black')"></div>
                                                                    <div class="color-preset" style="background-color: red" onclick="setColor('red')"></div>

                                                                    <input type="color" id="colorPicker" onchange="setColor(this.value)" />
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
                                                                <button class="btn btn-primary" class="modeBtn current" id="drawBtn">Draw</button>
                                                                <button class="btn btn-primary" class="modeBtn" id="eraseBtn">Simple Eraser</button>

                                                            </li>
                                                            <li>
                                                                <button class="btn btn-outline-danger d-grid w-100" onclick="fabCanvas.cstmClearObjects()">Clear</button>
                                                            </li>
                                                            <li>
                                                                <button class="btn btn-primary" id="undoBtn">Undo</button>
                                                                <button class="btn btn-primary" id="redoBtn">Redo</button>
                                                            </li>
                                                            <li>

                                                                <label for="filenameInput">Filename:</label>
                                                                <input class="form-control" type="text" id="filenameInput" placeholder="Enter filename">
                                                                <br>
                                                            </li>
                                                            <li>

                                                                <button class="btn btn-outline-danger d-grid w-100" id="exportForm">Download</button>
                                                            </li>
                                                            <li>
                                                                <select id="background-select" onchange="setBackground(this.value)">
                                                                    <option value="edoc/prototyp.png">Medical Information</option>
                                                                    <option value="edoc/prototype2.png">Appointment Request</option>
                                                                </select>
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
        <script src="/assets/js/edoc/controls.js"></script>
        <?php include('../include/links.php'); ?>

        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });
        </script>


    </body>



    </html>



    </var>

<?php } ?>