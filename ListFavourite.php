

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

      <center><h3> My Favourite List</h3></center>
<?php
    require_once 'initelastic.php';

    if(!session_start())
    {
      session_start();
    }
    require_once('dbConnection.php');
    global $dbc;

    $email = $_SESSION['email'];

    function truncate($str, $width) {
        return strtok(wordwrap($str, $width, "...\n"), "\n");
    }

    $select_query = "select * from favourites where email='$email'";
      $run_select = mysqli_query($dbc,$select_query);
while($row = mysqli_fetch_array($run_select)){
//  printf("email: %s Name: %s",$row[0],$row[1]);

    $params = [
      'index' => 'elasticweb',
      //'type' => '_doc',

      'body' => [
          'query' => [
            'match' => [
               'handle' => $row[1]
            ]
          ]

      ]
    ];

    $query = $client->search($params);

    if($query['hits']['total']['value'] >= 1){
                $results = $query['hits']['hits'];
                //echo count($results);
                //echo $query['hits'];
             }

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
               if(array_key_exists('title', $source['_source'])) $title = $source['_source']['title'];
               if(array_key_exists('contributor_author', $source['_source'])) $contributor_author = $source['_source']['contributor_author'];
               if(array_key_exists('degree_grantor', $source['_source'])) $degree_grantor = $source['_source']['degree_grantor'];
               if(array_key_exists('publisher', $source['_source'])) $publisher = $source['_source']['publisher'];
               if(array_key_exists('identifier_sourceurl', $source['_source'])) $identifier_sourceurl = $source['_source']['identifier_sourceurl'];
               if(array_key_exists('description_abstract', $source['_source'])) $description_abstract = $source['_source']['description_abstract'];
               if(array_key_exists('handle', $source['_source'])) $handle = $source['_source']['handle'];
               if(array_key_exists('date_sdate', $source['_source'])) $date_sdate = $source['_source']['date_sdate'];

               echo "
              <div style='margin:0 auto; width: 70%; position:relative;'>
                <div style='border: 2px solid black; margin: 1%; border-radius: 10px; padding: 3px;'>";


                if(isset($_SESSION['email'])){
                  //header("Location:index.php");
                      echo "<span class='fa fa-trash-o fa-3x testing' style='float:right;color:red' name='".$handle."' value='".$handle."'></span>";

                }
                echo "
                <b><i><p class='type'>".$handle."</p></i></b>
                 <a href='summary.php?handleId=".$handle."'> <b><p style='font-size:20px;'>".$title."</p></b></a>
                 ";

                 echo "

                  <i><p class='type'>".$contributor_author."</p></i>
                  <i><p class='type'>Year: ".date('Y', strtotime($date_sdate))."</p></i>
                  <i><p class='type'>".$degree_grantor."</p></i>
                  <p>".$publisher."</p>
                   <a href=".$identifier_sourceurl." target=\"_blank\">PDF details</a>
                  <p> ".truncate($description_abstract,500)." </p>
                  <form action=\"more_info.php\" method=\"GET\">
                  <input type=\"hidden\" id=\"handleId\" name=\"handleId\" value=\"".$handle."\"/>
               <input type=\"submit\" class=\"submitLink\" value=\"more Info\" />
             </form>
                </div>
              </div>";

             }
             echo "</div>";
             }


}
?>

<script>
$(document).ready(function(){
  $(".testing").click(function(){
  //  $(this).toggleClass('unchecked');
  //  $(this).toggleClass('checked');
    var handleId = $(this).attr("name");
    $.ajax({
       url:'favourite.php',
       type:'post',
       dataType: "text",
       data:{handleId:handleId},
       success:function(response){
         console.log(response);
          location.reload(); // reloading page
       }, error: function (request, error) {
        console.log(arguments);
      //  alert(" Can't do because: " + error);
    }
    });

  });
});

</script>

    </body>
    </html>
