<?php
require_once('dbConnection.php');
global $dbc;
if(!session_start())
{
  session_start();
}
if(isset($_POST['add_claim'])){
  $claim_number = $_POST['claim_number'];
  $claim_name = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['claim_name']));
  $reproduce = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['reproduce']));
  $sourcecode = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['sourcecode']));
  $datasets = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['datasets']));
  $expresults = htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['expresults']));
  $email = $_SESSION['email'];
  $handleId = $_POST['handleId'];
if($claim_name == "" or $reproduce == "" or $sourcecode == "" or $datasets == "" or $expresults == "" ){
  echo "<b>some of the fields are not entered please enter all fields </b>";
}
else{

$insert = "insert into claims(claim_number,user_email,claim_name,reproduce,sourcecode,datasets,expresults,handleId) value('$claim_number','$email','$claim_name','$reproduce','$sourcecode','$datasets','$expresults','$handleId')";
$run = mysqli_query($dbc,$insert);
unset($_POST['add_claim']);
//echo $insert;
echo 1;
die();
}


}
?>
