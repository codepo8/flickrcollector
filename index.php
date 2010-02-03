<?php include('filter.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
  <title>Flickr collector</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
  <link rel="stylesheet" href="flickrcollector.css" type="text/css">
</head>
<body>
  <div id="doc3" class="yui-t7">
  <div id="hd" role="banner"><h1>Flickr <span>collector</span></h1></div>
  <div id="bd" role="main">
  <div class="yui-g copy">
    <div id="intro">
      <p>Flickr collector is a simple interface to collect photos from flickr and copy and paste the HTML to embed them into web sites. Click any of the photos below to see its details. Below the photo you will get the HTML code to copy and paste.</p>
    </div>
      <form action="index.php" method="get" id="mainform">
        <div>
          <label for="what">What do you want to find?</label>
          <input type="text" id="what" name="what" value="<?php echo $what;?>">
          <input type="submit" value="Find it">
        </div>
        <!-- <div>
          <label for="what">Where do you want to find it? (optional)</label>
          <input type="text" id="where" name="where">
        </div> -->
    </form>
  </div>
  <div class="yui-g">
    <div id="map"></div>
  </div>
  <div class="yui-g" id="content">
  <div class="yui-u first">
    <div id="thumbs"><?php include('thumbs.php');?></div>
  </div>
  <div class="yui-u">
    <div id="preview"><?php include('fullview.php');?></div>
  </div>
  </div>
  <div class="yui-g" id="collect"></div>
  <div class="yui-gb copy">
  <div class="yui-u first"><p></p></div>
  <div class="yui-u"><p></p></div>
  <div class="yui-u"><p></p></div>
  </div>
</div>
<div id="ft" role="contentinfo"><p>Written by <a href="http://wait-till-i.com">Chris Heilmann</a>, using <a href="http://developer.yahoo.com/yql">YQL</a> and <a href="http://yuilibrary.com">YUI3</a></p></div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/3.0.0/build/yui/yui-min.js"></script>
<script type="text/javascript" src="flickrcollector.js"></script>
</body>
</html>
