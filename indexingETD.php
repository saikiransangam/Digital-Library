<?php
set_time_limit(0);
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$extension="json";
// $folder_name=11042;

$main_dir= new RecursiveDirectoryIterator('dissertation/');
// $path = '/Users/anuradhamantena/WP/dissertation/';
// $c=0;
foreach (new RecursiveIteratorIterator($main_dir) as $key => $folder_name) {

    $ext = pathinfo($folder_name, PATHINFO_EXTENSION);
    if($ext == $extension) {
        // $file = '11042/11042.json';
        $json = file_get_contents($folder_name);
        // print($json);
        $params = [
  'index' => 'elasticweb',
  'body'  => $json
        ];

        try{
            $response = $client->index($params);
        } catch(Exception $e) {

            }
        }
    }
      function sendResponseToElasticSearch($params){
          $client = $GLOBALS["client"];
          print_r($client);
      }


 ?>
