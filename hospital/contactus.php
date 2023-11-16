<!-- 
DEVELOPER : SHREYASH WANJARI
MIT LICENSE APPLIED
GITHUB : https://github.com/ShreyashWanjari
WEBSITE : http://nxt.nxtdevelopers.xyz/
LINKEDIN : https://www.linkedin.com/in/shreyashwanjari/


 Made with ♥ by SHREYASH 
  -->
<!-- <?php
        include_once('hms/include/config.php');
        if (isset($_POST['submit'])) {
            $name = $_POST['fullname'];
            $email = $_POST['emailid'];
            $mobileno = $_POST['mobileno'];
            $description = $_POST['description'];
            $query = mysqli_execute_query($con, "insert into contact_us(fullName,email,contactNumber,message) value(?,?,?,?)", [$name, $email, $mobileno, $description]); #Done2
            echo "<script>alert('Your information succesfully submitted');</script>";
            echo "<script>window.location.href = 'index.php'</script>";
        } ?> -->
<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include("../include/config.php");

$userType = UserTypeEnum::Patient->value;

if (isset($_SESSION['id']) && $_SESSION['userType'] === $userType) {
    header("location:dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $puname = $_POST['username'];
    $ppwd = md5($_POST['password']);
    $ret = mysqli_execute_query($con, "SELECT * FROM users WHERE email=? and password=? and type = ? and isActive = 1;", [$puname, $ppwd, $userType]);
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['userType'] = $userType;
        $_SESSION['name'] = $num['fullName'];
        $pid = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        // For stroing log if user login successfull
        mysqli_execute_query($con, "insert into logs(userId,username,ip,status,type) values(?,?,?,?,?)", [$pid, $puname, $uip, $status, $userType]);
        header("location:dashboard.php");
    } else {
        // For stroing log if user login unsuccessfull
        $_SESSION['login'] = $_POST['username'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        mysqli_execute_query($con, "insert into logs(username,ip,status,type) values(?,?,?,?)", [$puname, $uip, $status, $userType]);
        $_SESSION['errmsg'] = "Invalid username or password";

        header("location:");
    }
}
?>


<?php include_once("../templates/login.php"); ?>



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
    <link rel="preload" as="image" href="./assets/images/hero-banner.png">
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





            <section class="section hero" style="background-image: url('./assets/images/hero-bg.png')" aria-label="verification">
                <div class="container">

                    <div class="hero-content">

                        <h1 class="headline-lg hero-title" data-reveal="left">
                            Pink Slip Verification <br>
                            Hospital Portal
                        </h1>



                    </div>

                </div>
            </section>










            <section id="contact_us" class="contact-us-single" style="color: var(--verdigris); background: linear-gradient(to bottom,#fff, var(--verdigris), var(--midnight-green));
">
                <div class="row no-margin">

                    <div class="col-sm-12 cop-ck">
                        <form method="post">
                            <h2 style="font-weight:bold; color: var(--verdigris);">Contact Form</h2>
                            <div class="row cf-ro">
                                <div class="col-sm-3"><label>Enter Name :</label></div>
                                <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="fullname" class="form-control input-sm" required style="border-color: var(--verdigris);"></div>
                            </div>
                            <div class="row cf-ro">
                                <div class="col-sm-3"><label>Email Address :</label></div>
                                <div class="col-sm-8"><input type="text" name="emailid" placeholder="Enter Email Address" class="form-control input-sm" required></div>
                            </div>
                            <div class="row cf-ro">
                                <div class="col-sm-3"><label>Mobile Number:</label></div>
                                <div class="col-sm-8"><input type="text" name="mobileno" placeholder="Enter Mobile Number" class="form-control input-sm" required></div>
                            </div>
                            <div class="row cf-ro">
                                <div class="col-sm-3"><label>Enter Message:</label></div>
                                <div class="col-sm-8">
                                    <textarea rows="5" placeholder="Enter Your Message" class="form-control input-sm" name="description" required style="border-color: var(--verdigris);"></textarea>
                                </div>
                            </div>
                            <div class="row cf-ro">
                                <div class="col-sm-3"><label></label></div>
                                <div class="col-sm-8">
                                    <button class="btn btn-success btn-sm" type="submit" name="submit" style="background-color: var(--verdigris);">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </section>



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
            <script src="./assets/js/script.js"></script>

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