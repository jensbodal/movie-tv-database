<?php

include '../../classes/MovieActorDBO.php';
header('Content-type: application/json');
$response = [];

if (isset($_POST['id']) && isset($_POST['type'])) {
  $id = $_POST['id'];
  $type = $_POST['type'];
  $pattern = '/(.*)Item/';
  preg_match($pattern, $type, $matches);
  $type = $matches[1];
}
else {
  $response['status'] = 'error';
}

$DBO = new MovieActorDB();

$query = '
  DELETE '.$type.'_genre.*, media_actor.*, media_director.*, rating.* FROM '.$type.'_genre
      LEFT JOIN '.$type.' ON '.$type.'.id = '.$type.'_genre.'.$type.'_id
      INNER JOIN media ON media.id = '.$type.'.media_id
      LEFT JOIN media_actor ON media_actor.media_id = media.id
      LEFT JOIN media_director ON media_director.media_id = media.id
      LEFT JOIN rating ON rating.media_id = media.id
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$query = '
  DELETE '.$type.'.*, media.* FROM '.$type.'
      INNER JOIN media ON media.id = '.$type.'.media_id
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$response['status'] = 'success';

echo json_encode($response);

?>
