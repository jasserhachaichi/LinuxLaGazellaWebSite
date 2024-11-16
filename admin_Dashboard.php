<?php 
if (isset($_COOKIE['id_cookie'])){
  $con = mysqli_connect("localhost", "root", "", "gazella");
  if ($con->connect_error) {die("Connection failed: " . $con->connect_error);header("Location: sign_in.html");}
  else{
    $id_cookie_value=$_COOKIE['id_cookie'];
    $query3 = "SELECT * FROM comptes WHERE id='$id_cookie_value'";
    $result3 = mysqli_query($con, $query3);
    if (mysqli_num_rows($result3) == 1){
      $row3 = $result3->fetch_assoc();
      $etatc=$row3["etat"];
      if($etatc != "owner"){
        header("Location: sign_in.html");
        exit();
      }













    }
    $query = "SELECT * FROM comptes ORDER BY creation_date DESC";
    $query1 = "SELECT * FROM notification ORDER BY date_creation DESC";
    $query2 = "SELECT * FROM not_verified ORDER BY creation_date DESC";











  };
















}else {$All_errors .= "Cookies are disabled. <br>";
  header("Location: sign_in.html");}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/for_all.css">
    <link rel="stylesheet" href="css/admin.css">

</head>

<body >
    <div class="Admin-contenu-page">
        <div class="top-div">
            <img id="clickableImage" style="cursor: pointer;" src="images/logo.png" alt="logo">
            <a href="osindex.php">Go to La_Gazella OS</a>
        </div>
        <div class="mid-div">
          <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Accounts')" id="defaultOpen">Accounts</button>
            <button class="tablinks" onclick="openCity(event, 'Notifications')">Notifications</button>
            <button class="tablinks" onclick="openCity(event, 'NVA')">Not verified account</button>
          </div>
          







          <div id="Accounts" class="tabcontent">
            <table>
              <thead>
                <tr>
                <th>Id</th>
                <th>User</th>
                <th>Role</th>
                <th>Mail</th>
                <th>Name</th>
                <th>First Name</th>
                <th>state</th>
                <th>Creation Date</th>
                <th>Country</th>
                <th>Birth</th>
                <th>Nb_file</th>
                <th>Storage</th>
                <th>Grade</th>
                <th>Password</th>
                <th>Activation</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $result = $con->query($query);

              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo '<tr><td>' . $row["id"] . '</td><td>' . $row["user"].'</td><td>'. $row["Role"].'</td><td>'. $row["mail"].'</td><td>'. $row["nom"].'</td><td>'. $row["prenom"].'</td><td>'. $row["etat"].'</td><td>'. $row["creation_date"].'</td><td>'. $row["pays"].'</td><td>'. $row["naissance"].'</td><td>'. $row["nb_fich"].'</td><td>'. $row["stockage"].'</td><td>'. $row["grad"].'</td><td>'. $row["password"].'</td><td>'. $row["Activation"].'</td><td></tr>';
                }
              } else {
                echo "<p>Empty</p>";
              }
              
              ?>


              </tbody>
          </table>
          
          </div>
          










          <div id="Notifications" class="tabcontent">
          <table>
              <thead>
                <tr>
                <th>Id_notification</th>
                <th>Id_user</th>
                <th>Source</th>
                <th>Message</th>
                <th>Creation Date</th>
                <th>state</th>
                </tr>
              </thead>
              <tbody>
          <?php 
              $result1 = $con->query($query1);

              if ($result1->num_rows > 0) {
                // output data of each row
                while($row1 = $result1->fetch_assoc()) {
                  echo '<tr><td>' . $row1["id_notification"] . '</td><td>' . $row1["id_user"] . '</td>'.'<td>' . $row1["source"] . '</td>'.'<td>' . $row1["message"] . '</td>'.'<td>' . $row1["date_creation"] . '</td>'.'<td>' . $row1["status"] . '</td></tr>'; 			
                }
              } else {
                echo "<p>Empty</p>";
              }
              ?>
              </tbody>
          </table>
          </div>
          
          <div id="NVA" class="tabcontent">
          <table>
              <thead>
                <tr>
                <th>Id</th>
                <th>Creation Date</th>
                <th>User</th>
                <th>Mail</th>
                <th>Name</th>
                <th>First Name</th>
                <th>Country</th>
                <th>Birth</th>
                <th>Password</th>
                <th>Code</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $result2 = $con->query($query2);

              if ($result2->num_rows > 0) {
                // output data of each row
                while($row2 = $result2->fetch_assoc()) {
                  echo '<tr><td>' . $row2["id"] . '</td><td>' . $row2["creation_date"] . '</td><td>' .$row2["user"] . '</td><td>' .$row2["mail"] . '</td><td>' .$row2["nom"] . '</td><td>' .$row2["prenom"] . '</td><td>' .$row2["pays"] . '</td><td>' .$row2["naissance"] . '</td><td>' .$row2["password"] . '</td><td>' .$row2["code"] . '</td></tr>';						
                }
              } else {
                echo "<p>Empty</p>";
              }
              				

              ?>


              </tbody>
          </table>
          </div>














        </div>
                                    <div class="todelete">
                                    <h1>Delete Account</h1>
                                        <div>
                                            <label for="accountId">Account ID:</label>
                                            <input type="text" id="accountId" placeholder="Enter Account ID">
                                            <a onclick="deletemail()">Delete Account</a>
                                        </div>
                                    </div>













    </div>








</body>
<footer>
    <span>Designed & Developed By <a href="https://www.facebook.com/jasser.hachaichi.14">Jasser Hachaichi</a> & <a href="https://www.facebook.com/profile.php?id=100008634882462">Ameni Bouaziza</a> | <span
            class="far fa-copyright"></span>
        2023 All rights reserved.</span>
</footer>
<script src="js/Admin.js"></script>

</html>