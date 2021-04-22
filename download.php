<?php
if(isset($_GET['download'])){

$dir="dissertation/".$_GET['download'];

if (file_exists($dir) && is_dir($dir) ) {

      // Get the files of the directory as an array
      $scan_arr = scandir($dir);
      $files_arr = array_diff($scan_arr, array('.','..') );
    //  echo $files_arr[0];
  //    echo print_r($files_arr);
      // echo "<pre>"; print_r( $files_arr ); echo "</pre>";
      // Get each files of our directory with line break
     foreach ($files_arr as $file) {
        //Get the file path
       $file_path = $dir."/".$file;
        // Get the file extension
       $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
       if ($file_ext=="pdf") {
         echo $file."<br/>";

         header('Content-Description: File Transfer');
         header('Content-Type: application/octet-stream');
         header("Cache-Control: no-cache, must-revalidate");
         header("Expires: 0");
         header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
         header('Content-Length: ' . filesize($file_path));
         header('Pragma: public');

flush();
readfile($file_path);
die();






         break;
       }

     }
  }

}



?>
