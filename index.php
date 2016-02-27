<?php

$title = "Main page";
include 'includes/header.php';

// turn on errors
ini_set('display_errors', 'On');

include 'classes/MovieActorDBO.php';
$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT title, release_date, release_country, runtime, content_rating FROM movie ORDER BY title");

if (count($rows) > 0):
?>
<head>
    <title>ASDF</title>
</head>
<table>
    <thead>
        <td>ID</td>
        <td>Movie Title</td>
        <td>Release Date</td>
        <td>Runtime</td>
        <td>Content Rating</td>
    </thead>

<?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['release_date']?></td>
        <td><?=$row['release_country']?></td>
        <td><?=$row['runtime']?></td>
        <td><?=$row['content_rating']?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php

else:
    echo "0 results";

endif;

?>
