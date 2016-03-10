<!DOCTYPE html>
<html lang='en'>
<?php

$title = "Movies";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("
    SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
        INNER JOIN movie_genre ON movie_genre.movie_id = movie.id 
        INNER JOIN genre ON genre.id = movie_genre.genre_id 
        GROUP BY title
        ORDER BY title");

if (count($rows) > 0):
?>
<body>
  <?php include '../includes/navigation.php' ?>;
  <div class="container theme-showcase" role="main">
      <div id="blockContent" class="page-header">
          <table id="mainTable" class="table table-bordered">
              <caption id="tableCaption">Movies</caption>
              <thead>
                  <td>Movie Title</td>
                  <td>Release Date</td>
                  <td>Release Country</td>
                  <td>Runtime</td>
                  <td>Content Rating</td>
                  <td>Genre(s)</td>
              </thead>

          <?php foreach($rows as $row): ?>
              <tr id='movieItem-<?=$row['movie_id']?>'>
                  <td><?=$row['title']?></td>
                  <td><?=$row['release_date']?></td>
                  <td><?=$row['release_country']?></td>
                  <td><?=$row['runtime']?></td>
                  <td><?=$row['content_rating']?></td>
                  <td><?=$row['genre_type']?></td>
              </tr>
          <?php endforeach; ?>

          </table>
          
          <div id='pleaseWork'></div>
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
