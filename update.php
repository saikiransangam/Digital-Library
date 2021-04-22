<!DOCTYPE html>
<html>
 <head>
  <title>login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" href = "CSS/main.css">
 </head>
 <body>
   <div class="flex-center position-ref full-height">

             <div class="top-right links">

                     <a href="home.php">Home</a>
                     <a href="profile.php">Profile</a>


             </div>
    <?php
      session_start();
    if(!isset($_SESSION['email'])){
      header("Location:index.php");
    }

    ?>
 <form method="POST" >

<!--   -->
 <div class="form-box">
<div class="main">
<b> Update Information</b>
<br>
<br>
Email:<br>
<i class="fas fa-user" style="margin-right: 5px;"></i> <?php echo $_SESSION['email'];  ?>
<br>
<br>
 Name:<br>
<i class="fas fa-key" style="margin-right: 5px;"></i> <input type="text" name="name" size="30" value="" required />
<br>
<br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Reset" />
 </p>
</div>

 </form>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        //session_start();
        require_once('dbConnection.php');
        if(isset($_POST['submit'])){
            global $dbc;
            $mail_id = trim(mysqli_real_escape_string($dbc,$_SESSION['email']));
            $name = trim(mysqli_real_escape_string($dbc,$_POST['name']));
            $table = "users";
            $query = "UPDATE $table SET name = '$name' where email = '$mail_id'";
            $result = mysqli_query($dbc, $query);
            if($result){
                echo "Your name has been updated successfully";
              //  header("refresh:2; url=login.php");
            }
            else {
              echo "Not updated!";
            }
        }
    ?>
