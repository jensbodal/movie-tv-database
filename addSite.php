<?php

$title = "Add Site";
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');


$DBO = new MovieActorDB();

$result = $DBO->query("INSERT INTO site (name, site_url, max_rating) VALUES ('".$_GET['site_name']."', '".$_GET['url']."', '".$_GET['max']."')");


if (!$result) {
  die('Could not query:' . mysql_error());
}

echo mysql_result($result, 2);

?>