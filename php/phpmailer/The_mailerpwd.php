<?php
$id_verif = $_COOKIE['id_psw_cookie'];
$_code = $_COOKIE['Code_psw_cookie'];
$user_name=$_COOKIE['user_psw_cookie'];
//Include required PHPMailer files
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

//Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create instance of PHPMailer
$mail = new PHPMailer();

//Set mailer to use smtp
$mail->isSMTP();

//Define smtp host
$mail->Host = "smtp.gmail.com";

//Enable smtp authentication
$mail->SMTPAuth = true;

//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "tls";

//Port to connect smtp
$mail->Port = "587";

//Set gmail username
$mail->Username = "dreaded.wolf4707@gmail.com";

//Set gmail password
$mail->Password = "jvjdlpkvpyfscjgs";

//Email subject
$mail->Subject = "La Gazella Team";

//Set sender email
$mail->setFrom('dreaded.wolf4707@gmail.com');

//Enable HTML
$mail->isHTML(true);

//Attachment
//$mail->addAttachment('img/attachment.png');
$verif_link = 'http://localhost:3000/php/changepwd.php?code=' . $_code;
//Email body
$mail->Body = "<p> Hello " . '<span style="font-size: 25px;font-weight: 600;color:bleu;" >' . $user_name . " </span><br> A request has been received to change the password for your La_Gazella account.<br> <a href=" . $verif_link . ">Reset Password</a>" . '<br>If you did not initiate this request, please contact us immediatety at <span style="font-size: 25px;font-weight: 500;color:bleu;" >La.Gazella.OS.Team@gmail.com</span><br><br><br>Kind Regards, La Gazella Team <br></p>' ;

//Add recipient
$mail->addAddress('La.Gazella.OS.Team@gmail.com');

//Finally send email
if ($mail->send()) {
  //setcookie('id_cookie', "", time() - 3600, '/');
  //setcookie('mail_send_cookie', "ok", time() + 3600, '/');
  setcookie("id_psw_cookie","", time()-10);
  setcookie("user_psw_cookie","", time()-10);
  setcookie("Code_psw_cookie","", time()-10);
  header("Location: ../../sign_in.html");
  //exit;
} else {
    echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
}

//Closing smtp connection
$mail->smtpClose();
?>
