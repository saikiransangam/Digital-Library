<!DOCTYPE html>
<html>
    <head>
      <link  rel="stylesheet" href = "CSS/main.css">
         <meta charset="utf-8">
	 <title>search</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  </head>

	  <body>
      <?php

if(!session_start())
{
  session_start();
}
if(!isset($_SESSION['email'])){
  header("Location:index.php");
}
  ?>
  <?php echo "Welcome! " ?>
  <div class="flex-center position-ref full-height">

          <div class="top-right links">

                  <a href="ListFavourite.php">Favourites</a>
                  <a href="profile.php">Profile</a>
                  <a href="logout.php">Logout</a>

          </div>
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
		<form action="results.php" method="get">

      <h1> DIGITAL LIBRARY</h1>
		  <div class="form-box">
		  <input type ="text" name="search_query" id="speechText" class="search" placeholder = "Search a book">
      <br>

    <!--  <input type='button' id='start' value='start' onclick='startRecording();'> -->
    <i id='start' value='start' class="fa fa-microphone fa-4x" style="color:blue;" onclick='startRecording();'></i>
		  <button class ="search-btn" type="submit"> Search</button>
      <a href="adv.php">advanced search</a>
      <a href="upload.php">upload</a>

		  </form>
		  </div>
		  </body>
		  </html>
