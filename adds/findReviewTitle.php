<!DOCTYPE html>
<html lang="en">
<?php

$title = "Find Review Title";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$title = str_replace("+", " ", $_GET['review_title']);

$rows = $DBO->query("SELECT mov_tv.title, mov_tv.release_country, media.id FROM media
INNER JOIN (SELECT title, media_id, release_country FROM (
  (SELECT title, media_id, release_country FROM movie)
  UNION ALL
  (SELECT title, media_id, release_country from tvshow)
 ) mov_tv
) mov_tv ON mov_tv.media_id = media.id
WHERE title = '".$title."'");


if (count($rows) > 0):

?>
<body>
<?php include '../includes/navigation.php'; ?>
<div class="container theme-showcase" role="main">
  <div id="blockContent" class="page-header">
    <table id="findReviewTable" class="table table-bordered">
      <thead>
        <td>Title</td>
        <td>Release Country</td>
        <td>Leave Review</td>
      </thead>

  <?php foreach($rows as $row): ?>
      <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['release_country']?></td>
        <td>
          <form method="get" id="review" action="writeReview.php">
            <fieldset>
              <input type="hidden" name="titleId" id ="titleId" value="<?=$row['id']?>">
              <input type="submit" id="review" value="Review">
            </fieldset>
          </form>
        </td>
      </tr>
  <?php endforeach; ?>

    </table>
  </div>
</div>

<?php

else:
    echo "0 results";

endif;
?>

</body>
</html>
