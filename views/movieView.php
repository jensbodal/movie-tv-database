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
   $startString = "SELECT movie.id AS movie_id, title, release_date, release_country, runtime, content_rating, GROUP_CONCAT(genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type FROM movie 
                    LEFT JOIN media ON media.id = movie.media_id
                    LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id 
                    LEFT JOIN genre ON genre.id = movie_genre.genre_id 
                    INNER JOIN (SELECT media.id FROM movie
                                  LEFT JOIN movie_genre ON movie_genre.movie_id = movie.id
                                  LEFT JOIN genre ON genre.id = movie_genre.genre_id
                                  LEFT JOIN media ON media.id = movie.media_id ";
    $queryString = $startString;
    
    if ($_GET['directorFirst'] || $_GET['directorLast']) {    
      $directorString = "INNER JOIN (SELECT media.id FROM media
                                LEFT JOIN media_director ON media_director.media_id = media.id
                                LEFT JOIN director on director.id = media_director.director_id
                                LEFT JOIN person on person.id = director.person_id 
                                WHERE ";
      if ($_GET['directorFirst']) {
        $directorFirst = "first_name ";
        if (!strcmp($_GET['directorIn'], "IN")) {
          $directorFirst .= "= '".$_GET['directorFirst']."' ";
        }
        else {
          $directorFirst .= "!= '".$_GET['directorFirst']."' ";
        }
        $directorString .= $directorFirst;
      }
      if ($_GET['directorLast']) {
        $directorLast = "last_name ";
        if (!strcmp($_GET['directorIn'], "IN")) {
          $directorLast .= "= '".$_GET['directorLast']."' ";
        }
        else {
          $directorLast .= "!= '".$_GET['directorLast']."' ";
        }
        if (!strcmp(substr($directorString, -6), "WHERE ")) {
          $directorString .= $directorLast;
        }
        else {
          $directorString .= "AND " . $directorLast;
        }
      }
      $directorString .= ") d_reqs ON d_reqs.id = media.id ";   
      $queryString .= $directorString;
    }
    
    if ($_GET['actorFirst'] || $_GET['actorLast']) {
      $actorString = "INNER JOIN (SELECT media.id FROM media
                                  LEFT JOIN media_actor ON media_actor.media_id = media.id
                                  LEFT JOIN actor ON actor.id = media_actor.actor_id  
                                  LEFT JOIN person on person.id = actor.person_id 
                                  WHERE ";
      if ($_GET['actorFirst']) {
        $actorFirst = "first_name ";
        if (!strcmp($_GET['actorIn'], "IN")) {
          $actorFirst .= "= '".$_GET['actorFirst']."' ";
        }
        else {
          $actorFirst .= "!= '".$_GET['actorFirst']."' ";
        }
        $actorString .= $actorFirst;
      }
      if ($_GET['actorLast']) {
        $actorLast = "last_name ";
        if (!strcmp($_GET['actorIn'], "IN")) {
          $actorLast .= "= '".$_GET['actorLast']."' ";
        }
        else {
          $actorLast .= "!= '".$_GET['actorLast']."' ";
        }
        if (!strcmp(substr($actorString, -6), "WHERE ")) {
          $actorString .= $actorLast;
        }
        else {
          $actorString .= "AND " . $actorLast;
        }
      }
      $actorString .= ") a_reqs ON a_reqs.id = media.id ";   
      $queryString .= $actorString;
    }                                  

    if ($_GET['country'] || $_GET['year'] || $_GET['runtime'] || $_GET['genres'] || $_GET['ratings']) {
      $queryString .= " WHERE ";
      
      if ($_GET['country']) {
        $countryString = "release_country = '".$_GET['country']."'";
        $queryString .= $countryString;
      }
      if ($_GET['runtime']) {
          $runtimeString = "runtime = ".$_GET['runtime']."";
        if (!strcmp(substr($queryString, -6), "WHERE ")) {
          $queryString .= $runtimeString;
        }
        else {
          $queryString .= " AND " . $runtimeString;
        }
      }
      if ($_GET['year']) {
        $yearString = "YEAR(release_date) = ".$_GET['year']."";
        if (!strcmp(substr($queryString, -6), "WHERE ")) {
          $queryString .= $yearString;
        }
        else {
          $queryString .= " AND " . $yearString;
        }
      }
      if ($_GET['genres']) {
        $genres = explode (",", $_GET['genres']);
        $numGenres = sizeof($genres) - 1;
        $genreString = "(genre_type = '" . $genres[0] . "'"; 
        for ($i = 1; $i < $numGenres; $i++) {
          $genreString .= " OR genre_type = '" . $genres[$i] . "'";
        }
        $genreString .= ")";
        if (!strcmp(substr($queryString, -6), "WHERE ")) {
          $queryString .= $genreString;
        }
        else {
          $queryString .= " AND " . $genreString;
        }
      }
      if ($_GET['ratings']) {
        $ratings = explode (",", $_GET['ratings']);
        $numRatings = sizeof($ratings) - 1;
        $ratingString = "(content_rating = '" . $ratings[0] . "'";
        for ($i = 1; $i < $numRatings; $i++) {
          $ratingString .= " OR content_rating ='" . $ratings[$i] . "'"; 
        }
        $ratingString .= ")";
        if (!strcmp(substr($queryString, -6), "WHERE ")) {
          $queryString .= $ratingString;
        }
        else {
          $queryString .= " AND " . $ratingString;
        }
      }
    }
        
    $endString = " GROUP BY id 
                  ) AS movie_reqs on movie_reqs.id = media.id
                  GROUP BY title
                  ORDER BY title";              
    $queryString .= $endString; 
    $rows = $DBO->query($queryString);

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
    <form id="movieSearchForm" class="form">
      <fieldset>
        <div class="col-md-2 text-center">
          <input type="text" class="form-control" id="searchActorFirst" placeholder="Actor First Name">
          <input type="text" class="form-control" id="searchActorLast" placeholder="Actor Last Name">
          <input type="radio" name="actorIn" value="IN" checked="checked">IN
          <input type="radio" name="actorIn" value="NOT_IN">NOT IN
        </div>
        <div class="col-md-2 text-center">        
          <input type="text" class="form-control" id="searchDirectorFirst" placeholder="Director First Name">
          <input type="text" class="form-control" id="searchDirectorLast" placeholder="Director Last Name">
          <input type="radio" name="directorIn" value="IN" checked="checked">IN
          <input type="radio" name="directorIn" value="NOT_IN">NOT IN
        </div>
        <div class="col-md-2 text-center">
          <input type="number" class="form-control" id="searchRelease" placeholder="Release Year">
          
          <select id="searchCountry" class="form-control" ></select>
          <input type="number" class="form-control" id="searchRuntime" placeholder="Runtime">
        </div>  
        <div class="col-md-2" id="ratingsHolder"></div>
        <div class="col-md-3" id="genresHolder"></div>
        <div class="col-sm-1 text-center">
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





  
  

  

  
  
  
  
  
  
  
  
  
  
  
  
  
  