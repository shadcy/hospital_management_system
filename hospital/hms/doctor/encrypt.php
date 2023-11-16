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

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Doctor | Encryption</title>

        <?php include_once("../include/head_links.php");
        echo generate_head_links(); ?>


    </head>
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
            /* float:right; */
            margin-right: 300px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            max-width: 400px;
            width: 90%;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .download-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        img {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
        }





        @media only screen and (min-width: 768px) {
            .card {
                max-width: 600px;
            }
        }
    </style>

    <body>
        <div id="app">
            <?php include('include/sidebar.php'); ?>
            <div class="app-content">

                <?php include('../include/header.php'); ?>

                <!-- end: TOP NAVBAR -->
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <!-- start: PAGE TITLE -->
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Doctor | Encryption</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>User</span>
                                    </li>
                                    <li class="active">
                                        <span>Encryption</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <!-- end: PAGE TITLE -->
                        <!-- start: BASIC EXAMPLE -->
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="container">
                                    <div style="display: flex;">
                                        <div style="flex: 1;">
                                            <div class="card">
                                                <h1>Encryption</h1>
                                                <h2>Select an image file and enter a password to encrypt and decrypt the image.</h2>
                                                <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                                    <p class="drag-drop-text" id="drag-text"> <br><br></p>
                                                    <input type="file" id="image" onchange="previewImage()" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                                </div>
                                                <button onclick="encryptImage()">Encrypt</button>
                                                <button onclick="decryptImage()">Decrypt</button>
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

                                        <div style="flex: 1;">
                                            <div class="card">
                                                <h1>Image Preview</h1>
                                                <img id="preview" style="display:none; " alt="Default Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <?php include_once("../include/body_scripts.php") ?>
            <script src="/assets/js/encrypt.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

            <script>
                jQuery(document).ready(function() {
                    Main.init();
                    FormElements.init();
                });
            </script>
            <!-- end: JavaScript Event Handlers for this page -->
            <!-- end: CLIP-TWO JAVASCRIPTS -->
    </body>

    </html>
<?php } ?>