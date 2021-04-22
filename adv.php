<!DOCTYPE html>
<html>
<head>
<title>Advance Search</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digital Library</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link  rel="stylesheet" href = "css/main.css">
        <style>
        .submitLink {
background-color: transparent;
text-decoration: underline;
border: none;
color: blue;
cursor: pointer;
}
submitLink:focus {
outline: none;
}
        </style>

  </head>
<body>

  <div style="text-align: center ; margin-top: 3%">

          <div class="top-right links">
                 <a href="Index.php">Home</a>

          </div>
    <div>
    <form action="" method="GET">
  <h3>Advance Search</h3>
	Title:
	<input type="text" name="title" size="30"  value=""/>
	contributor_author:
	<input type="text" name="author" size="30" value="" />
	degree_grantor:
	<input type="text" name="university" size="30" value="" />
	<input type="submit" class="btn btn-success " style="color:black; font-weight:bold; margin-left: 80px;"  name="submit" value="Search" />

</form>
<?php
require_once 'initelastic.php';

if(!session_start())
{
  session_start();
}

if(!isset($_GET['page'])){
   $start_search = 0;
 }
 else {
   $start_search = ($_GET['page']-1)*10;
 }

//if(($_GET['title'] == null or $_GET['title'] == "") && ($_GET['author'] == null or $_GET['author'] == "" ) && ($_GET['university'] == null or $_GET['university'] == "")){



//}


function truncate($str, $width) {
    return strtok(wordwrap($str, $width, "...\n"), "\n");
}

function highlight_search($search_word,$search_result){
if(strlen($search_word)>0){
  //echo "hello hi";
  $search_word = trim($search_word);
$search_words = explode(" ",$search_word);
foreach ($search_words as $word) {
  // code...

  $search_result = preg_replace("#".preg_quote($word)."#i", "<span style=\"background-color: #FFFF00\"><b>$0</b></span>", $search_result);

}//foreach ($search_words as $word) {
  //echo "$word";
//  echo "<span style=\"background-color: #FFFF00\"><b>".$word."</b></span>";
  //$search_result = str_ireplace($word,"<span style=\"background-color: #FFFF00\"><b>".$word."</b></span>",$search_result);
  // code...
//}
}

return $search_result;
}



