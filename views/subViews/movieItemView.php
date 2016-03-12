<?php

include '../../classes/MovieActorDBO.php';
$isGET = FALSE;
if (isset($_GET['id'])) {
  $isGET = TRUE;
  include '../../includes/header.php';
  $movie_id = $_GET['id'];
}
else {
  $movie_id = $_POST['id'];
}
// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$actorsQ = "
    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        WHERE movie.id=".$movie_id." 
        ORDER BY title

    ";

$directorsQ = "
    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM movie 
        INNER JOIN media ON media.id=movie.media_id
        INNER JOIN media_director ON media_director.media_id = media.id
        INNER JOIN director ON director.id = media_director.director_id
        INNER JOIN person ON person.id = director.person_id    
        WHERE movie.id=".$movie_id." 
        ORDER BY title

        ";

$movieQ = "
  SELECT movie.title AS title, DATE_FORMAT(movie.release_date, '%M %d, %Y') AS release_date, movie.release_country AS release_country, movie.runtime AS runtime, movie.content_rating AS content_rating,
    person.first_name AS first_name, person.last_name AS last_name,
    GROUP_CONCAT(DISTINCT genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type
    FROM movie 
      INNER JOIN media ON media.id=movie.media_id
      INNER JOIN media_actor ON media_actor.media_id = media.id
      INNER JOIN actor ON actor.id = media_actor.actor_id
      INNER JOIN person ON person.id = actor.person_id    
      INNER JOIN movie_genre ON movie_genre.movie_id = movie.id
      INNER JOIN genre ON genre.id = movie_genre.genre_id
      WHERE movie.id=".$movie_id." 
      ORDER BY title

      ";

$ratingQ = "
  SELECT rating.rating AS rating, rating.rating_url AS rating_url, site.name AS site_name, site.max_rating AS max_rating FROM movie
    INNER JOIN media ON media.id = movie.media_id
    INNER JOIN rating ON rating.media_id = media.id
    INNER JOIN site ON site.id = rating.site_id
    WHERE movie.id=".$movie_id."
    ORDER BY site_name;
  ";

$actorRows = $DBO->query($actorsQ);
$directorRows = $DBO->query($directorsQ);
$movieJSON = $DBO->queryJSON($movieQ);
$ratingRows = $DBO->query($ratingQ);

if ($isGET) {
  echo "<body>";
  include '../../includes/navigation.php';
  echo '<div class="container theme-showcase" role="main">';
  //echo '<div id="blockContent" class="page-header jumbotron">';
}

?>
<section class="ivt-section">
  <div class="col-sm-8 col-8 col-xs-12 no-padding">
    <div class="ivt-name">
      <ul>
        <h1 id='title'>&nbsp;</h1>
        <li>Genre(s)</li>
        <li>Release Date</li>  
        <li>Release Country</li>
        <li>Runtime</li>
        <li class="ivt-name-last">Content Rating</li>
      </ul>
    </div>
  </div>
  <div class="col-sm-2 col-2 col-xs-12 no-padding">
    <div class="ivt-data">
      <ul>
        <h1>&nbsp;</h1>
        <li id='genre_type'></li>
        <li id='release_date'></li>
        <li id='release_country'></li>
        <li id='runtime'></li>
        <li id='content_rating' class='ivt-data-last'></li>
      </ul>
    </div>
  </div>
</section>


<table id="actorTable" class="table table-bordered">
  <caption id='tableCaption'>Actors</caption>
  <thead>
    <td>First Name</td>
    <td>Last Name</td>
  </thead>

<?php
  if (count($actorRows) > 0): 
    foreach($actorRows as $row): ?>
      <tr>
        <td><?=$row['fn']?></td>
        <td><?=$row['ln']?></td>
      </tr>
<?php 
    endforeach; 

  else:
    echo "<tr>";
    echo "<td colspan=3 align='center'>None added</td>";
    echo "</tr>";
  endif;
  echo "</table>";
?>
<table id="directorTable" class="table table-bordered">
  <caption id='tableCaption'>Directors</caption>
  <thead>
    <td>First Name</td>
    <td>Last Name</td>
  </thead>

<?php
  if (count($directorRows) > 0): 
    foreach($directorRows as $row): ?>
      <tr>
        <td><?=$row['fn']?></td>
        <td><?=$row['ln']?></td>
      </tr>
<?php 
    endforeach; 

  else:
    echo "<tr>";
    echo "<td colspan=3 align='center'>None added</td>";
    echo "</tr>";
  endif;
  echo "</table>";
?>

<table id="ratingTable" class="table table-bordered">
  <caption id='tableCaption'>Ratings</caption>
  <thead>
    <td>Rating</td>
    <td>Site</td>
    <td>Link</td>
  </thead>

<?php
  if (count($ratingRows) > 0): 
    foreach($ratingRows as $row): ?>
      <tr>
        <td><?=$row['rating']?> / <?=$row['max_rating']?></td>
        <td><?=$row['site_name']?></td>
        <td><a href="<?=$row['rating_url']?>" target=_blank> <?=$row['rating_url']?> </a></td>
      </tr>
<?php 
    endforeach; 
    echo "<tr><td id='weightedAvg' class='emphasize' colspan=3 align='center'></td></tr>";
  else:
    echo "<tr>";
    echo "<td colspan=3 align='center'>None added</td>";
    echo "</tr>";
  endif;
  echo "</table>";
?>

<button id="reloadMovies" class="btn btn-primary">BACK</button>
</div>
</body>
<?php
  include '../../classes/ENGRhelper.php';
  $ENGR = new ENGRhelper();
?>
<script>
  // export php vars
  var allData = <?=$movieJSON?>;
  var ratings = <?=json_encode($ratingRows)?>;
</script>

<script src='<?=$ENGR->getCurrentDir()?>/handlers/movieItemHandler.js' type='text/javascript'></script>
