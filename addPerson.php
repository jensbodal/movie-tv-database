<?php

$title = "Add Person";
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');


$DBO = new MovieActorDB();

$DBO->query("INSERT INTO person(first_name, last_name, birthdate) VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['birthday']."')");
$role = $_GET['role'];

// THIS DOESN'T WORK
if (strcmp($role, "actor") == 0) {
  $DBO->query("INSERT INTO actor(person_id) VALUES ((SELECT id FROM person WHERE (first_name = '".$_GET['first_name']."' AND last_name = '".$_GET['last_name']."')))");
}
else {
  $DBO->query("INSERT INTO director(person_id) VALUES ((SELECT id FROM person WHERE (first_name = '".$_GET['first_name']."' AND last_name = '".$_GET['last_name']."')))");
}  

if (!$result) {
  die('Could not query:' . mysql_error());
}

echo mysql_result($result, 2);

?>