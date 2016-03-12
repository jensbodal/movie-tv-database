<?php

include '../../classes/MovieActorDBO.php';
$isGET = FALSE;
if (isset($_GET['id'])) {
  $isGET = TRUE;
  include '../../includes/header.php';
  $movie_id = $_GET['id'];
}
else {
  $movie_id = $_POST['id'];
}
// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$ourQuery = "
    SELECT movie.title AS t, person.first_name AS fn, person.last_name AS ln FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        
        WHERE movie.id=".$movie_id." ORDER BY title
    ";

$rows = $DBO->query($ourQuery);
$testjson = $DBO->queryJSON($ourQuery);
if ($isGET) {
  echo "<body>";
  print $testjson;
  include '../../includes/navigation.php';
  echo '<div class="container theme-showcase" role="main">';
  echo '<div id="blockContent" class="page-header">';
}

if (count($rows) > 0):
?>
<table id="movieTable" class="table table-bordered">
  <caption id='tableCaption'>Movies</caption>
  <thead>
    <td>Movie Title</td>
    <td>Actor First Name</td>
    <td>Actor Last Name</td>
  </thead>

<?php foreach($rows as $row): ?>
  <tr>
    <td><?=$row['t']?></td>
    <td><?=$row['fn']?></td>
    <td><?=$row['ln']?></td>
  </tr>
<?php endforeach; ?>

</table>
<button id="reloadMovies" class="btn btn-primary">BACK</button>

<?php

else:
  echo "0 results";

endif;

if ($isGET) {
  echo "</div>";
  echo "</div>";
  echo "</body>";
}

?>



<script>
$('#reloadMovies').on('click', function(event) {
    location.reload();
});
</script>
