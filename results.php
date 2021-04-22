<html>
    <head>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .checked {
          color: orange;
        }
        .unchecked{
          color: grey;
        }
        </style>
    </head>
    <body>
<?php

require_once 'initelastic.php';

if(!session_start())
{
  session_start();
}

if($_GET['search_query'] == null or $_GET['search_query'] == "" ){

   if(!isset($_SESSION['email'])){
  header("Location:index.php");
   }
   else {
     header("Location:home.php");
   }

 }
 if(!isset($_GET['page'])){
   $start_search = 0;
 }
 else {
   $start_search = ($_GET['page']-1)*10;
 }

$query_str = strip_tags($_GET['search_query']);

$params = [
  'index' => 'elasticweb',
  //'type' => '_doc',
  'from' => $start_search,
  'size' => 10,
  'body' => [
      'query' => [
        'query_string' =>[
          'query' => $query_str,
        ]
      ],
      "suggest" => [
    "mytermsuggester" => [
      "text" => $query_str,
      "term" => [
        "field" => "title"
      ]
    ]
  ]
  ]
];

$query = $client->search($params);

//print_r($query);

//print_r($query['suggest']['mytermsuggester'][0]['options'][0]['text']);

//print_r($query['suggest']['mytermsuggester'][0]['text']);
if(isset($query['suggest']['mytermsuggester'][0]['options'][0]['text'])){
$query_str = str_replace($query['suggest']['mytermsuggester'][0]['text'],$query['suggest']['mytermsuggester'][0]['options'][0]['text'],$query_str);

$params = [
  'index' => 'elasticweb',
  //'type' => '_doc',
  'from' => $start_search,
  'size' => 10,
  'body' => [
      'query' => [
        'query_string' =>[
          'query' => $query_str,
        ]
      ]
  ]
];

$query = $client->search($params);

}

if($query['hits']['total']['value'] >= 1){
            $results = $query['hits']['hits'];
            //echo count($results);
            //echo $query['hits'];
         }

$links = 5;
         $totoalPages = ceil($query['hits']['total']['value']/10);
$page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
$prev = $page - 1;
  $next = $page + 1;
  $start = (($page - $links)>0)?$page - $links:1;
  $end = (($page + $links)<$totoalPages)?$page+$links:$totoalPages;
 ?>

<div>
  <script>
  var recognition = new webkitSpeechRecognition();

  recognition.onresult = function(event) {
    var saidText = "";
    for (var i = event.resultIndex; i < event.results.length; i++) {
      if (event.results[i].isFinal) {
        saidText = event.results[i][0].transcript;
      } else {
        saidText += event.results[i][0].transcript;
      }
    }
    // Update Textbox value
    document.getElementById('speechText').value = saidText;

    // Search Posts
    searchPosts(saidText);
  }

  function startRecording(){
    recognition.start();
  }

  </script>
<form  action="results.php" method="GET" role="search">

<div class="form-box-results">
   <input type ="text" id="speechText" name="search_query" class="search-results" name="q" placeholder = "Search" id="transcript" /><i id='start' value='start'  class="fa fa-microphone fa-4x" onclick='startRecording();' style="color:blue;"></i>
   <button class ="search-btn" type="submit"> Search</button><a href="adv.php">advanced search</a><a href="ListFavourite.php">Favourites  </a>&nbsp;&nbsp;<form action="home.php" class ="search-btn"><input type="submit" value="home"></form><br>

</div >

<div class='count-results'>
<div id="inner1">  <h3><b>Total no. of returned items for keywords  <?php echo "<span style=\"color:blue\">".$query_str."</span>" ." is " . $query['hits']['total']['value']; ?> </b><br></h3></div>
  <div id="inner2">
  <nav aria-label="Page navigation example mt-5" >
      <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
              <a class="page-link"
                  href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev ."&search_query=".$query_str; } ?>">Previous</a>
          </li>
          <?php
              if($start>1){ ?>

                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="results.php?page=1&search_query=<?=$query_str?>"> 1 </a>
                </li>
                <li class="disabled"><span>...</span></li>
            <?php  }
          ?>
          <?php for($i = $start; $i <= $end; $i++ ): ?>
          <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
              <a class="page-link" href="results.php?page=<?= $i; ?>&search_query=<?=$query_str?>"> <?= $i; ?> </a>
          </li>
          <?php endfor; ?>

          <?php
            if($end < $totoalPages){ ?>
                <li class="disabled"><span>...</span></li>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="results.php?page=<?= $totoalPages; ?>&search_query=<?=$query_str?>"> <?=$totoalPages;?> </a>
                </li>

          <?php  }
          ?>

          <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
              <a class="page-link"
                  href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next ."&search_query=".$query_str; } ?>">Next</a>
          </li>
      </ul>
  </nav>
  </div>

