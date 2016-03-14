<?php

  $title = "Add Genre";
  include '../classes/MovieActorDBO.php';

  // turn on errors
  ini_set('display_errors', 'On');


  $DBO = new MovieActorDB();

  $result = $DBO->query("INSERT INTO genre (genre_type) VALUES ('".$_GET['genre']."')");

?>
