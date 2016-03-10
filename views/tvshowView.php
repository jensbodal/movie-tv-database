<?php

$title = "TV Shows";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT title, start_year, end_year, release_country, content_rating FROM tvshow ORDER BY title");

if (count($rows) > 0):
?>

<div id="movieTable" class="viewTable">
<table>
    <caption>TV Shows</caption>
    <thead>
        <td>TV Show Title</td>
        <td>Start Year</td>
        <td>End Year</td>
        <td>Release Country</td>
        <td>Content Rating</td>
    </thead>

<?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['start_year']?></td>
        <td><?=$row['end_year']?></td>
        <td><?=$row['release_country']?></td>
        <td><?=$row['content_rating']?></td>
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
