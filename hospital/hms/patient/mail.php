<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
} else {
    $doctorName = "";
    if (isset($_SESSION['id'])) {
        $query = mysqli_execute_query($con, "select fullName from users where id=?", [$_SESSION['id']]);
        $doctorName = "";
        while ($row = mysqli_fetch_array($query)) {
            $doctorName = $row['fullName']; // storing the value in the variable
        }
    }
?>

    <?php $userTypeString = UserTypeAsString[$userType] ?>
    <!DOCTYPE html>


    <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


    <head>
        <title> <?php echo $userTypeString; ?> | Mail</title>



        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


        <meta name="description" content="" />
        <?php include('../include/csslinks.php'); ?>



        <style>
            form {
                width: 100%;
                max-width: 4000px;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;

            }



            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #d1d1d1;
                border-radius: 5px;
            }




            #file {
                border: 2px dashed #bbb;
                border-radius: 5px;
                padding: 45px;
                text-align: center;
                font-family: Arial;
                color: #bbb;
                cursor: pointer;
            }

            #file.dragover {
                border-color: #000;
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
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>HMS Mail</h4>








                            <div>
                                <div>
                                    <form class="" action="send.php" method="post" enctype="multipart/form-data">

                                        <br>

                                        <label for="email" style="color: black;">Email</label><br>
                                        <input type="text" id="email" name="email" value=""><br><br>

                                        <label for="subject" style="color: black;">Subject</label><br>
                                        <input type="text" id="subject" name="subject" value="IIT Bombay Hospital"><br><br>

                                        <label for="message" style="color: black;">Message</label><br>

                                        <textarea id="message" name="message" class="form-control" style="height:28rem;">
        Dear Professor [Professor's Last Name],

        I hope this message finds you well.

        I am writing to inform you about my health condition, which unfortunately requires me to take a temporary leave from classes. [Explain your health issue concisely].

        I kindly request your understanding and support during this time. Please find attached any necessary documentation regarding my condition.

        Thank you for your attention to this matter.

        Sincerely,
        [Your Name]
        [Your Contact Information]
    </textarea><br><br>

                                        <br><br>

                                        <label for="file" style="color: black;">Choose a file to upload:</label><br>
                                        <input type="file" id="file" name="file"><br><br>

                                        <button class="btn btn-primary" type="submit" name="send">Send</button>
                                    </form>
                                </div>


                            </div>

                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- Main JS -->

            <?php include('../include/links.php'); ?>

            <?php include_once("../include/body_scripts.php") ?>
            <script>
                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });
            </script>


    </body>



    </html>

<?php } ?>