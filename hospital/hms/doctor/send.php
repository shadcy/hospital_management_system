<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->Username = 'shreyashwanjari5162@gmail.com';
    $mail->Password ='onxtdlskyrabqlhs';
    $mail->SMTPSecure ='ssl';
    $mail->Port = 465;

    $mail->setFrom('shreyashwanjari5162@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];
    
    // $mail->addAttachment($_FILES['file']['tmp_name'],$_FILES['name']);

     // Check if a file is uploaded
    
     if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $mail->addAttachment($file_tmp_name, $file_name);
    }

    $mail->send();

    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = 'mail.php';
    </script> ";
}



