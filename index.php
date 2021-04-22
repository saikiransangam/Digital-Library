<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digital Library</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link  rel="stylesheet" href = "css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

        </style>

    </head>
    <body>


      <?php
      require_once('dbConnection.php');
      global $dbc;
      if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
      $mail_id=htmlspecialchars(mysqli_real_escape_string($dbc,$_GET['email']));
      $hash=htmlspecialchars(mysqli_real_escape_string($dbc,$_GET['hash']));
      $search = "SELECT email,hash,active FROM users WHERE email='$mail_id' and hash='$hash' AND active='0'";
        $search_result= mysqli_query($dbc,$search);


      if(mysqli_num_rows($search_result) > 0)
      {

      mysqli_query($dbc,"UPDATE users SET active='1' WHERE email='".$mail_id."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
      echo '<div>Your account has been activated, you can now login</div>';
      }else{
        echo '<div>Your account has been already activated, you can now login</div>';
      }

          // Verify data
      }else{
          // Invalid approach
      }
       ?>

       <script>
       var recognition = new webkitSpeechRecognition();

       recognition.onresult = function(event) {
         var saidText = "";
         for (var i = event.resultIndex; i < event.results.length; i++) {
           if (event.results[i].isFinal) {
             saidText = event.results[i][0].transcript;
           } else {
             saidText += event.results[i][0].transcript;
           }
         }
         // Update Textbox value
         document.getElementById('speechText').value = saidText;

         // Search Posts
         searchPosts(saidText);
       }

       function startRecording(){
         recognition.start();
       }

       </script>

        <div class="flex-center position-ref full-height">
                <div class="top-right links">
                        <a href="Login.php">Login</a>
                        <a href="register.php">Register</a>
                </div>
        <div class="header">


		<form id="labnol" action="results.php" method="GET" role="search">
      <h1> DIGITAL LIBRARY</h1>
		  <div class="form-box">
          <input type ="text" id="speechText" name="search_query" class="search" name="q" placeholder = "Search" id="transcript" />
          <i id='start' value='start' class="fa fa-microphone fa-4x" style="color:blue;" onclick='startRecording();'></i>
          <button class ="search-btn" type="submit"> Search</button><br>
          <a href="adv.php">advanced search</a>
</div>
</div>

      </form>
                </div>
            </div>
        </div>


    </body>

</html>
