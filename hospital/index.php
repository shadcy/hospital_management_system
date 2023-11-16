<!-- 
DEVELOPER : SHREYASH WANJARI
MIT LICENSE APPLIED
GITHUB : https://github.com/ShreyashWanjari
WEBSITE : http://nxt.nxtdevelopers.xyz/
LINKEDIN : https://www.linkedin.com/in/shreyashwanjari/


 Made with ♥ by SHREYASH 
  -->
<?php
include_once('hms/include/config.php');
if (isset($_POST['submit'])) {
  $name = $_POST['fullname'];
  $email = $_POST['emailid'];
  $mobileno = $_POST['mobileno'];
  $description = $_POST['description'];
  $query = mysqli_execute_query($con, "insert into contact_us(fullName,email,contactNumber,message) value(?,?,?,?)", [$name, $email, $mobileno, $description]); #Done2
  echo "<script>alert('Your information succesfully submitted');</script>";
  echo "<script>window.location.href = 'index.php'</script>";
} ?>




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
      /* max-width: 1000px; */
      padding: 40px;
      /* border: 1px solid black;
      border-radius: 5px; */
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

    @media (max-width: 800px) {
      .cop-ck {
        padding: 40px;
        width: 120%;
      }
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

      <!-- 
        - #HERO
      -->

      <section class="section hero" style="background-image: url('./assets/images/hero-bg.png')" aria-label="home">
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





      <!-- 
        - #ABOUT
      -->

      <section class="section about" aria-labelledby="about-label">
        <div class="container">

          <div class="about-content">

            <p class="section-subtitle title-lg has-after" id="about-label" data-reveal="left">Timings :)</p>

            <h2 class="headline-md" data-reveal="left">Doctors Time Table IIT Bombay</h2>

            <p class="section-text" data-reveal="left">
              Nature, time and patience are the 3 great physicians. Bulgarian
            </p>

            <ul class="tab-list" data-reveal="left">

              <li>
                <button class="tab-btn active">Doctors</button>
              </li>

              <li>
                <button class="tab-btn">OPD</button>
              </li>

              <li>
                <button class="tab-btn">Time</button>
              </li>

            </ul>

            <p class="tab-text" data-reveal="left">
            <div>
              <?php
              $ret = mysqli_query($con, "select * from pages where type='about';"); #Done2
              while ($row = mysqli_fetch_array($ret)) {
              ?>
                <p>
                  <?php echo $row['description']; ?>.
                </p>
              <?php } ?>
            </div>
            </p>

            <div class="wrapper">

              <ul class="about-list">

                <li class="about-item" data-reveal="left">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>

                  <span class="span">M.B.B.S | MD | OB/GYN</span>
                </li>

                <li class="about-item" data-reveal="left">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>

                  <span class="span">Surgeon</span>
                </li>

                <li class="about-item" data-reveal="left">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>

                  <span class="span">Emergency Physician</span>
                </li>

                <li class="about-item" data-reveal="left">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>

                  <span class="span">Ophthalmologist</span>
                </li>

              </ul>

            </div>

          </div>

          <figure class="about-banner" data-reveal="right">
            <img src="./assets/images/about-banner.png" width="554" height="678" loading="lazy" alt="about banner" class="w-100">
          </figure>

        </div>
      </section>





      <!-- 
        - #LISTING
      -->

      <section class="section listing" aria-labelledby="listing-label">
        <div class="container">

          <ul class="grid-list">

            <li>
              <p class="section-subtitle title-lg" id="listing-label" data-reveal="left">Doctors Listig</p>

              <h2 class="headline-md" data-reveal="left">Browse by specialist</h2>
            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-1.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Psychiatry</h3>

                  <p class="card-text"></p>
                </div>

              </div>
            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-2.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Gynecology</h3>

                  <p class="card-text"></p>
                </div>

              </div>
            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-4.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Pulmonology</h3>

                  <p class="card-text"></p>
                </div>

              </div>

            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-5.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Orthopedics</h3>

                  <p class="card-text"></p>
                </div>

              </div>
            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-6.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Pediatrics</h3>

                  <p class="card-text"></p>
                </div>

              </div>
            </li>

            <li>
              <div class="listing-card" data-reveal="bottom">

                <div class="card-icon">
                  <img src="./assets/images/icon-7.png" width="71" height="71" loading="lazy" alt="icon">
                </div>

                <div>
                  <h3 class="headline-sm card-title">Osteology</h3>

                  <p class="card-text"></p>
                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #BLOG
      -->

      <section class="section blog" aria-labelledby="blog-label">
        <div class="container">

          <p class="section-subtitle title-lg text-center" id="blog-label" data-reveal="bottom">
            News & Article
          </p>

          <h2 class="section-title headline-md text-center" data-reveal="bottom">Latest Articles</h2>

          <ul class="grid-list">

            <li>
              <div class="blog-card has-before has-after" data-reveal="bottom">

                <div class="meta-wrapper">

                  <div class="card-meta">
                    <ion-icon name="person-outline"></ion-icon>

                    <span class="span">By Admin</span>
                  </div>

                  <div class="card-meta">
                    <ion-icon name="folder-outline"></ion-icon>

                    <span class="span">Specialist</span>
                  </div>

                </div>

                <h3 class="headline-sm card-title">Could intermittent fasting reduce breast cancer</h3>

                <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>

                <p class="card-text">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                  labore et dolore magna aliquyam erat
                </p>

                <a href="#" class="btn-text title-lg">Read More</a>

              </div>
            </li>

            <li>
              <div class="blog-card has-before has-after" data-reveal="bottom">

                <div class="meta-wrapper">

                  <div class="card-meta">
                    <ion-icon name="person-outline"></ion-icon>

                    <span class="span">By Admin</span>
                  </div>

                  <div class="card-meta">
                    <ion-icon name="folder-outline"></ion-icon>

                    <span class="span">Specialist</span>
                  </div>

                </div>

                <h3 class="headline-sm card-title">Give children more autonomy during the pandemic</h3>

                <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>

                <p class="card-text">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                  labore et dolore magna aliquyam erat
                </p>

                <a href="#" class="btn-text title-lg">Read More</a>

              </div>
            </li>

            <li>
              <div class="blog-card has-before has-after" data-reveal="bottom">

                <div class="meta-wrapper">

                  <div class="card-meta">
                    <ion-icon name="person-outline"></ion-icon>

                    <span class="span">By Admin</span>
                  </div>

                  <div class="card-meta">
                    <ion-icon name="folder-outline"></ion-icon>

                    <span class="span">Specialist</span>
                  </div>

                </div>

                <h3 class="headline-sm card-title">How do binge eating and drinking impact the liver?</h3>

                <time class="title-sm date" datetime="2022-01-28">28 January, 2022</time>

                <p class="card-text">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                  labore et dolore magna aliquyam erat
                </p>

                <a href="#" class="btn-text title-lg">Read More</a>

              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>


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
    - #FOOTER
  -->

  <footer class="footer" style="background-image: url('./assets/images/footer-bg.png')">
    <div class="container">

      <div class="section footer-top">

        <div class="footer-brand" data-reveal="bottom">

          <a href="#" class="logo">
            <img src="./assets/images/logo.svg" width="136" height="46" loading="lazy" alt="Doclab home">
          </a>

          <ul class="contact-list has-after">

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="mail-open-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Main Email : <a href="mailto:contact@website.com" class="contact-link">contact@&shy;website.com</a>
                </p>

                <p>
                  Inquiries : <a href="mailto:Info@mail.com" class="contact-link">Info@mail.com</a>
                </p>
              </div>

            </li>

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Office Telephone : <a href="tel:0029129102320" class="contact-link">0029129102320</a>
                </p>

                <p>
                  Mobile : <a href="tel:000232439493" class="contact-link">000 2324 39493</a>
                </p>
              </div>

            </li>

          </ul>

        </div>

        <div class="footer-list" data-reveal="bottom">

          <p class="headline-sm footer-list-title">About Us</p>

          <p class="text">
            IIT Bombay Hospital is located near Canara Bank, IIT Bombay, Powai, IIT Area, Powai, Mumbai, Maharashtra
            400076, भारत
          </p>

          <address class="address">
            <ion-icon name="map-outline"></ion-icon>

            <span class="text">
              Near Canara Bank, IIT Bombay, Powai, IIT Area, Powai, Mumbai, Maharashtra
              400076, भारत
            </span>
          </address>

        </div>

        <ul class="footer-list" data-reveal="bottom">

          <li>
            <p class="headline-sm footer-list-title">Services</p>
          </li>

          <li>
            <a href="#" class="text footer-link">Conditions</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Listing</a>
          </li>

          <li>
            <a href="#" class="text footer-link">How It Works</a>
          </li>

          <li>
            <a href="#" class="text footer-link">What We Offer</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Latest News</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Contact Us</a>
          </li>

        </ul>

        <ul class="footer-list" data-reveal="bottom">

          <li>
            <p class="headline-sm footer-list-title">IIT Bombay</p>
          </li>

          <li>
            <a href="#" class="text footer-link">Conditions</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Terms of Use</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Our Services</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Contact Admin</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Doctor's Login</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Admin Login</a>
          </li>

        </ul>

        <div class="footer-list" data-reveal="bottom">

          <p class="headline-sm footer-list-title">Subscribe</p>

          <form action="" class="footer-form">
            <input type="email" name="email" placeholder="Email" class="input-field title-lg">

            <button type="submit" class="btn has-before title-md">Subscribe</button>
          </form>

          <p class="text">
            Get the latest updates via email. Any time you may unsubscribe
          </p>

        </div>

      </div>
      <div class="col-md-6 col-sm-12 map-img">
        <h2>Contact Us</h2>
        <address class="md-margin-bottom-40">

          <?php
          $ret = mysqli_query($con, "select * from pages where type='contact';"); #Done
          while ($row = mysqli_fetch_array($ret)) {
          ?>
            <?php echo $row['description']; ?> <br>
            Phone:
            <?php echo $row['contactNumber']; ?> <br>
            Email: <a href="mailto:<?php echo $row['email']; ?>" class="">
              <?php echo $row['email']; ?>
            </a><br>
            Timing:
            <?php echo $row['openingTime']; ?>
        </address>

      <?php } ?>





      </div>

      <div class="footer-bottom">

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