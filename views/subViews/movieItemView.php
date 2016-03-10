<?php

include '../../classes/MovieActorDBO.php';
$movie_id = $_POST['id'];
// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("
    SELECT movie.title AS t, person.first_name AS fn, person.last_name AS ln FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        
        WHERE movie.id=".$movie_id." ORDER BY title
    ");

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
?>

<script>
$('#reloadMovies').on('click', function(event) {
    location.reload();
});
</script>
