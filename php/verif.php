<?php
// Get the code from the URL parameter
$verificationCode = $_GET['code'];
//echo "The code is :" . $verificationCode;

$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    $query1 = "SELECT * FROM not_verified WHERE code='$verificationCode'";
    $result1 = mysqli_query($con, $query1);
    if(mysqli_num_rows($result1) == 1){
        $row = $result1->fetch_assoc();
        $id = $row['id'];
        $user = $row['user'];
        $mail = $row['mail'];
        $name = $row['nom'];
        $first_name = $row['prenom'];
        $city = $row['pays'];
        $datemin = $row['naissance'];
        $pwd = $row['password'];
        $query2 = "INSERT INTO comptes (id, user, mail, nom, prenom, pays, naissance, password) VALUES ('$id', '$user', '$mail', '$name', '$first_name', '$city', '$datemin', '$pwd')";
        $result2 = mysqli_query($con, $query2);
        $query3 = "DELETE FROM not_verified WHERE code='$verificationCode'";
        $result3 = mysqli_query($con, $query3);
        setcookie('mail_send_cookie', "", time() - 3600, '/');
        echo '<script> window.setTimeout("window.close()", 10000); </script>';
    }else {
        echo "Error: " . $query1 . "<br>" . $con->error;
        echo "Error: " . $query2 . "<br>" . $con->error;
        echo "Error: " . $query3 . "<br>" . $con->error;
        }

    
}






































?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Your account has been created successfully</p> <br>
    <p>This window it be closed after 10 seconds</p>
</body>
</html>