<!-- 
DEVELOPER : SHREYASH WANJARI
MIT LICENSE APPLIED
GITHUB : https://github.com/ShreyashWanjari
WEBSITE : http://nxt.nxtdevelopers.xyz/
LINKEDIN : https://www.linkedin.com/in/shreyashwanjari/


 Made with ♥ by SHREYASH 
  -->
<?php

session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('hms/include/config.php');
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- 
    - primary meta tags
  -->
    <title>IITB HMS</title>
    <meta name="title" content="Doclab - home">
    <meta name="description" content="This is a madical html template made by codewithsadee">

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./assets/images/favicon.svg" type="image/svg+xml">

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- 
    - preload images
  -->
    <link rel="preload" as="image" href="./assets/images/hero-bg.png">

    <style>
        :root {
            --verdigris: #43BFC7;
            /* Define the --verdigris color */
        }

        .contact-us-single {
            color: var(--verdigris);
            /* Set the text color to verdigris */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .cop-ck {
            width: 100%;
            /* Adjust the width of the form as needed */
            max-width: 1000px;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
            width: 800px;
            background-color: #fff;
        }

        .cf-ro {
            margin-bottom: 15px;
        }

        .cf-ro label {
            display: block;
            margin-bottom: 5px;
        }

        .cf-ro input[type="text"],
        .cf-ro textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid var(--verdigris);
            border-radius: 5px;
        }

        .cf-ro textarea {
            resize: vertical;
        }

        .cf-ro button {
            width: 97.5%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: var(--verdigris);
            color: white;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .cop-ck {
                width: 90%;
            }
        }

        .social-link {
            color: #333;
            /* Dark color for the social icons */
        }

        /* Add this if you want to change the color on hover */
        .social-link:hover {
            color: #555;
            /* Darker color on hover */
        }

        .containerx {
            height: 300px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 4px 4px 30px rgba(0, 0, 0, .2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            gap: 5px;
            background-color: rgba(0, 110, 255, 0.041);
        }

        .headerx {
            flex: 1;
            width: 100%;
            border: 2px dashed royalblue;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .headerx svg {
            height: 100px;
        }

        .headerx p {
            text-align: center;
            color: black;
        }

        .footerx {
            background-color: rgba(0, 110, 255, 0.075);
            width: 100%;
            height: 40px;
            padding: 8px;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            color: black;
            border: none;
        }

        .footerx svg {
            height: 130%;
            fill: royalblue;
            background-color: rgba(70, 66, 66, 0.103);
            border-radius: 50%;
            padding: 2px;
            cursor: pointer;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.205);
        }

        .footerx p {
            flex: 1;
            text-align: center;
        }

        #file {
            display: none;
        }
    </style>

    <style>
        #image {
            display: none;
            /* Hide the default file input button */
        }

        .custom-file-upload {
            border: 2px solid #ccc;
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            background-color: #f5f5f5;
        }

        #image-label {
            display: inline-block;
            font-size: 16px;
            margin-bottom: 8px;
        }
    </style>

</head>

<body id="top" style="background-color: aliceblue;">

    <!-- 
    - #PRELOADER
  -->

    <div class="preloader" data-preloader>
        <div class="circle"></div>
    </div>





    <!-- 
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">

            <a href="#" class="logo">

                <div style="display: flex; align-items: center;">
                    <div style="position:flex; ">
                        <img src="./assets/images/logo.svg" width="136" height="46" alt="IITB home">
                    </div>
                    <h2 style="font-weight:bold; color:white; margin-top: 0; margin-bottom: 0; ">IIT Bombay HMS</h2>
                </div>

            </a>

            <nav class="navbar" data-navbar>

                <div class="navbar-top">

                    <a href="#" class="logo">
                        <img src="./assets/images/logo.svg" width="136" height="46" alt="IITB home">
                    </a>

                    <button class="nav-close-btn" aria-label="clsoe menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>

                </div>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a href="./" class="navbar-link title-md">Home</a>
                    </li>

                    <li class="navbar-item">
                        <a href="./logins.php" class="navbar-link title-md">Doctors</a>
                    </li>

                    <li class="navbar-item">
                        <a href="./logins.php" class="navbar-link title-md">Logins</a>
                    </li>

                    <li class="navbar-item">
                        <a href="./verification.php" class="navbar-link title-md">Auth</a>
                    </li>

                    <li class="navbar-item">
                        <a href="#contact_us" class="navbar-link title-md">Contact Us</a>
                    </li>

                </ul>

                <ul class="social-list">

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-pinterest"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-youtube"></ion-icon>
                        </a>
                    </li>

                </ul>

            </nav>

            <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <a href="./hms/patient/" class="btn has-before title-md">Make Appointment</a>

            <div class="overlay" data-nav-toggler data-overlay></div>

        </div>
    </header>





    <main>
        <article>





            <section class="section hero-thin" style="background-image: url('./assets/images/hero-bg.png')" aria-label="verification">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="headline-lg hero-title" data-reveal="left">
                            Pink Slip Verification
                        </h1>
                    </div>
                </div>
            </section>

            <div class="container main-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <!-- <h1>Verification</h1> -->
                            <h2>Select an image file to verify if it is a valid pink-slip.</h2>
                            <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                <p class="drag-drop-text" id="drag-text"> <br><br></p>
                                <!-- <input type="file" id="image" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)"> -->

                                <label id="image-label" for="image">Choose an image:</label>

                                <!-- Custom-styled file input -->
                                <label class="custom-file-upload" for="image">
                                    Browse
                                    <input type="file" id="image" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                                </label> <br>
                                <!-- Display the file name after selection (optional) -->
                                <span id="file-name"></span>
                                <br>




                            </div>
                            <button onclick="decryptImage()" class="btn btn-primary">Verify</button>
                            <br>
                            <img id="decrypted-image" style="display:none;">
                            <a id="decrypted-link" download="decrypted.png" class="download-btn" style="display:none;">Download decrypted image</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <h1>Pink Slip</h1>
                            <h4 name="decryption-metadata"></h4>
                            <img id="pinkslip" style="display:none; " alt="Pink Slip Image">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap JS (Assuming Bootstrap is used, adjust the path if needed) -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <!-- 
        - #SERVICE
      -->



            </div>

            <div class="footer-bottom" style="justify-content:center; color:black; ">

                <p class="text copyright">
                    &copy; IIT Bombay HMS 2022 | All Rights Reserved by NXT GEN : Shreyash
                </p>

                <ul class="social-list">

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-google"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="social-link">
                            <ion-icon name="logo-pinterest"></ion-icon>
                        </a>
                    </li>

                </ul>

            </div>


            </div>
            </footer>





            <!-- 
    - #BACK TO TOP
  -->

            <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
                <ion-icon name="chevron-up"></ion-icon>
            </a>





            <!-- 
    - custom js link
  -->
            <script src="/vendor/jquery/jquery.min.js"></script>
            <script src="./assets/js/script.js"></script>
            <script src="./assets/js/verification.js"></script>

            <!-- 
    - ionicon link
  -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script>
                // JavaScript to display the selected file name
                document.getElementById('image').addEventListener('change', function() {
                    document.getElementById('file-name').textContent = this.value.split('\\').pop();
                });
            </script>
</body>

</html>