if(isset($_GET['title']) or isset($_GET['author']) or isset($_GET['university'])){
$_GET['title'] = strip_tags($_GET['title']);
$_GET['author'] = strip_tags($_GET['author']);
$_GET['university'] = strip_tags($_GET['university']);
  //echo $_POST['title'];
  //echo $_POST['author'];
  //echo $_POST['university'];
  $q = $_GET['title']." ".$_GET['author']." ".$_GET['university'];

     $query = $client->search([
      'index'=> 'elasticweb',
      'from' => $start_search,
      'size' => 10,
    //  'type' => '_doc',
      'body' => [
         'query' => [
             'multi_match' => ['query' => $q,
                    'fields' => ['title', 'contributor_author','degree_grantor']]
             ]
           ]
       ]

      );
    //  $results = 0;

    $links = 5;
         $totoalPages = ceil($query['hits']['total']['value']/10);
$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
$prev = $page - 1;
  $next = $page + 1;
  $start = (($page - $links)>0)?$page - $links:1;
  $end = (($page + $links)<$totoalPages)?$page+$links:$totoalPages;

    if($query['hits']['total']['value'] >= 1){
                  $results = $query['hits']['hits'];
                  //echo count($results);
                  //echo $query['hits']['total']['value'];
               }
               if(strlen($_GET['title'])>0) {
                 $string_title = " title : <span style=\"color:blue\">".$_GET['title']."</span>";
               }
               else{
                 $string_title=" ";
               }
               if(strlen($_GET['author'])>0){
                 $string_author = " author : <span style=\"color:blue\">".$_GET['author']."</span>";
               }
               else{
                 $string_author=" ";
               }
               if(strlen($_GET['university'])>0){
                 $string_university = " university : <span style=\"color:blue\">".$_GET['university']."</span>";
               }
               else {
                 $string_university= " ";
               }

                $query_str = "title=".$_GET['title']."&author=".$_GET['author']."&university=".$_GET['university'];

               ?>
               <div class='count-results'>
                    <div id="inner1"> <h3><b>Total no. of returned items for keyword <?php echo $string_title.$string_author.$string_university." is ". $query['hits']['total']['value']; ?> </b></h3>
                    </div>

                    <div id="inner2">
  <nav aria-label="Page navigation example mt-5" >
      <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
              <a class="page-link"
                  href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev ."&".$query_str; } ?>">Previous</a>
          </li>
          <?php
              if($start>1){ ?>

                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="adv.php?page=1&<?=$query_str?>"> 1 </a>
                </li>
                <li class="disabled"><span>...</span></li>
            <?php  }
          ?>
          <?php for($i = $start; $i <= $end; $i++ ): ?>
          <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
              <a class="page-link" href="adv.php?page=<?= $i; ?>&<?=$query_str?>"> <?= $i; ?> </a>
          </li>
          <?php endfor; ?>

          <?php
            if($end < $totoalPages){ ?>
                <li class="disabled"><span>...</span></li>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="adv.php?page=<?= $totoalPages; ?>&<?=$query_str?>"> <?=$totoalPages;?> </a>
                </li>

          <?php  }
          ?>

          <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
              <a class="page-link"
                  href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next ."&".$query_str; } ?>">Next</a>
          </li>
      </ul>
  </nav>
  </div>

                   </div>
<?php
      if($query['hits']['total']['value']>0){
      echo "<div style='margin-top:6%;margin-left:20%;'>";
      foreach( $results as $source){
        $title = "";
        $contributor_author = "";
        $degree_grantor = "";
        $publisher = "";
        $identifier_sourceurl = "";
        $description_abstract = "";
        $handle = "";
        if(array_key_exists('title', $source['_source'])) $title = highlight_search($_GET['title'],$source['_source']['title']);
        if(array_key_exists('contributor_author', $source['_source'])) $contributor_author = highlight_search($_GET['author'],$source['_source']['contributor_author']);
        if(array_key_exists('degree_grantor', $source['_source'])) $degree_grantor = highlight_search($_GET['university'],$source['_source']['degree_grantor']);
        if(array_key_exists('publisher', $source['_source'])) $publisher = $source['_source']['publisher'];
        if(array_key_exists('identifier_sourceurl', $source['_source'])) $identifier_sourceurl = $source['_source']['identifier_sourceurl'];
        if(array_key_exists('description_abstract', $source['_source'])) $description_abstract = $source['_source']['description_abstract'];
        if(array_key_exists('handle', $source['_source'])) $handle = $source['_source']['handle'];

        echo "
       <div style='marigin: 0% auto; width: 70%' >
         <div style='border: 2px solid black; margin: 1%; border-radius: 10px; padding: 3px;'>
          <a href='summary.php?handleId=".$handle."'> <b><p style='font-size:20px;'>".$title."</p></b> </a>
           <i><p class='type'>".$contributor_author."</p></i>
           <i><p class='type'>".$degree_grantor."</p></i>
           <p>".$publisher."</p>
            <a href=".$identifier_sourceurl." target=\"_blank\">PDF details</a>
           <p> ".truncate($description_abstract,500)." </p>
           <form action=\"more_info.php\" method=\"POST\">
           <input type=\"hidden\" id=\"handleId\" name=\"handleId\" value=\"".$handle."\"/>
        <input type=\"submit\" value=\"more Info\" class=\"submitLink\"/>
      </form>
      <a href=\"download.php?download=".$handle."\">download</a>
         </div>
       </div>";

      }
      echo "</div>";

      }





}



 ?>
