<?php
  if(!$filtered){include('filter.php');}
  if($what !== null || $woeid !== null){
    $query = 'select * from flickr.photos.search('.             
              $start . ',' . $amount. ') where ';
    if($woeid!==null){
      $query .= 'woe_id = '.$woeid. ' and ';
    }
    $query .= ' text="' .$what . '"';
    $api = 'http://query.yahooapis.com/v1/public/yql?q='.
            urlencode($query).'&format=json';
            
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $api); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);
    $data = json_decode($output);
    $photos = $data->query->results->photo;
    if(sizeof($photos)>0){
      echo '<ul>';
      foreach($photos as $p){
        echo '<li><a href="'.$cururl.'&id='.$p->id.
             '"><img src="http://static.flickr.com/'.$p->server.
             '/'.$p->id.'_'.$p->secret.'_s.jpg" '.
             'width="75px" height="75px" alt="'.
             $p->title.' by '.$p->owner->realname.'"></a><p>'.
             $p->description.'</p></li>';
      }
      echo '</ul>';
      echo '<p><a class="more" href="'.$cururl.'&start='.($start+20).'">More</a></p>';
    }
  }
?>
