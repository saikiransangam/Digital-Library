<?php
require 'vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$client = Elasticsearch\ClientBuilder::create()->build();
?>
