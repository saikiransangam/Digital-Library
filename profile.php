<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	    <title>search</title>
      <link rel ="stylesheet" a href="CSS\main.css">
	  </head>
	  <body>
      <div class="flex-center position-ref full-height">

              <div class="top-right links">


                      <a href="home.php">Home</a>


              </div>
      <div class="form-box">
<?php

if(!session_start())
{
  session_start();
}
if(!isset($_SESSION['email']))
  header("Location:index.php");
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  //session_start();
  require_once('dbConnection.php');

      global $dbc;
      $mail_id = trim(mysqli_real_escape_string($dbc,$_SESSION['email']));
    //  $name = trim(mysqli_real_escape_string($dbc,$_POST['name']));
      $table = "users";
      $query = "SELECT * from $table where email = '$mail_id'";
      $result = mysqli_query($dbc, $query);
      $profile_information = mysqli_fetch_array($result);


?>
<label> Name: <?php echo $profile_information['name'] ?>
<br>
<label> Email: <?php echo $profile_information['email'] ?>
<br>
<label><a href = 'changepass.php'> Change Password </a>
<label><a href = 'update.php'> Update Information </a>
<br>
<div>
</body>
</html>
