<<?php

session_start();
require_once('dbConnection.php');
global $dbc;

$email = $_SESSION['email'];

  $handleId = $_POST['handleId'];

  $select_query = "select * from favourites where email='$email' and handleId='$handleId'";
  $run_select = mysqli_query($dbc,$select_query);
  $affected_rows = mysqli_num_rows($run_select);

  if($affected_rows>0){
    $delete_query = "delete from favourites where email='$email' and handleId='$handleId'";
    mysqli_query($dbc,$delete_query);
  }
  else{
    $insert_query = "insert into favourites(email,handleId) values('$email','$handleId')";
    mysqli_query($dbc,$insert_query);
  }

 ?>
