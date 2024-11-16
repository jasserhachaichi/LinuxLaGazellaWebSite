<?php
$con= mysqli_connect("localhost","root","","gazella");

if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    session_start();
    if(isset($_SESSION['mail_content'])){
        $mail = $_SESSION['mail_content'];
        //echo $_SESSION['mail_content'] . ' is set';
        echo '<p>We have sent message to <span style="color:red;">' . $_SESSION['mail_content'] . '</span> <br>' . ' please check  your mailbox</p>';
        $req = "SELECT * FROM comptes WHERE mail='$mail'";
    }
    else if (isset($_SESSION['user_content'])){
        //echo $_SESSION['user_content'] . ' is set';
        $user = $_SESSION['user_content'];
        echo '<p>We have sent message to mail of <span style="color:red;">' . $_SESSION['user_content'] . '</span> <br>' . ' please check  your mailbox</p>';
        $req = "SELECT * FROM comptes WHERE user='$user'";
    }
    $result_p = mysqli_query($con, $req);
    if(mysqli_num_rows($result_p) == 1) {
        while($row = $result_p->fetch_assoc()) {
            $id=$row["id"];
            $username=$row["user"];
          }
    }
    $verif = "SELECT * FROM forgetpwd WHERE id='$id'";
    $result_verif = mysqli_query($con, $verif);
    while (true ){
        $verificationCode = rand(10,1000);
        $query1 = "SELECT * FROM forgetpwd WHERE id='$verificationCode'";
        $result1 = mysqli_query($con, $query1);
        if(mysqli_num_rows($result1) == 0){
            //echo $v_rand;
            break;
        }
    }
    if(mysqli_num_rows($result_verif) == 0) {
            
                $sql = "INSERT INTO forgetpwd (id, code) VALUES ('$id','$verificationCode')";
                if ($con->query($sql) === TRUE) {
                    setcookie('id_psw_cookie', $id, time() + 32140800, '/');
                    setcookie('user_psw_cookie', $username, time() + 32140800, '/');
                    setcookie('Code_psw_cookie', $verificationCode, time() + 32140800, '/');  
                    //header("Location: ./phpmailer/The_mailerpwd.php");
                    //exit; // Make sure to exit after the redirect to prevent further execution
                    



                } else {
                echo "Error: " . $sql . "<br>" . $con->error;
                }

    }//mysql





















    



















    
}
$con->close();
?>