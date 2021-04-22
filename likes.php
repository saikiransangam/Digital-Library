<?php
session_start();
require_once('dbConnection.php');
global $dbc;

$email = $_SESSION['email'];

  $handleId = $_POST['handleId'];

  $claim_number = $_POST['claim_number'];


  $select_like = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$claim_number'";
  $result_like = mysqli_query($dbc,$select_like);

  if(mysqli_num_rows($result_like)>0){

    $select_like_test = "select * from like_dislike where user_email='$email' and handleId='$handleId' and claim_number='$claim_number' and like_claim=1";
    $result_like_test = mysqli_query($dbc,$select_like_test);

    if(mysqli_num_rows($result_like_test)>0){
          $update_like_to_0 = "update like_dislike set like_claim = 0 where user_email='$email' and handleId='$handleId' and claim_number='$claim_number'";
          $result_update_like_to_0 = mysqli_query($dbc,$update_like_to_0);
    }
    else{
      $update_dislike = "update like_dislike set like_claim=1,dislike_claim=0 where user_email='$email' and handleId='$handleId' and claim_number='$claim_number'";
      $upadate_query = mysqli_query($dbc,$update_dislike);
    }

    
  }
  else{
    $insert_dislike_like = "insert into like_dislike(user_email,handleId,claim_number,like_claim,dislike_claim) value('$email','$handleId','$claim_number',1,0)";
    $insert_query_final = mysqli_query($dbc,$insert_dislike_like);
  }
 ?>
