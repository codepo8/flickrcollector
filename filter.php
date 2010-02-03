<?php
$filtered = true;
$woeid = null;
$what = 'kittens';
$where = null;
$start = 0;
$amount = 20;
$id = null;
$ids = '';
if(isset($_GET['start'])){
 $start = intval($_GET['start']);
}
if(isset($_GET['id'])){
  if(preg_match('/\d+/',$_GET['id'])){
    $id = $_GET['id'];
  }
}
if(isset($_GET['what'])){
 $what = filter_var($_GET['what'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['ids'])){
 $tmp = $_GET['ids'];
 if(preg_match('/[0-9]+,?/',$tmp)){
   $ids = $tmp;
 }
}
$cururl = 'index.php?what='.$what.'&start='.$start.'&amount='.$amount;
$licenses = array(
  '0' => array(
    'name'=>'All rights reserved',
    'url'=>'http://flickr.com'),
  '1' => array(
      'name'=>'Attribution-NonCommercial-ShareAlike License',
      'url'=>'http://creativecommons.org/licenses/by-nc-sa/2.0/'
    ),
  '2' => array(
      'name'=>'Attribution-NonCommercial License',
      'url'=>'http://creativecommons.org/licenses/by-nc/2.0/'
    ),
  '3' => array(
      'name'=>'Attribution-NonCommercial-NoDerivs License',
      'url'=>'http://creativecommons.org/licenses/by-nc-nd/2.0/'
    ),
  '4' => array(
      'name'=>'Attribution License',
      'url'=>'http://creativecommons.org/licenses/by/2.0/'
    ),
  '5' => array(
      'name'=>'Attribution-ShareAlike License',
      'url'=>'http://creativecommons.org/licenses/by-sa/2.0/'
    ),
  '6' => array(
      'name'=>'Attribution-NoDerivs License',
      'url'=>'http://creativecommons.org/licenses/by-nd/2.0/'
    ),
  '7' => array(
      'name'=>'No known copyright restrictions',
      'url'=>'http://flickr.com/commons/usage/'
    ),
);

?>