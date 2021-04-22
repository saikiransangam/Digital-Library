<html>
<head>
  <style>

  .radio-toolbar input[type="radio"] {
opacity: 0;
position: fixed;
width: 0;
}
.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 10px 20px;
    font-family: sans-serif, Arial;
    font-size: 16px;
    border: 2px solid #444;
    border-radius: 4px;
}
.radio-toolbar input[type="radio"]:checked + label {
    background-color:#bfb;
    border-color: #4c4;
}
.radio-toolbar input[type="radio"]:focus + label {
    border: 2px dashed #444;
}
.radio-toolbar label:hover {
  background-color: #dfd;
}


  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<form action="home.php" style="left-margin: 90%;"><input type="submit" value="home"></form>
<div style='border: 2px solid black; margin: 1%; border-radius: 10px; padding: 3px;'>
<?php

  //  if (isset($_SERVER["HTTP_REFERER"])) {
    //    header("Location: " . $_SERVER["HTTP_REFERER"]);
  //  }
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require_once('dbConnection.php');
  global $dbc;
  if(!session_start())
  {
    session_start();
  }






if(isset($_GET['handleId'])){
echo "<h1> Summary on ETD no: ". $_GET['handleId'];
  //echo $_POST['handleId'];


$string = file_get_contents("dissertation/".$_GET['handleId']."/".$_GET['handleId'].".json");
$json_a = json_decode($string,true);
echo "<table>";
foreach ($json_a as $key => $value){


  echo "<tr>";
  echo  "<td>".$key ."</td><td>";
  if(is_array($value)){
    foreach($value as $item){
    echo $item . "\n";
}
  }
  else{
    if($key == "identifier_uri"){
        echo "<a href=".$value." target=\"_blank\">".$value."</a>";
    }
    else{

    echo $value;
  }
  }
  echo "</td>";
  echo "</tr>";
}

echo "</table>";
}
else{

  echo "page not available";
}
 ?>
</div>
<?php
$email = $_SESSION['email'];

if(isset($_GET['handleId'])){
$handleId = $_GET['handleId'];
$select= "select * from claims where handleId='$handleId'";
$run_select = mysqli_query($dbc,$select);
$claim_number = mysqli_num_rows($run_select) + 1;
$i=0;
echo "<div style=\" background-color:#d8edf3\">";
while($row = mysqli_fetch_array($run_select)){
  $i=$i+1;
  $select_like_dislike = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$i'";
  $run_select_like_dislike = mysqli_query($dbc,$select_like_dislike);
  $select_both_zeros = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$i' and like_claim=0 and dislike_claim=0";
  $result_both_zeros = mysqli_query($dbc,$select_both_zeros);
  echo "<div style=\"width:800px; marigin-left: 3%; \">";
    echo "<span style=\"font-size:120%;\"> Claim #".$i." by <b>".$row['user_email']."</b></span>";
    if(mysqli_num_rows($run_select_like_dislike)==0 or mysqli_num_rows($result_both_zeros)==1){
    echo "&nbsp; &nbsp;<i class=\"fa fa-thumbs-up fa-2x like-up\" id='$i' name='$handleId'></i>&nbsp; &nbsp;<i class=\"fa fa-thumbs-down fa-2x like-down\" id='$i' name='$handleId'></i> &nbsp; &nbsp;0<br>";

    }
    else{
$select_like = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$i' and like_claim=1";
$run_select_like = mysqli_query($dbc,$select_like);
if(mysqli_num_rows($run_select_like)>0){
  echo "&nbsp; &nbsp;<i class=\"fa fa-thumbs-up fa-2x like-up\" style=\"color:blue;\" id='$i' name='$handleId'></i>&nbsp; &nbsp;";
  echo "&nbsp; &nbsp;<i class=\"fa fa-thumbs-down fa-2x like-down\" id='$i' name='$handleId'></i>&nbsp; &nbsp;";
}
$select_dislike = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$i' and dislike_claim=1";
$run_select_dislike = mysqli_query($dbc,$select_dislike);
if(mysqli_num_rows($run_select_dislike)>0){
  echo "&nbsp; &nbsp;<i class=\"fa fa-thumbs-up fa-2x like-up\" id='$i' name='$handleId'></i>&nbsp; &nbsp;";
  echo "&nbsp; &nbsp;<i class=\"fa fa-thumbs-down fa-2x like-down\" style=\"color:blue;\" id='$i' name='$handleId'></i>&nbsp; &nbsp;";
}
$select_total_likes = "select * from like_dislike where handleId='$handleId' and claim_number='$i' and like_claim=1";
$run_select_total_likes = mysqli_query($dbc,$select_total_likes);
$select_total_dislikes = "select * from like_dislike where handleId='$handleId' and claim_number='$i' and dislike_claim=1";
$run_select_total_dislikes = mysqli_query($dbc,$select_total_dislikes);
//echo mysqli_num_rows($run_select_total_likes);
//echo mysqli_num_rows($run_select_total_dislikes);
//echo "test---------------------------------------";
echo "".mysqli_num_rows($run_select_total_likes) - mysqli_num_rows($run_select_total_dislikes)."<br>";

    }
    echo "<span style=\"font-size:120%;\"> claim name: <b>".$row['claim_name']."</b></span><br>";
    echo "<span style=\"font-size:120%;\"> Reproduce: <b>".$row['reproduce']."</b></span><br>";
    echo "<span style=\"font-size:120%;\"> Source Code: <b>".$row['sourcecode']."</b></span><br>";
    echo "<span style=\"font-size:120%;\"> Datasets: <b>".$row['datasets']."</b></span><br>";
    echo "<span style=\"font-size:120%;\"> Experiments and results: <b>".$row['expresults']."</b></span><br>";
    //echo $row['handleId'];
echo "</div> <br>";
}
echo "</div>";
}



 ?>
