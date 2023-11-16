<?php
if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('./hms/include/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verification</title>

    <?php include_once("./hms/include/head_links.php");
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
        <div class="app-content">
            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Verification</h1>
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
                                            <h1>Verification</h1>
                                            <h2>Select an image file to verify if it is a valid pink-slip.</h2>
                                            <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                                <p class="drag-drop-text" id="drag-text"> <br><br></p>
                                                <input type="file" id="image" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                            </div>
                                            <button onclick="decryptImage()">Verify</button>
                                            <br>
                                            <img id="decrypted-image" style="display:none;">
                                            <a id="decrypted-link" download="decrypted.png" class="download-btn" style="display:none;">Download decrypted
                                                image</a>
                                        </div>
                                    </div>

                                    <div style="flex: 1;">
                                        <div class="card">
                                            <h1>Pink Slip</h1>
                                            <h4 name="decryption-metadata"></h4>
                                            <img id="pinkslip" style="display:none; " alt="Pink Slip Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start: FOOTER -->
            <?php include('./hms/include/footer.php'); ?>
            <!-- end: FOOTER -->

            <!-- end: SETTINGS -->
        </div>
        <?php include_once("./hms/include/body_scripts.php") ?>
        <script src="/assets/js/verification.js"></script>

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