<?php

  $title = "Insert Review";
    include '../classes/MovieActorDBO.php';

  $DBO = new MovieActorDB();

  $result = $DBO->query("INSERT INTO rating (media_id, site_id, rating, rating_url) VALUES
    (".$_GET['media_id'].", 
    (SELECT site.id FROM site WHERE (site.name = '".$_GET['site_name']."')),
    ".$_GET['rating'].", '".$_GET['url']."')");


?>

