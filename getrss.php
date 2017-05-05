<?php
//getting the q parameter
$q=$_GET["q"];

//which feed is selected
if($q=="worldNews"){
	$xml = ("http://www.hngn.com/rss/sections/world.xml");
}elseif($q=="News"){
	$xml = ("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
}elseif($q=="Sports"){
	$xml = ("http://www.espn.com/espn/rss/news");
}elseif($q=="Weather"){
	$xml = ("http://www.rssweather.com/zipcode/14609/rss.php");
}elseif($q=="Tech"){
	$xml = ("https://www.cnet.com/rss/news/");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get information from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
	->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
	->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
	->item(0)->childNodes->item(0)->nodeValue;

//output information from "<channel>"
echo("<p><a href='" . $channel_link 
		 . "'>" . $channel_title . "</a><br>");
echo($channel_desc . "</p>");

//get and output "<item>" information
$x=$xmlDoc->getElementsByTagName('item');
foreach ($x as $i){
	$item_title=$i->getElementsByTagName('title')
		->item(0)->childNodes->item(0)->nodeValue;
	$item_link=$i->getElementsByTagName('link')
		->item(0)->childNodes->item(0)->nodeValue;
	$item_desc=$i->getElementsByTagName('description')
		->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p><a href='" . $item_link
				. "'>" . $item_title . "</a><br>");
  echo ($item_desc . "</p>");
}
?>