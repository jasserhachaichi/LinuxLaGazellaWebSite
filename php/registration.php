<?php
$con= mysqli_connect("localhost","root","","gazella");
if($con->connect_error){
    die("Connection failed: " . $con->connect_error);
}
else{
    session_start();
    $mail = $_SESSION['mail_content'];
    $user = $_SESSION['user_content'];
        $pwd = $_POST['pwd'];
    $first_name = $_POST["first_name"];
    $name = $_POST["name"];
    $datemin = $_POST["datemin"];
    $city = $_POST["city"];
    //$msg = $user . "<br>" .  $mail . "<br>" . $pwd . "<br>" . $first_name .  "<br>" .  $name .  "<br>" .  $datemin .  "<br>" .  $city ;
    //echo $msg;
    //$xx = 0 ;
    while (true ){
        $v_rand = rand(10,1000);
        $query1 = "SELECT * FROM comptes WHERE id='$v_rand'";
        $result1 = mysqli_query($con, $query1);
        if(mysqli_num_rows($result1) == 0){
            //echo $v_rand;
            break;
        }
    }
    while (true ){
        $verificationCode = rand(10,1000);
        $query1 = "SELECT * FROM not_verified WHERE id='$verificationCode'";
        $result1 = mysqli_query($con, $query1);
        if(mysqli_num_rows($result1) == 0){
            //echo $v_rand;
            break;
        }
    }


    

    
     
    $sql = "INSERT INTO not_verified (id, user, mail, nom, prenom, pays, naissance, password,code) VALUES ('$v_rand', '$user', '$mail', '$name', '$first_name', '$city', '$datemin', '$pwd','$verificationCode' )";


    setcookie('id_cookie', $v_rand, time() + 32140800, '/');
    if ($con->query($sql) === TRUE) {
        //$_SESSION['password_content'] = $pwd;
        //$_SESSION['first_name_content'] = $first_name;
        //$_SESSION['name_content']=$name;
        //$_SESSION['datemin_content']=$datemin;
        //$_SESSION['city_content']=$city; 
        //$_SESSION['Role_content']= "member";
        //$_SESSION['etat_content']= "free";
        //$_SESSION['nbfich_content']= 0;
        //$_SESSION['stockage_content']= 50;
        //$_SESSION['grad_content']= "new";
        //session_start();

        // Encoder toutes les données de session en une chaîne de caractères
        //$session_data = session_encode();

        // Définir un cookie pour stocker la chaîne de caractères encodée
        //setcookie('my_session', $session_data, time() + (86400 * 30), '/');

        // Fermer la session
        //session_write_close();
        // Create an array with multiple values
           // $my_array = array(
              //  'mail_content' => $mail,
             //  'user_content' => $user,
             //  'password_content' => $pwd,
              //  'first_name_content' => $first_name,
              //  'name_content' => $name,
               // 'datemin_content' => $datemin,
              //  'city_content' => $city,
             //   'Role_content' => "member",
              //  'etat_content' => "free",
            //   'nbfich_content' => 0,
            //    'stockage_content' => 50,
             //   'grad_content' => "new"
            //);

             //Encode the array as a JSON string
           // $my_json = json_encode($my_array);

            // Set the cookie with the JSON string as the value
            //setcookie('my_cookie', $my_json, time() + 32140800, '/');
           // setcookie('id_cookie', $v_rand, time() + 32140800, '/');


        
        
        header("Location: ./phpmailer/The_mailer.php");
        exit; // Make sure to exit after the redirect to prevent further execution
        



    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }


}
$con->close();
?>