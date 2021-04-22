<?php

  require_once '../initelastic.php';
  if(isset($_GET['search_query'])){
  $query_str = strip_tags($_GET['search_query']);

  $params = [
    'index' => 'elasticweb',
    //'type' => '_doc',
    //'from' => $start_search,
    'size' => 1000,
    'body' => [
        'query' => [
          'query_string' =>[
            'query' => $query_str,
          ]
        ]
    ]
  ];

  $query = $client->search($params);
  print_r($query);

}
 ?>
