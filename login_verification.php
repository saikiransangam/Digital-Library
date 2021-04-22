<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    session_start();
    require_once('dbConnection.php');
    if(isset($_POST['submit'])){
       global $dbc;
        $mail_id = trim(mysqli_real_escape_string($dbc,$_POST['email']));
        $password = md5(trim(mysqli_real_escape_string($dbc,$_POST['password'])));
        $table = "users";
        $query = "SELECT * from $table where email = '$mail_id' and password = '$password'";
        $result = mysqli_query($dbc, $query);

        $affected_rows = mysqli_num_rows($result);
        $rowg= mysqli_fetch_array($result);
        if($affected_rows == 1 and $rowg['active'] == 1){

            $_SESSION['email'] = $rowg['email'];
            $_SESSION['name'] = $rowg['name'];
            echo "Login success";
  header("refresh:0, url=home.php");
        }
        else{
            echo "<div class='main'><br>Incorrect Info..! Enter again..! or your email has not verified";
          //  header("refresh:2, url=login.php");
    }
  }
?>
