<?php
$con= mysqli_connect("localhost","root","","gazella");
session_start();
$identite = $_POST["identite"];
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
        $query1 = "SELECT * FROM comptes WHERE mail='$identite'";
        $result1 = mysqli_query($con, $query1);
    
    
        $query2 = "SELECT * FROM comptes WHERE user='$identite'";
        $result2 = mysqli_query($con, $query2);
    
    
    
        
        if((mysqli_num_rows($result1) == 1) XOR (mysqli_num_rows($result2) == 1)) {
            if(mysqli_num_rows($result1) == 1){
                if(isset($_SESSION['user_content'])){
                    unset($_SESSION['user_content']);
                }
                $_SESSION['mail_content'] = $identite;
                //echo "the user is exist successful!";

            } else if (mysqli_num_rows($result2) == 1){
                if(isset($_SESSION['mail_content'])){
                    unset($_SESSION['mail_content']);
                }
                $_SESSION['user_content'] = $identite;
                //echo "the user is exist successful!";
            }
            
        
        } else {
        echo "Invalid mail or username.";
        }
}



?>