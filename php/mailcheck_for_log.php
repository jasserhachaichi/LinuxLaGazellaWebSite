<?php
$con= mysqli_connect("localhost","root","","gazella");

if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    session_start();
    $mail = $_POST["mail"];
    
    $query1 = "SELECT * FROM comptes WHERE mail='$mail'";
    $result1 = mysqli_query($con, $query1);

    $query2 = "SELECT * FROM not_verified WHERE mail='$mail'";
    $result2 = mysqli_query($con, $query2);




    if((mysqli_num_rows($result1) == 1) OR (mysqli_num_rows($result2) == 1)) {
        echo "This mail already exist try another mail please.";
    } else {
        $_SESSION['mail_content'] = $mail;
    echo "Invalid mail";
    }
}
?>