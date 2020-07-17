<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';

require_once 'connect.php' ;
require_once 'global.php' ;

/**ส่งรหัสผ่าน */

$email = (isset($_POST['email'])) ? $_POST['email'] : '';

$query = " SELECT * FROM teacher where teacher_email = '$email' LIMIT 1 ";
$result3 = mysqli_query($dbcon,$query) or die(mysqli_error());
$count = mysqli_num_rows($result3);

$query2 = " SELECT * FROM student where student_email = '$email' LIMIT 1 ";
$result2 = mysqli_query($dbcon,$query2) or die(mysqli_error());
$count2 = mysqli_num_rows($result2);

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
$randomString_pass = ''; 
  for ($i = 0; $i < 20; $i++) { 
    $index = rand(0, strlen($characters) - 1); 
    $randomString_pass .= $characters[$index]; 
  } 

  $salt = 'javacodewars' ;
  $hash_pass = hash_hmac('sha256',$randomString_pass,$salt);


if($count2 == 1){
  $sql = "UPDATE student SET student_pass = '$hash_pass' WHERE student_email = '$email' " ;
  $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
  $mail = new PHPMailer(true);

  try {
      //$mail->SMTPDebug  = 4;
      $mail->CharSet    = "utf-8";
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'javacodewars@gmail.com';                // SMTP username
      $mail->Password   = 'javacodewarsCS402';                    // SMTP password
      $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to ssl 465  tls 587
      $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );
     /* $mail->isSMTP();
       $mail->Host = 'localhost';
       $mail->SMTPAuth = false;
       $mail->SMTPAutoTLS = false;
       $mail->Port = 25;*/

      $mail->setFrom('javacodewars@gmail.com', 'javacodewars');
      $mail->addAddress($email);     // Add a recipient
      $mail->addReplyTo('noreply@gmail.com', 'noreply');

      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'forgot password';
      $mail->Body    = "Hello $email your password is  $randomString_pass ";
      $mail->AltBody = "Hello $email your password is  $randomString_pass ";

      $mail->send();
      mysqli_free_result($result3);
      mysqli_free_result($result2);
        response_message(200,"Success");
    } catch (Exception $e) {
      mysqli_free_result($result3);
      mysqli_free_result($result2);
        response_message(500,"Unsuccess");
    }

}elseif($count == 1){
  $sql = "UPDATE teacher SET teacher_pass = '$hash_pass' WHERE teacher_email = '$email' " ;
  $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      //$mail->SMTPDebug  = 4;
      $mail->CharSet    = "utf-8";
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'javacodewars@gmail.com';                // SMTP username
      $mail->Password   = 'javacodewarsCS402';                    // SMTP password
      $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to ssl 465  tls 587
      //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      //echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."<br>";
      $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );

       //loclahost
      /* $mail->isSMTP();
       $mail->Host = 'localhost';
       $mail->SMTPAuth = false;
       $mail->SMTPAutoTLS = false;
       $mail->Port = 25;*/
      $mail->setFrom('javacodewars@gmail.com', 'javacodewars');
      $mail->addAddress($email);     // Add a recipient
      $mail->addReplyTo('noreply@gmail.com', 'noreply');

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'forgot password';
      $mail->Body    = "Hello $email your password is  $randomString_pass ";
      $mail->AltBody = "Hello $email your password is  $randomString_pass ";

      $mail->send();
      mysqli_free_result($result3);
      mysqli_free_result($result2);
        response_message(200,"Success");
    } catch (Exception $e) {
      mysqli_free_result($result3);
      mysqli_free_result($result2);
        response_message(500,"Unsuccess");
    }
}

?>
