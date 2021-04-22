<!DOCTYPE html>
<html>
 <head>
  <title>login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <link  rel="stylesheet" href = "CSS/main.css">
 <body>
   <div class="flex-center position-ref full-height">

           <div class="top-right links">


                   <a href="index.php">Home</a>
                   <a href="register.php">Register</a>

           </div>
 <form method="POST" action="login_verification.php" >

 <!-- <div class="main"> -->

<div class="form-box">
<b>Email:<b><br>
<i class="fas fa-user" style="margin-right: 15px;  width: 60%; "></i> <input type="text" name="email" size="30" value="" required/>
<br>
<br>
 <b>Password:<b><br>
<i class="fas fa-key" style="margin-right: 15px; width: 60%;"></i> <input type="password" name="password" size="30" value="" required />
<p>
<br>
<br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Login" />
 <a href="forgotpass.php" class="btn btn-default" style="color:black; font-weight:bold;">Forgot password</a>
 </p>
</div>

 </form>

 </body>
</html>
