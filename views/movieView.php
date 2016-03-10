<?php

$title = "Movies";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT title, release_date, release_country, runtime, content_rating, genre.genre_type FROM movie INNER JOIN movie_genre ON movie_genre.movie_id = movie.id INNER JOIN genre ON genre.id = movie_genre.genre_id ORDER BY title");

if (count($rows) > 0):
?>

<div id="movieTable" class="viewTable">
<table>
    <caption>Movies</caption>
    <thead>
        <td>ID</td>
        <td>Movie Title</td>
        <td>Release Date</td>
        <td>Runtime</td>
        <td>Content Rating</td>
        <td>Genre(s)</td>
    </thead>

<?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['release_date']?></td>
        <td><?=$row['release_country']?></td>
        <td><?=$row['runtime']?></td>
        <td><?=$row['content_rating']?></td>
        <td><?=$row['genre_type']?></td>
    </tr>
<?php endforeach; ?>

</table>
</div>

<?php

else:
    echo "0 results";

endif;

include 'footer.html';
?>
