<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel ="stylesheet" a href="CSS\main.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  </head>
<body>

  <div class="flex-center position-ref full-height">

          <div class="top-right links">
                 <a href="Index.php">Home</a>
                  <a href="login.php">Login</a>

          </div>
    <div class="form-box">
    <form method="POST" >
	First Name:<br>
	<input type="text" name="name" size="30" value="" required/> <br><br>
  Last Name:<br>
	<input type="text" name="lname" size="30" value="" required/> <br><br>
	Email:<br>
	<input type="email" name="email_id" size="30" value="" required/> <br><br>
	Password:<br>
	<input type="Password" name="pass" size="30" value="" required/> <br><br>
	Confirm Password:<br>
	<input type="Password" name="cpass" size="30" value="" required/> <br><br>
	<input type="submit" class="btn btn-success " style="color:black; font-weight:bold; margin-left: 80px;"  name="submit" value="Register" />
  <p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>

<?php
  require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  require_once('dbConnection.php');
if(isset($_POST['submit'])){
    global $dbc;
    $fname =htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['name']));
    $lname =htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['lname']));
    $mail_id=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['email_id']));
    $pass=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['pass']));
    $cpass=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['cpass']));
    $userTable = "users";
    $user_query = "SELECT email FROM $userTable WHERE email='$mail_id' LIMIT 1";
    $user_result= mysqli_query($dbc,$user_query);
    //$row = mysqli_fetch_array($user_result);
    $password = md5($pass);
    $hash = md5( rand(0,1000) );
  //  $existing_email= $row['email'];
    //$search = query("SELECT * FROM users WHERE email='?' ", $_POST['email_id']);
    if($pass != $cpass){
        echo "<br>Oops!! password does not match";
    }

    else if( mysqli_num_rows($user_result) > 0){

        echo "<div class='main'><br>Email already exists";
    }

    else {
        $insert = "insert into users(name,lname,email,password,hash,active) values('$fname','$lname','$mail_id', '$password','$hash','')";
        $run = mysqli_query($dbc,$insert);

        $to      = $mail_id; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject
        $message = '

        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

        ------------------------
        Username: '.$fname.'
        ------------------------

        Please click this link to activate your account:
        http://localhost/Web-Programming/index.php?email='.$mail_id.'&hash='.$hash.'

        '; // Our message above including the link

      //  $headers = 'From:noreply@localhost.com' . "\r\n"; // Set from headers
      //  mail($to, $subject, $message, $headers);




      //Load Composer's autoloader


      //Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'sangamskrn@gmail.com';                   //SMTP username
          $mail->Password   = 'Develop@77';                               //SMTP password
        //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

          //Recipients
          $mail->setFrom('from@example.com', 'Mailer');
          $mail->addAddress($mail_id, $fname);     //Add a recipient
        //  $mail->addAddress('ellen@example.com');               //Name is optional
        //  $mail->addReplyTo('info@example.com', 'Information');
        //  $mail->addCC('cc@example.com');
        //  $mail->addBCC('bcc@example.com');

          //Attachments
          //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = $subject;
          $mail->Body    = $message;
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->SMTPDebug = 0;
          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }



        echo "Registered Successfully! please verify your email!";
//  header("refresh:1, url=login.php");
     }
}
?>
</div>
</div>
</body>
</html>
