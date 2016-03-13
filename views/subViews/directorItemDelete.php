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
  DELETE media_'.$type.'.* 
  FROM '.$type.'
      LEFT JOIN media_'.$type.' ON media_'.$type.'.'.$type.'_id = '.$type.'.id
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$query = '
  DELETE '.$type.'.* FROM '.$type.'
      WHERE '.$type.'.id ='.$id;

$result = $DBO->query($query);

$response['status'] = 'success';

echo json_encode($response);

?>
