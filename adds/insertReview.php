<?php

$title = "New Review";
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();


$result = $DBO->query("INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
	(".$_GET['media_id'].", 
  (SELECT site.id FROM site WHERE (site.name = '".$_GET['site_name']."')),
  ".$_GET['rating'].", '".$_GET['url']."')");


if (!$result) {
  die('Could not query:' . mysql_error());
}

echo mysql_result($result, 2);

?>

