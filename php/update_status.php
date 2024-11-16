<?php
$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    if (isset($_POST["id_notif"])) {
        //session_start();
        $_id_notif = $_POST["id_notif"];
        //echo $_POST["id_notif"];
    
    $id_cookie_value = $_COOKIE['id_cookie'];
    $sql = "UPDATE notification SET status = 0 WHERE 	id_notification = '$_id_notif'";


    if (mysqli_query($con, $sql)) {
    //echo "Record updated successfully";
    } else {
    echo "Error updating record: " . mysqli_error($con);
    }
    //echo $_SESSION['id_notification'];




    $sql5 = "SELECT COUNT(*) FROM notification WHERE id_user='$id_cookie_value' AND status = 1 ";
    $result5 = mysqli_query($con, $sql5);

    // Fetch the result
    $row5 = mysqli_fetch_row($result5);

    // The number of rows is in the first element of the $row array
    echo $row5[0];
    }
}



?>