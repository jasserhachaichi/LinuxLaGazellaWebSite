<?php
// Get the code from the URL parameter
$verificationCode = $_GET['code'];
//echo "The code is :" . $verificationCode;
session_start();


$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    $_SESSION['code_mail'] = $verificationCode;
    echo $_SESSION['code_mail'];
    $query1 = "SELECT * FROM forgetpwd WHERE code='$verificationCode'";
    $result1 = mysqli_query($con, $query1);
    if(mysqli_num_rows($result1) == 1){
        //$row = $result1->fetch_assoc();
        if(isset($_SESSION['msg_mail'])){
            echo $_SESSION['msg_mail'];
        }






























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
        <form  action="phpchangepwd.php" method="post">
          <label for="fpsw">New Password:</label><br>
          <input type="text"  name="fpsw"><br>
          <label for="psw">Confirm New Password:</label><br>
          <input type="text"  name="psw"><br><br>
          <input type="submit" value="Submit">
        </form>
        </body>
        </html>