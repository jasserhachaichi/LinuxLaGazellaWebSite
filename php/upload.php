<!-- PHP code (in upload.php) -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $image = $_FILES["file"];
  //echo '<pre>';
  //print_r($image);
  //echo "jasser";
  //echo '</pre>';
  //$image_name = $_FILES["file"]["name"];
  $image_type = $_FILES["file"]["type"];
  $image_temp = $_FILES["file"]["tmp_name"];
  $image_size = $_FILES["file"]["size"];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($image["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $error_msg ="";
  // Check if image file is a actual image or fake image
  $check = getimagesize($image_temp);
  if($check === false) {
    $error_msg .= "File is not an image. <br>";
    $uploadOk = 0;
  }

  // Check file size
  if ($image_size > 4096000) {
    $error_msg .= "Sorry, your file is too large. <br>";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $error_msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
        $response = array(
          'myString_1' => $error_msg,
          'myString_2' => "Sorry, your file was not uploaded."
        );
  
        echo json_encode($response);
        
   }else{// if everything is ok, try to upload file
        
                //echo $target_file; // return the path to the uploaded image
                $con= mysqli_connect("localhost","root","","gazella");
                if($con->connect_error){
                die("Connection failed: " . $con->connect_error);
                }else{
                        //$image_temp_content = file_get_contents($image_temp);
                        session_start();
                        // Encoder les données en base64
                        while (true ){
                          $random_bytes = openssl_random_pseudo_bytes(5);
                          $random_string = bin2hex($random_bytes);
                          $random_str = substr($random_string, 0, 10);
                          //echo "<br>" . $random_str . "<br>";
                          $query = "SELECT * FROM image WHERE nom='$random_str'";
                          $result = mysqli_query($con, $query);
                          if(mysqli_num_rows($result) == 0){
                              //echo $v_rand;
                              break;
                          }
                      }
                      $new_img_nom = $random_str . "." . $imageFileType;
                      $new_dir =   $target_dir . $new_img_nom ;
                      if (move_uploaded_file($image_temp, $new_dir)){
                        $base64data = base64_encode($image_temp);
                        //echo $base64data;
                        //$original_string = base64_decode($base64data);
                        $id_cookie_value = $_COOKIE['id_cookie'];


                        $query3 = "SELECT * FROM image WHERE id='$id_cookie_value'";
                        $result3 = mysqli_query($con, $query3);
                        if(mysqli_num_rows($result3) == 0){
                          $query1 =  "INSERT INTO image (id, nom, taille, type, bin ,imgpath) VALUES ('$id_cookie_value', '$random_str', '$image_size', '$image_type', '$base64data' ,'$new_dir')";
                        }// end resultat3
                        else{
                          $row = $result3->fetch_assoc();
                          if (file_exists($row["imgpath"])) {
                            unlink($row["imgpath"]);
                            //echo "File deleted successfully.";
                          }
                          $query1= "UPDATE image SET nom='$random_str',taille='$image_size' ,type= '$image_type',bin='$base64data',imgpath='$new_dir'   WHERE id='$id_cookie_value'";
                        }
                        if (mysqli_query($con, $query1)) {
                          $response = array(
                            'myString_1' => $new_dir,
                            'myString_2' => "Your profile photo was successfully modified"
                          );
                          $_SESSION['s_user_img_path'] = $new_dir;
                        
                          echo json_encode($response);
                        } else {
                            echo "Erreur: " . $query1 . "<br>" . mysqli_error($con);
                        }

                        $con->close();
                        























                      }else{echo "Sorry, there was an error uploading your file.";}
                      }//end else connexion







        
   }
   

}
?>