<?php if(isset($_SESSION['email'])){ ?>
  <div style="margin: 1%;">
  <!--  <form action="" id="add_discussion" autocomplete="off" method="post"> -->
    <span style="font-size:150%;"> <b> <span  value="<?php echo $claim_number; ?>">Claim #<?php echo $claim_number; ?></span> by <?php echo $_SESSION['email']; ?> </b>: </span> <br> <br> <input type="text" name="claim_name" id= "claim_name" style="background-color: #e8e8e8; height:5%; width: 40%;font-size:14pt;"></input> <br> <br>
    <span style="font-size:150%;"> Can you reproduce this claim? </span>
     <span class="radio-toolbar">
       <input type="hidden" id="claim_number_val" value="<?php echo $claim_number;?>">
    <input type="radio" id="radioApple" name="reproduce" value="Yes" checked>

    <label for="radioApple">Yes</label>

    <input type="radio" id="radioBanana" name="reproduce" value="No">
    <label for="radioBanana">No</label>

    <input type="radio" id="radioOrange" name="reproduce" value="Partially">
    <label for="radioOrange">Partially</label>
</span> <br><br>
<span style="font-size:150%;"> <b>Proof or experiments: </b></span> <br> <br>
<span style="font-size:150%;"> Source code: </b></span>
<span><input type="text" name="sourcecode" id="sourcecode" style="background-color: #e8e8e8; height:3%; width:30%;font-size:14pt;"></input></span> <br> <br>
<span style="font-size:150%;"> Datasets: </b></span>
<span><input type="text" name="datasets" id="datasets" style="background-color: #e8e8e8; height:3%; width:30%;font-size:14pt;"></input></span> <br> <br>
<span style="font-size:150%;"> Experiments and results: </b></span> <br><br>
<span><textarea style="background-color: #e8e8e8;" rows="8" cols="80" id="expresults" name="expresults"  form="add_discussion">
</textarea></span> <br><br>
<span><input type="submit" id="submit_claim" style="background-color: #4CAF50; width:5%;height:5%;"value="Add Claim" name="add_claim" ></input></span>
<input type="hidden" name="handleId" id="handleId" value="<?php echo $_GET['handleId'];?>"/>
<!--</form>-->
</div>


<?php }

/*if(isset($_POST['add_claim'])){

  $claim_name = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['claim_name']));
  $reproduce = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['reproduce']));
  $sourcecode = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['sourcecode']));
  $datasets = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['datasets']));
  $expresults = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['expresults']));
  $email = $_SESSION['email'];
  $handleId = $_GET['handleId'];
if($claim_name == "" or $reproduce == "" or $sourcecode == "" or $datasets == "" or $expresults == "" ){
  echo "<b>some of the fields are not entered please enter all fields </b>";
}
else{

$insert = "insert into claims(user_email,claim_name,reproduce,sourcecode,datasets,expresults,handleId) value('$email','$claim_name','$reproduce','$sourcecode','$datasets','$expresults','$handleId')";
$run = mysqli_query($dbc,$insert);
unset($_POST['add_claim']);
//echo $insert;
}


}*/




?>
<script>
$(document).ready(function(){

  $("#submit_claim").click(function(){
    var claim_number = $("#claim_number_val").val();
    var claim_name = $("#claim_name").val();
    var reproduce = $('input[name="reproduce"]:checked').val();
    var sourcecode = $("#sourcecode").val();
    var datasets = $("#datasets").val();
    var expresults = $("#expresults").val();
    var handleId = $("#handleId").val();
var add_claim = 'add_claim';
//console.log(claim_number);

    $.ajax({
       url:'saveClaim.php',
       type:'post',
       dataType: "text",
       data:{claim_number:claim_number,add_claim:add_claim,claim_name:claim_name,reproduce:reproduce,sourcecode:sourcecode,datasets:datasets,expresults:expresults,handleId:handleId},
       success:function(response){
    console.log(response);
       location.reload(); // reloading page
       }, error: function (request, error) {
        console.log(arguments);
        alert(" Can't do because: " + error);
    }
    });

  });
});


</script>


<script>
$(document).ready(function(){
  $(".like-up").click(function(){
  //  $(this).toggleClass('unchecked');
  //  $(this).toggleClass('checked');
    var handleId = $(this).attr("name");
    var claim_number = $(this).attr("id");
    $.ajax({
       url:'likes.php',
       type:'post',
       dataType: "text",
       data:{handleId:handleId,claim_number:claim_number},
       success:function(response){
         console.log(response);
          location.reload(); // reloading page
       }, error: function (request, error) {
        console.log(arguments);
      //  alert(" Can't do because: " + error);
    }
    });

  });
});


$(document).ready(function(){
  $(".like-down").click(function(){
  //  $(this).toggleClass('unchecked');
  //  $(this).toggleClass('checked');
    var handleId = $(this).attr("name");
    var claim_number = $(this).attr("id");
    $.ajax({
       url:'dislikes.php',
       type:'post',
       dataType: "text",
       data:{handleId:handleId,claim_number:claim_number},
       success:function(response){
         console.log(response);
          location.reload(); // reloading page
       }, error: function (request, error) {
        console.log(arguments);
      //  alert(" Can't do because: " + error);
    }
    });

  });
});



</script>




</html>
