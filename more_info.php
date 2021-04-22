<html>
<form action="home.php" style="left-margin: 90%;"><input type="submit" value="home"></form>

<?php

  //  if (isset($_SERVER["HTTP_REFERER"])) {
    //    header("Location: " . $_SERVER["HTTP_REFERER"]);
  //  }



if(isset($_GET['handleId'])){
echo "<h1> More Information on ETD no: ". $_GET['handleId'];
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
</html>
