<!DOCTYPE html>
<html lang='en'>
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

<body>
    <?php include '../includes/navigation.php' ?>;
    <div class="container theme-showcase" role="main">
      <div id="blockContent" class="page-header">
        <table id="mainTable" class="table table-bordered">
          <caption id="tableCaption">TV Shows</caption>
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
              <td><?php $endYear=$row['end_year']; if($endYear == '') echo '∞'; else echo $endYear; ?></td>
              <td><?=$row['release_country']?></td>
              <td><?=$row['content_rating']?></td>
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
  <script src='handlers/tableHandler.js' type='text/javascript'></script>

</body>
</html>
