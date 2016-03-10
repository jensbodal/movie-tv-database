<?php

$title = "Find Review Title";
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

// $result = $DBO->query("SELECT mov_tv.title, mov_tv.release_country, media.id FROM media
// INNER JOIN (SELECT title, media_id, release_country FROM (
  // (SELECT title, media_id, release_country FROM movie)
  // UNION ALL
  // (SELECT title, media_id, release_country from tvshow)
 // ) mov_tv
// ) mov_tv ON mov_tv.media_id = media.id
// WHERE title = '".$_GET['review_title']."'");

$rows = $DBO->query("SELECT mov_tv.title, mov_tv.release_country, media.id FROM media
INNER JOIN (SELECT title, media_id, release_country FROM (
  (SELECT title, media_id, release_country FROM movie)
  UNION ALL
  (SELECT title, media_id, release_country from tvshow)
 ) mov_tv
) mov_tv ON mov_tv.media_id = media.id
WHERE title = 'test'");

if (count($rows) > 0):

?>

<table>
    <thead>
        <td>ID</td>
        <td>Title</td>
        <td>Release Country</td>
    </thead>

<?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['title']?></td>
        <td><?=$row['release_country']?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php

else:
    echo "0 results";

endif;

?>