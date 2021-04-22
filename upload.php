<html>
<head>
  <title>upload</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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


<form style="margin:10%;" method="post" enctype="multipart/form-data" action="upload_data.php">
  <h2> <b>upload new document</b> <a href="home.php">         | Go to home</a> </h2>
  <div class="form-group">
    <label for="exampleFormControlInput1"> Title </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Title" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1"> Contributor author </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="contributor_author" placeholder="Contributor author" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1"> Description abstract </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="description_abstract" placeholder="Description abstract" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1"> contributor committeechair </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="contributor_committeechair" placeholder="contributor committeechair" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1"> contributor committeemember </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="contributor_committeemember" placeholder="contributor committeemember" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1"> contributor department </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="contributor_department" placeholder="contributor department" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">  subject </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="subject" placeholder="subject" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">  Indentifier Source URL </label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="identifier_sourceurl" placeholder="Indentifier Source URL" required>
  </div>
  <div class="form-group">
    <label class="custom-file-label" for="exampleFormControlInput1" >Date</label>
  <input type="date" class="form-control" id="date" name="date" required>

</div>
  <div class="form-group">
    <label class="custom-file-label" for="exampleFormControlInput1" >PDF document</label>
  <input type="file" class="form-control" id="customFile" name="document_pdf" required>

</div>
  <div class="form-group">
    <input type="submit" class="form-control" id="upload_document" name="upload_document" value="upload">
  </div>
  <input type="hidden" name="action" value="submit" />
</form>

</body>
</html>
