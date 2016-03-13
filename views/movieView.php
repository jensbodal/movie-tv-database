<!DOCTYPE html>
<html lang='en'>
<?php

  $title = "Movies";
  include '../includes/header.php';
  include '../classes/MovieActorDBO.php';

  // turn on errors
  ini_set('display_errors', 'On');

  $DBO = new MovieActorDB();

  if (count($_GET) > 0) {
    echo $_GET['actor'];
    echo $_GET['genres'];
    $rows = $DBO->query("
      SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
          LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id 
          LEFT JOIN genre ON genre.id = movie_genre.genre_id 
          WHERE release_country = '".$_GET['country']."'
          GROUP BY title
          ORDER BY title");
  }
  else {
    $rows = $DBO->query("
        SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
            LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id 
            LEFT JOIN genre ON genre.id = movie_genre.genre_id 
            GROUP BY title
            ORDER BY title");
  }
       
    $genresJSON = $DBO->queryJSON("
      SELECT genre.genre_type AS genre FROM genre
        ORDER BY genre ASC
        ");

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

  <?php if (count($rows) > 0): ?>
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
    </div>
  </div>
  <?php

  else:
      echo "0 results";
  endif;
  ?>
  <div class="container theme-showcase" role="main">
    <form>
      <fieldset>
        <div class="col-md-2 text-center">
          <input type="text" id="searchActor" placeholder="Actor">
          <input type="radio" id="actorIn" value="IN">IN
          <input type="radio" id="actorIn" value="NOT_IN">NOT IN
          
          <input type="text" id="searchDirector" placeholder="Director">
          <input type="radio" id="directorIn" value="IN">IN
          <input type="radio" id="directorIn" value="NOT_IN">NOT IN
        </div>
        <div class="col-md-2 text-center">
          <input type="number" id="searchRelease" placeholder="Release Year">
          
          <select id="searchCountry"></select>
          <input type="number" id="searchRuntime" placeholder="Runtime">
        </div>         
        <div class="col-md-2 text-center" id="ratingsHolder"></div>
        <div class="col-md-4 text-center" id="genresHolder"></div>
 
        <div class="col-md-2 text-center">
        <input type="submit" class="btn btn-primary" id="movieSearch" value="Search">
        </div>
      <fieldset>
    </form>
  </div>
    <script>
    // export PHP vars
    var genres = <?= $genresJSON ?>;
  </script>
  <script src='handlers/tableHandler.js' type='text/javascript'></script>
  <script src='handlers/movieViewHandler.js' type='text/javascript'></script>
</body>

</html>
