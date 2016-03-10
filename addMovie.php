<?php

$title = "Add Movie";
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$DBO->query("START TRANSACTION");
$DBO->query("INSERT INTO media (id) VALUES (null)");
$DBO->query("INSERT INTO movie (title, media_id, release_date, release_country, runtime, content_rating)  
	VALUES ('".$_GET['title']."', LAST_INSERT_ID(), '".$_GET['release_date']."', '".$_GET['country']."', '".$_GET['run_time']."', '".$_GET['rating']."')");
$DBO->query("COMMIT");

$result = $DBO->query(
"INSERT INTO movie_genre (movie_id, genre_id) VALUES	
	((SELECT @mId := id FROM movie WHERE title = '".$_GET['title']."'),(SELECT id FROM genre WHERE genre_type = '".$_GET['genre']."'));"
);

if (!$result) {
  die('Could not query:' . mysql_error());
}

echo mysql_result($result, 2);

?>