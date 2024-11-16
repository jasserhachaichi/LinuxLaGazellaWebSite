<?php
$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
  $id_verif = $_COOKIE['id_cookie'];
  $query1 = "SELECT * FROM not_verified WHERE id='$id_verif'";
  $result1 = mysqli_query($con, $query1);
  if(mysqli_num_rows($result1) == 1){
    $row = $result1->fetch_assoc();
    $user_name = $row['user'];
    $_code = $row['code'];
  }
}
$con->close();
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
$verif_link = 'http://localhost:3000/php/verif.php?code=' . $_code;
//Email body
$mail->Body = "<p> Hello " . $user_name . "<br> You registered an account on La Gazella Website, before being able to use your account you need to verify that this is your email address by clicking here:<br> <a href=" . $verif_link . ">Verify my email address</a>" . "<br>Kind Regards, La Gazella Team <br></p>" ;

//Add recipient
$mail->addAddress('La.Gazella.OS.Team@gmail.com');

//Finally send email
if ($mail->send()) {
  setcookie('id_cookie', "", time() - 3600, '/');
  setcookie('mail_send_cookie', "ok", time() + 3600, '/');
  header("Location: ../../sign_in.html");
  exit;
} else {
    echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
}

//Closing smtp connection
$mail->smtpClose();
?>
