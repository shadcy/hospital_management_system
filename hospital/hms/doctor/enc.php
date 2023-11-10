<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor  | Encryption</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-3.css" id="skin_color" />


	</head>
    <style>
    /* body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    } */

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
      margin-right:300px;
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
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container" >
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle" >Doctor | Encryption</h1>
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
    


                            <!-- <div>

                            <div class="card">
      <h1>Encryption</h1>
      <h2>Select an image file and enter a password to encrypt and decrypt the image.</h2>
      <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
        <p class="drag-drop-text" id="drag-text"> <br><br></p>
        <input type="file" id="image" onchange="previewImage()" ondrop="dropHandler(event)"
          ondragover="dragOverHandler(event)">
      </div>

      <br>
      Password: <input type="password" id="password">
      <br>
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



  <div class="card" style="float:right;">
      
      <h1 >Image Preview</h1>
      <img id="preview" style="display:none; " alt="qr.png">


      </div>

                            </div>
   
 -->


 <div style="display: flex;">
    <div style="flex: 1;">
        <div class="card">
            <h1>Encryption</h1>
            <h2>Select an image file and enter a password to encrypt and decrypt the image.</h2>
            <div class="drag-drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                <p class="drag-drop-text" id="drag-text"> <br><br></p>




                <input type="file" id="image" onchange="previewImage()" ondrop="dropHandler(event)"
                    ondragover="dragOverHandler(event)">
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
                </div>


            <br>
            Password: <input type="password" id="password">
            <br>
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
            <img id="preview" style="display:none; "  alt="Default Image">
        </div>
    </div>
</div>





 
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
  <script src="./script.js"></script>






							</div>
						</div>
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});


            function previewImage() {
  var preview = document.getElementById("preview");
  var file = document.getElementById("image").files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    preview.src = e.target.result;
    preview.style.display = "block";
  };
  reader.readAsDataURL(file);
}

function encryptImage() {
  var file = document.getElementById("image").files[0];
  var password = document.getElementById("password").value;
  var reader = new FileReader();
  reader.onload = function (e) {
    console.log(e.target.result);
    var imageBinaryString = e.target.result.split(",")[1];
    var encrypted = CryptoJS.AES.encrypt(imageBinaryString, password);
    var encryptedDataURL = "data:image/png;base64," + encrypted.toString();
    var encryptedImage = document.getElementById("encrypted-image");
    var encryptedLink = document.getElementById("encrypted-link");
    encryptedImage.src = encryptedDataURL;
    encryptedImage.style.display = "inline";
    encryptedLink.href = encryptedDataURL;
    encryptedLink.style.display = "inline";
  };
  reader.readAsDataURL(file);
}

function decryptImage() {
  var file = document.getElementById("image").files[0];
  var password = document.getElementById("password").value;
  var reader = new FileReader();
  reader.onload = function (e) {
    var encryptedBinaryString = e.target.result.split(",")[1];
    var decrypted = CryptoJS.AES.decrypt(encryptedBinaryString, password);
    try {
      decrypted = decrypted.toString(CryptoJS.enc.Utf8);
    } catch (e) {
      alert("Invalid password");
      return;
    }
    var decryptedDataURL = "data:image/png;base64," + decrypted;
    var decryptedImage = document.getElementById("decrypted-image");
    var decryptedLink = document.getElementById("decrypted-link");
    decryptedImage.src = decryptedDataURL;
    decryptedImage.style.display = "inline";
    decryptedLink.href = decryptedDataURL;
    decryptedLink.style.display = "inline";
  };
  reader.readAsDataURL(file);
}

function dragOverHandler(ev) {
  ev.preventDefault();
}

function dropHandler(ev) {
  ev.preventDefault();
  var file = ev.dataTransfer.files[0];
  document.getElementById('image').files = file;
  previewImage();
}
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
<?php } ?>
