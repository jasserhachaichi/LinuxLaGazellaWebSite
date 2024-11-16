<?php
// Start a session
session_start();
setcookie("id_cookie","", time()-1);

// Unset all of the session variables
//unset($_COOKIE["id_cookie"]);
$_SESSION = array();

// Destroy the session
session_destroy();
sleep(1.5);
// Redirect to login page
header("Location: ../sign_in.html");
exit;
?>
