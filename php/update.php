<?php
$con = mysqli_connect("localhost", "root", "", "gazella");
session_start();
$id_cookie_value = $_COOKIE['id_cookie'];
$msg_error = "msg_vide";

if (isset($_POST["first_name"])) {
    $pivot = $_POST["first_name"];
    $_SESSION['s_first_name'] = $pivot;
    $stmt = $con->prepare("UPDATE comptes SET prenom = ? WHERE id = ?");
    $stmt->bind_param("si", $pivot, $id_cookie_value);
    $stmt->execute();
    $stmt->close();
    $msg_error = "msg_vide";
} elseif (isset($_POST["name"])) {
    $pivot = $_POST["name"];
    $_SESSION['s_name'] = $pivot;
    $stmt = $con->prepare("UPDATE comptes SET nom = ? WHERE id = ?");
    $stmt->bind_param("si", $pivot, $id_cookie_value);
    $stmt->execute();
    $stmt->close();
    $msg_error = "msg_vide";
}elseif (isset($_POST["user"])) {
    $pivot = $_POST["user"];
    $stmt = $con->prepare("SELECT * FROM comptes WHERE user = ?");
    $stmt->bind_param("s", $pivot);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == 1) {
        $msg_error = "msg_user";
    } elseif (mysqli_num_rows($result) == 0) {
        $stmt = $con->prepare("UPDATE comptes SET user = ? WHERE id = ?");
        $stmt->bind_param("si", $pivot, $id_cookie_value);
        $stmt->execute();
        $_SESSION['s_user'] = $pivot;
        $msg_error = "msg_vide";
    }
    $stmt->close();
}elseif (isset($_POST["naissance"])) {
    $pivot = $_POST["naissance"];
    $stmt = $con->prepare("UPDATE comptes SET naissance = ? WHERE id = ?");
    $stmt->bind_param("si", $pivot, $id_cookie_value);
    $stmt->execute();
    $stmt->close();
    $_SESSION['s_naissance'] = $pivot;
    $msg_error = "msg_vide";
}elseif (isset($_POST["mail"])) {
    $pivot = $_POST["mail"];
    $stmt = $con->prepare("SELECT * FROM comptes WHERE mail = ?");
    $stmt->bind_param("s", $pivot);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == 1) {
        $msg_error = "msg_mail";
    } elseif (mysqli_num_rows($result) == 0) {
        $stmt = $con->prepare("UPDATE comptes SET mail = ? WHERE id = ?");
        $stmt->bind_param("si", $pivot, $id_cookie_value);
        $stmt->execute();
        $_SESSION['s_mail'] = $pivot;
        $msg_error = "msg_vide";
    }
    $stmt->close();
}elseif (isset($_POST["old_password"])AND isset($_POST["password"])) {
    $pivot = $_POST["old_password"];
    $stmt = $con->prepare("SELECT * FROM comptes WHERE id = ?");
    $stmt->bind_param("s", $id_cookie_value);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc() ;
            if($row["password"] != $pivot){
                $msg_error = "msg_password";
            }else{
                $stmt = $con->prepare("UPDATE comptes SET password = ? WHERE id = ?");
                $stmt->bind_param("si", $_POST["password"], $id_cookie_value);
                $stmt->execute();
                $msg_error = "msg_vide";
            }
          
    } 
    $stmt->close();
}

$my_array = array(
    'mail_content' => $_SESSION['s_mail'],
    'first_name_content' => $_SESSION['s_first_name'],
    'name_content' => $_SESSION['s_name'],
    'naissance_content' => $_SESSION['s_naissance'],
    'user_content' => $_SESSION['s_user'],
);

$response = array(
    'myArray' => $my_array,
    'myString' => $msg_error
);

$con->close();
echo json_encode($response);
?>
