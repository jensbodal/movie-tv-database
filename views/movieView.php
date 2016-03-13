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

    
   $rows = $DBO->query("SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
    LEFT JOIN media ON media.id = movie.media_id
    LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id 
    LEFT JOIN genre ON genre.id = movie_genre.genre_id 
    INNER JOIN (SELECT media.id FROM movie
                  LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id
                  LEFT JOIN genre ON genre.id = movie_genre.genre_id
                  LEFT JOIN media ON media.id = movie.media_id
                  INNER JOIN (SELECT media.id FROM media
                              LEFT JOIN media_director ON media_director.media_id = media.id
                              LEFT JOIN director on director.id = media_director.director_id
                              LEFT JOIN person on person.id = director.person_id
                              WHERE first_name = 'Ben' AND last_name = 'Stiller'
                  ) d_reqs ON d_reqs.id = media.id
                  INNER JOIN (SELECT media.id FROM media
                                LEFT JOIN media_actor ON media_actor.media_id = media.id
                                LEFT JOIN actor ON actor.id = media_actor.actor_id  
                                LEFT JOIN person on person.id = actor.person_id 
                                WHERE first_name = 'Ben' AND last_name = 'Stiller'
                  ) AS a_reqs ON a_reqs.id = media.id

                  WHERE release_country = 'USA' 
                       AND runtime = 119
                       AND YEAR(release_date) = 2016
                       AND (genre_type = 'Action' OR genre_type = 'Comedy' OR genre_type = 'Drama' OR genre_type = 'Adventure') 
                       AND (content_rating = 'PG' OR content_rating = 'R'OR content_rating = 'PG-13')
                        
                  GROUP BY id 
    ) AS movie_reqs on movie_reqs.id = media.id
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





  
  

  

  
  
  
  
  
  
  
  
  
  
  
  
  
  