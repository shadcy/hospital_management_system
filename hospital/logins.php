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
    </style>

</head>

<body id="top">

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
                        <a href="contactus.php" class="navbar-link title-md">Contact Us</a>
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

            <!-- 
        - #HERO
      -->

            <!-- <section class="section hero" style="background-image: url('./assets/images/hero-bg.png')" aria-label="home">
                <div class="container">

                    <div class="hero-content">

                        <p class="hero-subtitle has-before" data-reveal="left">Welcome To Our Webpage</p>

                        <h1 class="headline-lg hero-title" data-reveal="left">
                            IIT Bombay <br>
                            Hospital.
                        </h1>

                        <div class="hero-card" data-reveal="left">

                            <p class="title-lg card-text">
                                Get location of hospital.
                            </p>

                            <div class="wrapper">

                                <div class="input-wrapper title-lg">
                                    <input type="text" name="location" placeholder="IIT Bombay Hospital" class="input-field">

                                    <ion-icon name="location"></ion-icon>
                                </div>

                                <a href="https://maps.app.goo.gl/fUQQ9brUSShqoZ568">
                                    <button class="btn has-before">
                                        <ion-icon name="search"></ion-icon>

                                        <span class="span title-md">Find Now</span>
                                    </button>
                                </a>

                            </div>

                        </div>

                    </div>

                    <figure class="hero-banner" data-reveal="right">
                        <img src="./assets/images/hero-banner.png" width="590" height="517" loading="eager" alt="hero banner" class="w-100">
                    </figure>

                </div>
            </section> -->


            <section class="section hero" style="background-image: url('./assets/images/hero-bg.png')" aria-label="login">
                <div class="container">

                    <div class="hero-content">

                        <!-- <h1 class="headline-lg hero-title" data-reveal="left">
                            Login to IIT Bombay <br>
                            Hospital Portal
                        </h1> -->



                    </div>

                    <!-- <figure class="hero-banner" data-reveal="right">
                        <img src="image.png" width="590" height="517" class="w-100">
                    </figure> -->

                </div>
            </section>





            <!-- 
        - #SERVICE
      -->

            <section class="service" aria-label="service">
                <div class="container">

                    <ul class="service-list">

                        <li>
                            <div class="service-card" data-reveal="bottom">

                                <div class="card-icon">
                                    <img src="./assets/images/icon-1.png" width="71" height="71" loading="lazy" alt="icon">
                                </div>

                                <h3 class="headline-sm card-title">
                                    <a href="./hms/patient/">Student's Login</a>
                                </h3>

                                <p class="card-text">
                                    NO VPN REQUIRED FOR OUTSIDE IIT BOMBAY

                                    REGISTER/SIGN UP TO LOGIN
                                </p>

                                <a href="./hms/patient/">

                                    <button class="btn-circle" aria-label="read more about psychiatry">
                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </button>

                                </a>

                            </div>
                        </li>

                        <li>
                            <div class="service-card" data-reveal="bottom">

                                <div class="card-icon">
                                    <img src="./assets/images/icon-2.png" width="71" height="71" loading="lazy" alt="icon">
                                </div>

                                <h3 class="headline-sm card-title">
                                    <a href="./hms/doctor">Doctor's Login</a>
                                </h3>

                                <p class="card-text">
                                    NO VPN REQUIRED FOR OUTSIDE IIT BOMBAY

                                    REGISTER/SIGN UP TO LOGIN
                                </p>

                                <a href="./hms/doctor">
                                    <button class="btn-circle" aria-label="read more about Gynecology">
                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </button>
                                </a>


                            </div>
                        </li>

                        <li>
                            <div class="service-card" data-reveal="bottom">

                                <div class="card-icon">
                                    <img src="./assets/images/icon-3.png" width="71" height="71" loading="lazy" alt="icon">
                                </div>

                                <h3 class="headline-sm card-title">
                                    <a href="./hms/admin">Admin's Login</a>
                                </h3>

                                <p class="card-text">
                                    NO VPN REQUIRED FOR OUTSIDE IIT BOMBAY

                                    REGISTER/SIGN UP TO LOGIN
                                </p>

                                <a href="./hms/admin">
                                    <button class="btn-circle" aria-label="read more about Pulmonology">
                                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                    </button>
                                </a>

                            </div>
                        </li>

                        <li>
                            <div class="service-card" data-reveal="bottom">

                                <div class="card-icon">
                                    <img src="./assets/images/icon-4.png" width="71" height="71" loading="lazy" alt="icon">
                                </div>

                                <h3 class="headline-sm card-title">
                                    <a href="#">Staff's Login</a>
                                </h3>

                                <p class="card-text">
                                    NO VPN REQUIRED FOR OUTSIDE IIT BOMBAY

                                    REGISTER/SIGN UP TO LOGIN
                                </p>

                                <button class="btn-circle" aria-label="read more about Orthopedics">
                                    <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                                </button>

                            </div>
                        </li>

                    </ul>

                </div>
            </section>


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

</body>

</html>