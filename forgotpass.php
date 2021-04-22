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
                      <a href="login.php">Login</a>

              </div>
   <?php
     session_start(); ?>


 <form method="POST" >

<!--   -->
 <div class="form-box">
<div class="main">
<b>Change password</b>
<br>
<br>
Email:<br>
<i class="fas fa-user" style="margin-right: 5px;"></i><input type="text" name="email" size="30" required />
<br>
<br>

 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit_email" value="Reset" />
 </p>
</div>

 </form>
    <?php
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    require_once('dbConnection.php');
        if(isset($_POST['submit_email'])){
            global $dbc;
            $email = $_POST['email'];
            $select = "select * from users where email = '$email' ";
            $result = mysqli_query($dbc, $select);
            $count = mysqli_num_rows($result);
            if($count >= 1){
            $data = mysqli_fetch_array($result);
            $emailData = $data['email'];

            if($email == $emailData){
              //echo "$email";
              $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
              $password = substr( str_shuffle( $chars ), 0, 8 );
              $new_password_insert=md5($password);
              //echo "$password";
              $final_result = mysqli_query($dbc,"update users set password ='".$new_password_insert."'where email = '".$email."'");

            $to      = $email; // Send email to our user
            $subject = 'New Password'; // Give the email a subject
            $message = '

            Your new password was below, you can login with the following credentials

            <br>
            ------------------------ <br>
            New password :'.$password.' <br>
            --------------------';

            // Our message above including the link

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
              $mail->addAddress($email);     //Add a recipient
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
            //$mail_id = trim(mysqli_real_escape_string($dbc,$_SESSION['email']));

            if($final_result){
                echo "<br><br><br><br><br><br><br>Your password has been changed successfully";
      //          header("refresh:2; url=login.php");
            }
        //    else{
          //      echo 'Incorrect email..! Enter again..!';
            //    header("refresh:2; url=changepass.php");
      }
    }else{

      echo "email does not exists";
    }
  }

    ?>
