<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/OAuth.php';
require 'vendor/autoload.php';
    $mail = new PHPMailer(true);

   // $mail->SMTPDebug = 1;
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();                                            
$mail->Host       = 'smtp.gmail.com';                     
$mail->SMTPAuth   = true;                                
    $mail->Username   = 'imaneSD201820@gmail.com';                    
    $mail->Password   = 'ajsdimane01';                              
   $mail->SMTPSecure = 'tls';           
    $mail->Port       = 587; 
   // $mail->setFrom('imaneSD201820@gmail.com', 'BURGER CODE');
  //  $mail->addAddress('soufiane.dareen@gmail.com');
  //  $mail->Subject = 'Email Verification Code';
  //  $mail->Body = 'helllo everyone help me to solv this issue';
    $mail->isHTML(true); 
   // $mail->send();
   // echo 'Message has been sent';
//} catch (Exception $e) {
  //  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//exit(json_encode(array('response'=>$response)));
//}


/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer();                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'imaneSD201820@gmail.com';                 // SMTP username
    $mail->Password = 'ajsdimane01';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('imaneSD201820@gmail.com', 'BURGER CODE');
$mail->addAddress('soufiane.dareen@gmail.com');
$mail->subject = 'Email Verification Code';
$mail->body = 'helllo';
                 // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}*/

?>