</div>

</form>

<?php

//for ($i=0; $i<count($results); $i++) {
//print_r($results[$i][]);
//  echo "<tr><td>".$results[$i][0]['title']."</td><td>".$results[$i][0]['description_abstract']."</td></tr>";

//}

require_once('dbConnection.php');
global $dbc;
function truncate($str, $width) {
    return strtok(wordwrap($str, $width, "...\n"), "\n");
}

function highlight_search($search_word,$search_result){

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
return $search_result;
}


//echo $no_of_pages;
if($query['hits']['total']['value']>0){
echo "<div style='margin-top:9%;'>";
foreach( $results as $source){
  $title = "";
  $contributor_author = "";
  $degree_grantor = "";
  $publisher = "";
  $identifier_sourceurl = "";
  $description_abstract = "";
  $handle = "";
  if(array_key_exists('title', $source['_source'])) $title = highlight_search($query_str,$source['_source']['title']);
  if(array_key_exists('contributor_author', $source['_source'])) $contributor_author = highlight_search($query_str,$source['_source']['contributor_author']);
  if(array_key_exists('degree_grantor', $source['_source'])) $degree_grantor = highlight_search($query_str,$source['_source']['degree_grantor']);
  if(array_key_exists('publisher', $source['_source'])) $publisher = highlight_search($query_str,$source['_source']['publisher']);
  if(array_key_exists('identifier_sourceurl', $source['_source'])) $identifier_sourceurl = highlight_search($query_str,$source['_source']['identifier_sourceurl']);
  if(array_key_exists('description_abstract', $source['_source'])) $description_abstract = highlight_search($query_str,$source['_source']['description_abstract']);
  if(array_key_exists('handle', $source['_source'])) $handle = highlight_search($query_str,$source['_source']['handle']);

  echo "
 <div style='margin:0 auto; width: 70%; position:relative;'>
   <div style='border: 2px solid black; margin: 1%; border-radius: 10px; padding: 3px;'>";


   if(isset($_SESSION['email'])){
     //header("Location:index.php");
$email = $_SESSION['email'];
        $select_query = "select * from favourites where email='$email' and handleId='$handle'";
        $run_select = mysqli_query($dbc,$select_query);
        $affected_rows = mysqli_num_rows($run_select);
if($affected_rows>0){
         echo "<span class='fa fa-star fa-2x testing checked' style='float:right;' name='".$handle."' value='".$handle."'></span>";
       }
       else{
          echo "<span class='fa fa-star fa-2x testing unchecked' style='float:right;' name='".$handle."' value='".$handle."'></span>";

       }

   }
   echo "
    <a href='summary.php?handleId=".$handle."'> <b><p style='font-size:20px;'>".$title."</p></b></a>
    ";

    echo "
     <i><p class='type'>".$contributor_author."</p></i>
     <i><p class='type'>".$degree_grantor."</p></i>
     <p>".$publisher."</p>
      <a href=".$identifier_sourceurl." target=\"_blank\">PDF details</a>
     <p> ".truncate($description_abstract,500)." </p>
     <form action=\"more_info.php\" method=\"GET\">
     <input type=\"hidden\" id=\"handleId\" name=\"handleId\" value=\"".$handle."\"/>
  <input type=\"submit\" class=\"submitLink\" value=\"more Info\" />
</form>

<a href=\"download.php?download=".$handle."\">download</a>

   </div>
 </div>";

}
echo "</div>";
}


?>

<script>
$(document).ready(function(){
  $(".testing").click(function(){
    $(this).toggleClass('unchecked');
    $(this).toggleClass('checked');
    var handleId = $(this).attr("name");
    $.ajax({
       url:'favourite.php',
       type:'post',
       dataType: "text",
       data:{handleId:handleId},
       success:function(response){
         console.log(response);
        //  location.reload(); // reloading page
       }, error: function (request, error) {
        console.log(arguments);
      //  alert(" Can't do because: " + error);
    }
    });

  });
});

</script>
</div>
 </body>
</html>
