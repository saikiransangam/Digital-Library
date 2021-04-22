<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
set_time_limit(0);
require 'vendor/autoload.php';
if(!session_start())
{
session_start();
}
if(!isset($_SESSION['email'])){
header("Location:index.php");
}
//echo "hello";

$files2 = scandir('dissertation', 1);
$new_file_name = intval(array_values($files2)[0])+1;


class doc {

}

$doc = new doc();


if (isset($_POST['action'])){
$doc -> title = $_POST['title'];
$doc -> contributor_author = $_POST['contributor_author'];
$doc -> description_abstract = $_POST['description_abstract'];
$doc -> contributor_committeechair = $_POST['contributor_committeechair'];
$doc -> contributor_committeemember = $_POST['contributor_committeemember'];
$doc -> contributor_department = $_POST['contributor_department'];
$doc -> subject = $_POST['subject'];
$doc -> identifier_sourceurl = $_POST['identifier_sourceurl'];
$doc -> date = $_POST['date'];
$doc -> document_pdf = $new_file_name.'/'.basename($_FILES['document_pdf']['name']).PHP_EOL;
$doc -> handle = $new_file_name;
$jsonData = json_encode($doc);

//echo $jsonData."\n";

if (!file_exists('dissertation/'.$new_file_name)) {
  mkdir('dissertation/'.$new_file_name, 0777, true);
  file_put_contents('dissertation/'.$new_file_name."/".$new_file_name.".json", $jsonData);
}

if(isset($_FILES['document_pdf'])){
    $uploadTo = "dissertation/".$new_file_name."/";
    $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
    $fileName = $_FILES['document_pdf']['name'];
    $tempPath=$_FILES["document_pdf"]["tmp_name"];



    $basename = basename($fileName);
    $originalPath = $uploadTo.$basename;
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION);

    if(!empty($fileName)){

       if(in_array($fileType, $allowFileType)){

         // Upload file to server
         if(move_uploaded_file($tempPath,$originalPath)){
echo "succes";
            //return $fileName." was uploaded successfully";

           // write here sql query to store image name in database

          }else{
            $error = 'File Not uploaded ! try again';
          }
      }else{
         return $fileType." file type not allowed";
      }
   }else{
    return "Please Select a file";
   }

}

//mkdir("./dissertation//".$new_file_name, 0755);
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
'index' => 'elasticweb',
'body'  => $jsonData
];

try{
    $response = $client->index($params);
} catch(Exception $e) {

    }

}




//tile,Contributor author,Description abstract,Contributor committee chair,contributor commitee member,contributor department,
//date,Subject,indentifier Source URL, file
header("refresh:0, url=upload.php");
echo "hello";

?>
