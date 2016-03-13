<!DOCTYPE html>
<html lang="en">
<?php

  session_start();
  $title = "Write Title";
  include '../includes/header.php';
  include '../classes/MovieActorDBO.php';

  // turn on errors
  ini_set('display_errors', 'On');

  $DBO = new MovieActorDB();
  
  $_SESSION['review_title'] = $_GET['review_title'];

  $title = str_replace("+", " ", $_SESSION['review_title']);

  $rows = $DBO->query("SELECT mov_tv.title, mov_tv.release_country, media.id FROM media
  INNER JOIN (SELECT title, media_id, release_country FROM (
    (SELECT title, media_id, release_country FROM movie)
    UNION ALL
    (SELECT title, media_id, release_country from tvshow)
   ) mov_tv
  ) mov_tv ON mov_tv.media_id = media.id
  WHERE title = '".$title."'");

  $ratings_siteJSON = $DBO->queryJSON("SELECT id, name, max_rating FROM site");

  if (count($rows) > 0):
?>

<body>
<?php include '../includes/navigation.php'; ?>
<div class="container theme-showcase" role="main">
  <div id="blockContent" class="page-header">
    <table id="findReviewTable" class="table table-bordered">
      <thead>
        <td></td>
        <td>Title</td>
        <td>Release Country</td>
      </thead>

  <?php foreach($rows as $row): ?>
      <tr>
        <td><input type="radio" name="media_id" id="media_id" value="<?=$row['id']?>"/></td>
        <td id="media_title"><?=$row['title']?></td>
        <td><?=$row['release_country']?></td>
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
<div class="container theme-showcase" role="main">
  <div id="blockContent" class="page-header">
    <form>
      <fieldset>
        <legend>Review</legend>
        <label for="site_list">Rating Site Name:</label>
        <select name="site_list" id="site_list"></select>
        <label for="rating">Rating:</label>
        <input type="number" step="0.1" name="rating" id="rating">
        <label for="max">out of</label>
        <div id="max" style="display: inline"></div>
        <label for="url">URL:</label>
        <input type="text" name="url" id="url">
        <input type="button" id="addRating" value="Submit Review">
      </fieldset>
    </form>
    <p id="result"></p>
  </div>
</div>

  <script src="addReview.js"></script>
  <script>
    // export PHP vars
    var sites = <?= $ratings_siteJSON ?>;
  </script>
  <script src='handlers/reviewHandler.js' type='text/javascript'></script>
</body>
</html>
