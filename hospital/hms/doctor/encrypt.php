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

?>



<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


<head>
    <?php
    $pageName = 'Encryption';
    include('../include/new-header.php');
    ?>
    <style>
        .drag-drop-area {
            width: 100%;
            height: 100px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .drag-drop-text {
            color: #999;
        }

        .card {

            margin-right: 300px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            max-width: 400px;
            width: 90%;
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>

                        <h1>Encryption</h1>
                        <h2>Select an image file and enter a password to encrypt and decrypt the image.</h2>
                        <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                            <p class="drag-drop-text" id="drag-text"> <br><br></p>
                            <input type="file" id="image" onchange="previewImage()" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                        </div>
                        <br>

                        <button class="btn btn-primary" onclick="encryptImage()">Encrypt Image</button>
                        <br><br>
                        <button class="btn btn-secondary" onclick="decryptImage()">Decrypt Image</button>
                        <br>
                        <img id="encrypted-image" style="display:none;">
                        <a id="encrypted-link" download="encrypted.png" class="download-btn" style="display:none;">Download encrypted
                            image</a>
                        <br>
                        <img id="decrypted-image" style="display:none;">
                        <a id="decrypted-link" download="decrypted.png" class="download-btn" style="display:none;">Download decrypted
                            image</a>
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
    <?php include_once("../include/body_scripts.php") ?>
    <script src="/assets/js/encrypt.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
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