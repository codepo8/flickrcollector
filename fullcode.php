<?php
  if(!$filtered){include('filter.php');}
  echo '<h2>Your photos as HTML code:</h2>';
  if($ids !== null){
    if(strpos($ids,',')){
      $query = 'select * from flickr.photos.info where '.
               'photo_id in ('.$ids.')';
    } else {
      $query = 'select * from flickr.photos.info where '.
               'photo_id ='.$ids;
    }
    $api = 'http://query.yahooapis.com/v1/public/yql?q='.
            urlencode($query).'&format=json';
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $api); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
    $data = json_decode($output);
    echo '<textarea class="full">';
    if(sizeof($data->query->results->photo)>1){
      foreach($data->query->results->photo as $p){
        addphoto($p);
      }
    } else {
      $p = $data->query->results->photo;
      addphoto($p);
    }
    echo '</textarea>';
  }
  function addphoto($p){
    $img = "<p>\n<a href=\"".$p->urls->url->content.
           "\">\n<img src=\"http://static.flickr.com/".$p->server.
           "/".$p->id."_".$p->secret.".jpg\" \nalt=\"".
           $p->title." by ".$p->owner->realname."\">\n</a>\n</p>\n";
    $extras = "<!-- \n  by http://www.flickr.com/people/".$p->owner->username.
              "\n (".$p->owner->realname.
              ")\n  License: " .$licenses[$p->license]['name']."\n-->\n\n";
    echo htmlentities($img.$extras);
  }
?>