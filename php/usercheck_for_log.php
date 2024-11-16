<?php
$con= mysqli_connect("localhost","root","","gazella");

if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    session_start();
    $user = $_POST["user"];
    
    $query1 = "SELECT * FROM comptes WHERE user='$user'";
    $result1 = mysqli_query($con, $query1);

    $query2 = "SELECT * FROM not_verified WHERE user='$user'";
    $result2 = mysqli_query($con, $query2);
    
    if((mysqli_num_rows($result1) == 1) OR (mysqli_num_rows($result2) == 1)) {
        echo "This username already exist try another username please.";
    } else {
        $_SESSION['user_content'] = $user;
    echo "Invalid user";
    }
}
?>