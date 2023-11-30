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
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Doctor | Dashboard</title>

        <?php include_once("../include/head_links.php");
        echo generate_head_links(); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
        <!-- <link rel="stylesheet" href="./style.css"> -->
        <style>
            .mainContainer {
                display: absolute;
                justify-content: left;
                background-color: #f0f0f0;
            }

            h1 {
                text-align: center;
                color: #333;

            }

            a {
                text-decoration: none;
                color: black;
            }

            form {

                max-width: 450px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

            label {
                display: block;
                margin-bottom: 10px;
                color: #333;
            }

            input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-bottom: 20px;
            }

            .button-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .format-selector {
                margin-top: 10px;
                margin: 10px;
            }


            #pinkslip {
                display: block;
                margin: 50px auto;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                background-image: url('/assets/images/pink_slip.png');
                /* Replace 'path_to_your_image.jpg' with the actual path to your image */
                background-size: 100% 100%;
                background-position: center;
                background-origin: content-box;
                padding: 10px;
                background-repeat: no-repeat;

            }


            .certificate-title {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }

            .recipient-name {
                font-size: 20px;
                text-align: center;
                margin-bottom: 10px;
            }

            .achievement {
                font-size: 18px;
                text-align: center;
                margin-bottom: 30px;
            }

            .signature {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }

            .signature img {
                width: 200px;
                height: 100px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .date {
                text-align: right;
                font-style: italic;
                color: #888;
            }

            #signatureContainer {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 10px;
                text-align: center;

            }

            #signatureCanvas {
                border: 1px solid #ccc;
                background: #fff;
                background-image: url('./assets/images/sign_limit.png');
                border-radius: 4px;
                margin: 10px auto;


            }

            #signatureFooter {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
            }

            #signatureInstructions {
                color: black;
                font-style: italic;
                margin-top: 10px;
            }

            .left {
                float: left;
                padding: 20px;
            }

            .right {
                position: flex;
                left: 100px;
                /* Adjust this value according to your needs */



            }

            button {
                /* padding: 10px 20px;
				b-color: black;
				color: #fff;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			    font-size: 16px; */
                /* transition: background-color 0.3s;  */
                border-radius: 4px;
                border-color: #1AA7EC;
                background-color: white;

            }

            button#clearCanvas {
                padding: 10px 20px;
                background-color: salmon;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                border-radius: 4px;
            }
        </style>
    </head>

    <body>
        <div id="app">
            <?php include('include/sidebar.php'); ?>
            <div class="app-content">

                <?php include('../include/header.php'); ?>

                <!-- end: TOP NAVBAR -->
                <div class="main-content">
                    <div class="wrap-content container" id="container" style="background-color:#d3d3d3;">
                        <!-- start: PAGE TITLE -->
                        <!-- <section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Doctor | Dashboard</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section> -->
                        <!-- end: PAGE TITLE -->
                        <div class="mainContainer">

                            <div class="left">




                                <form action="mail.php" method="post">
                                    <label for="studentroll">Student's Roll No:</label>
                                    <input type="text" id="studentroll" required>
                                    <label for="achievement">Reason:</label>
                                    <input type="text" id="achievement" required>
                                    <label for="doctorname">Doctor's Name:</label>
                                    <input type="text" id="doctorname" value="<?php echo $doctorName; ?>">
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
                                    <div class="button-container">
                                        <button type="button" onclick="generateCertificate()">Preview Certificate</button>
                                        <div class="format-selector">
                                            <label for="format">Download Format:</label>
                                            <select id="format">
                                                <!-- <option value="pdf">PDF</option> -->
                                                <option value="png">PNG</option>
                                                <option value="jpeg">JPEG</option>
                                            </select>
                                        </div>
                                        <button id="downloadButton" type="button" onclick="downloadCertificate()">Generate
                                            Certificate</button>
                                    </div>
                                </form>





                                <div id="signatureContainer">
                                    <canvas id="signatureCanvas" width="400" height="200"></canvas>
                                    <div id="signatureFooter">
                                        <p id="signatureInstructions">Click and drag to sign</p><button id="clearCanvas" type="button" onclick="clearSignatureCanvas()">Clear Signature</button>
                                    </div>
                                </div>
                            </div>



                        </div>




                        <canvas id="pinkslip" width="800" height="600"></canvas>



                    </div>
                </div>
            </div>
            <!-- start: FOOTER -->
            <?php include('../include/footer.php'); ?>
            <!-- end: FOOTER -->

            <!-- start: SETTINGS -->
            <?php include('../include/setting.php'); ?>

            <!-- end: SETTINGS -->

        </div>




        <!-- start: PDF GEN JAVASCRIPTS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
        <!-- partial -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
        <script src="./PinkSlip_Gen/script_v2.js"></script>


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
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->
    </body>

    </html>
<?php } ?>