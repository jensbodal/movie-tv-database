<?php

$title = "Get Site Max";
  include '../includes/header.php';
  include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$site = str_replace("+", " ", $_GET['site_name']);

$results = $DBO->queryJSON("SELECT max_rating FROM site WHERE site.name = '".$site."'");

echo $results;

?>
