<?php

  $title = "Add Person";
  include '../classes/MovieActorDBO.php';

  // turn on errors
  ini_set('display_errors', 'On');


  $DBO = new MovieActorDB();

  $DBO->query("INSERT INTO person(first_name, last_name, birthdate) VALUES ('".$_GET['first_name']."', '".$_GET['last_name']."', '".$_GET['birthday']."')");
  $role = $_GET['role'];

  if (strcmp($role, "actor") == 0) {
    $DBO->query("INSERT INTO actor(person_id) VALUES ((SELECT id FROM person WHERE (first_name = '".$_GET['first_name']."' AND last_name = '".$_GET['last_name']."')))");

    if (strcmp($_GET['media'], "")){ 
     echo $_GET['media'];
      $DBO->query("INSERT INTO media_actor(media_id, actor_id) VALUES
        (".$_GET['media'].", 
        (SELECT actor.id FROM actor 
          INNER JOIN person ON actor.person_id = person.id 
          WHERE (person.first_name = '".$_GET['first_name']."' AND person.last_name = '".$_GET['last_name']."')))");
    }
  }  
  else {
    $DBO->query("INSERT INTO director(person_id) VALUES ((SELECT id FROM person WHERE (first_name = '".$_GET['first_name']."' AND last_name = '".$_GET['last_name']."')))");
    if (strcmp($_GET['media'], "")){ 
     echo $_GET['media'];
      $DBO->query("INSERT INTO media_director(media_id, director_id) VALUES
        (".$_GET['media'].", 
        (SELECT director.id FROM director 
          INNER JOIN person ON director.person_id = person.id 
          WHERE (person.first_name = '".$_GET['first_name']."' AND person.last_name = '".$_GET['last_name']."')))");
    }
  }

?>
