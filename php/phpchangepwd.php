<?php
$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    session_start();
        if(isset($_POST["fpsw"]) AND isset($_POST["psw"])){
            $code = $_SESSION['code_mail'];
            echo $code;
            if($_POST["fpsw"] == $_POST["psw"] ){

                $query1 = "SELECT * FROM forgetpwd WHERE code='$code'";
                $result1 = mysqli_query($con, $query1);
                $row = $result1->fetch_assoc();
                $pwd=$_POST["fpsw"];
                $id=$row['id'];
                $sql = "UPDATE comptes SET password = '$pwd' WHERE 	id= '$id'";
                $result2 = mysqli_query($con, $sql);
                $sql2 = "DELETE FROM forgetpwd WHERE code='$code'";
                $result3 = mysqli_query($con, $sql2);
                $_SESSION = array();
                // Destroy the session
                session_destroy();
                header("Location: ../sign_in.html");
                exit;
            }else{
                $_SESSION['msg_mail'] = "The confirmation is incorrect please insert your password again";
                header("Location: changepwd.php");
                exit; // Make sure to exit after the redirect to prevent further execution
            }
             

        }
}






































?>