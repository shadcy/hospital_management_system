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
}

$userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
    <title> <?php echo $userTypeString; ?> | Generate Pink Slip</title>

    <link rel="stylesheet" href="chatapi.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <script src="chatapi.js" defer></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <meta name="description" content="" />
    <?php include('../include/csslinks.php'); ?>

    <style>
        .chat-container {
            max-width: 90%;
            margin: 10% auto;
            padding: 2%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .chatbox {
            list-style: none;
            margin: 0;
            padding: 10px;

        }

        .chat {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .incoming {
            flex-direction: row;
        }

        .material-symbols-outlined {
            margin-right: 10px;
            font-size: 24px;
        }

        .chat p {
            margin: 0;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 8px;
        }

        .chat-input {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ccc;

        }

        textarea {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        .material-symbols-rounded {
            cursor: pointer;
            font-size: 24px;
            margin-left: 10px;
            color: #007bff;
        }
    </style>
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include('../include/counter.php'); ?>
            <?php include_once("./include/nav.php"); ?>

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span> NXT AI</h4>

                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">












                                    <ul class="chatbox">
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Hi there 👋<br>I am Doctor's AI health assistant <br>How can I help you?</p>
                                        </li>
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Shall I manage appointments for you? <a href="ambulance.php">Manage Appointments</a> </p>

                                        </li>
                                        <li class="chat incoming">
                                            <span class="material-symbols-outlined">smart_toy</span>
                                            <p>Drugs Info <a href="ambulance.php"> Info</a> </p>

                                        </li>
                                    </ul>
                                    <div class="chat-input">
                                        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
                                        <span id="send-btn" class="material-symbols-rounded">send</span>
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

<?php  ?>