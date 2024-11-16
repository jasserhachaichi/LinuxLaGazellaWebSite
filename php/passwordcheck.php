<?php
$con= mysqli_connect("localhost","root","","gazella");
session_start();


if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    $password=$_POST['password'];
    if (empty($_SESSION['mail_content'])){
        $_content = $_SESSION['user_content'];
        $req = "SELECT * FROM comptes WHERE (password='$password' AND user='$_content' )";
    }else{
        $_content = $_SESSION['mail_content'];
        $req = "SELECT * FROM comptes WHERE (password='$password' AND mail='$_content')";
    } 
    
    $result_p = mysqli_query($con, $req);
    if(mysqli_num_rows($result_p) == 1) {
        while($row = $result_p->fetch_assoc()) {
            //echo var_dump($row);
             echo $_SESSION['Role_content'] = $row["Role"];
             setcookie('id_cookie', $row["id"], time() + 32140800, '/');
          }
    
    } else {
    echo "password incorrect";
    } 
}
$con->close();















?>