<?php

$title = "Add Episode";
include '../classes/MovieActorDBO.php';

$DBO = new MovieActorDB();

$title = str_replace("+", " ", $_GET['title']);

$result = $DBO->queryJSON("SELECT episode_title, episode_number, season FROM tvshow_episode 
   WHERE tvshow_id = (SELECT id FROM tvshow WHERE title = '".$_GET['tvshow']."') AND
         episode_number = ".$_GET['number']." AND
         season = ".$_GET['season']."");
$array = json_decode($result);
if(count($array) > 0):
 echo $result;

else:
  $insert = $DBO->queryJSON("INSERT INTO tvshow_episode (tvshow_id, airdate, episode_title, runtime, episode_number, season) VALUES
     ((SELECT id FROM tvshow WHERE title = '".$_GET['tvshow']."'), 
     '".$_GET['date']."', '".$title."', ".$_GET['runtime'].", ".$_GET['number'].", ".$_GET['season'].")");
endif;
?>