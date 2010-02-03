<?php
if(!$filtered){include('filter.php');}
if($where !== null){
  $url = 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20'.
         'from%20geo.placemaker%20where%20documentContent%20%3D%20%22'.
          urlencode($where).'%22%20and%20documentType%3D'.
         '%22text%2Fplain%22%20and%20appid%20%3D%20%22%22&'.
         'format=json&env=store%3A%2F%2Fdatatables.org%2F'.
         'alltableswithkeys';
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  $data = json_decode($output);
  echo '<pre>';
  $results = $data->query->results->matches;
  if($results->match){
    print_r($data->query->results->matches->match->place->woeId);
    print_r($data->query->results->matches->match->place->name);
    print_r($data->query->results->matches->match->place->centroid->latitude);
  print_r($data->query->results->matches->match->place->centroid->longitude);
  }
  echo'</pre>';
  $woeid = $data->query->results->matches->match->place->woeId;
}
?>
            