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
  DELETE media_actor.*, media_director.* FROM '.$type.'
      LEFT JOIN actor ON actor.person_id = '.$type.'.id
      LEFT JOIN director ON director.person_id = '.$type.'.id
      LEFT JOIN media_actor ON media_actor.actor_id = actor.id
      LEFT JOIN media_director ON media_director.director_id = director.id
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$query = '
  DELETE actor.*, director.* FROM '.$type.'
      LEFT JOIN actor ON actor.person_id = '.$type.'.id
      LEFT JOIN director ON director.person_id = '.$type.'.id
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$query = '
  DELETE '.$type.'.* FROM '.$type.'
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$response['status'] = 'success';

echo json_encode($response);

?>
