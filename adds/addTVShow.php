<?php

  $title = "Add TV Show";
  include '../classes/MovieActorDBO.php';

  $DBO = new MovieActorDB();

  $DBO->query("START TRANSACTION");
  $DBO->query("INSERT INTO media (id) VALUES (null)");

  if (!strcmp($_GET['end_year'], "")){
    $DBO->query("INSERT INTO tvshow (title, media_id, start_year, release_country, content_rating)
      VALUES ('".$_GET['title']."', LAST_INSERT_ID(), ".$_GET['start_year'].", '".$_GET['country']."', '".$_GET['rating']."')");
  }
  else {
    $DBO->query("INSERT INTO tvshow (title, media_id, start_year, end_year, release_country, content_rating)
      VALUES ('".$_GET['title']."', LAST_INSERT_ID(), ".$_GET['start_year'].", ".$_GET['end_year'].", '".$_GET['country']."', '".$_GET['rating']."')");
  } 
  $DBO->query("COMMIT");

  $result = $DBO->query(
  "INSERT INTO tvshow_genre (tvshow_id, genre_id) VALUES	
    ((SELECT @tId := id FROM tvshow WHERE title = '".$_GET['title']."'),(SELECT id FROM genre WHERE genre_type = '".$_GET['genre']."'));"
  );

?>
