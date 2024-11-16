<?php
$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    $id_cookie_value = $_COOKIE['id_cookie'];
    $query4 = "SELECT * FROM notification WHERE id_user='$id_cookie_value'ORDER BY date_creation DESC";
    $result4 = mysqli_query($con, $query4);
    $list1 = array();
    
    while($row4 = $result4->fetch_assoc()){
        $list2 = array($row4["source"],$row4["message"],$row4["date_creation"],$row4["status"],$row4["id_notification"]);
        array_push($list1 , $list2);
        
    }
    //print_r($list1);
    echo json_encode($list1);





}



?>