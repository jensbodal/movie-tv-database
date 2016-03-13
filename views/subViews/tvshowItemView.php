<?php

include '../../classes/MovieActorDBO.php';
$isGET = FALSE;
if (isset($_GET['id'])) {
  $isGET = TRUE;
  include '../../includes/header.php';
  $tvshow_id = $_GET['id'];
}
else {
  $tvshow_id = $_POST['id'];
}
// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$actorsQ = "
    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM tvshow 
        INNER JOIN media ON media.id=tvshow.media_id
        INNER JOIN media_actor ON media_actor.media_id = media.id
        INNER JOIN actor ON actor.id = media_actor.actor_id
        INNER JOIN person ON person.id = actor.person_id    
        WHERE tvshow.id=".$tvshow_id." 
        ORDER BY tvshow.title

    ";

$directorsQ = "
    SELECT person.first_name AS fn, person.last_name AS ln, person.birthdate AS bd FROM tvshow 
        INNER JOIN media ON media.id=tvshow.media_id
        INNER JOIN media_director ON media_director.media_id = media.id
        INNER JOIN director ON director.id = media_director.director_id
        INNER JOIN person ON person.id = director.person_id    
        WHERE tvshow.id=".$tvshow_id." 
        ORDER BY tvshow.title

        ";

$tvshowQ = "
  SELECT tvshow.title AS title, tvshow.start_year AS start_year, tvshow.end_year AS end_year, 
  tvshow.release_country AS release_country, tvshow.content_rating AS content_rating,
    person.first_name AS first_name, person.last_name AS last_name,
    GROUP_CONCAT(DISTINCT genre.genre_type ORDER BY genre.genre_type SEPARATOR ', ') AS genre_type
    FROM tvshow 
      INNER JOIN media ON media.id=tvshow.media_id
      INNER JOIN media_actor ON media_actor.media_id = media.id
      INNER JOIN actor ON actor.id = media_actor.actor_id
      INNER JOIN person ON person.id = actor.person_id    
      INNER JOIN tvshow_genre ON tvshow_genre.tvshow_id = tvshow.id
      INNER JOIN genre ON genre.id = tvshow_genre.genre_id
      WHERE tvshow.id=".$tvshow_id." 
      ORDER BY title

      ";

$episodesQ = "
  SELECT tvshow_episode.airdate AS airdate, tvshow_episode.episode_title AS title, tvshow_episode.runtime AS runtime, tvshow_episode.season AS season, tvshow_episode.episode_number AS number FROM tvshow_episode
    INNER JOIN tvshow ON tvshow.id = tvshow_episode.tvshow_id
    WHERE tvshow.id=".$tvshow_id."
    ORDER BY season, number ASC
  ";

$ratingQ = "
  SELECT rating.rating AS rating, rating.rating_url AS rating_url, site.name AS site_name, site.max_rating AS max_rating FROM tvshow
    INNER JOIN media ON media.id = tvshow.media_id
    INNER JOIN rating ON rating.media_id = media.id
    INNER JOIN site ON site.id = rating.site_id
    WHERE tvshow.id=".$tvshow_id."
    ORDER BY site_name;
  ";

$actorRows = $DBO->query($actorsQ);
$directorRows = $DBO->query($directorsQ);
$tvshowJSON = $DBO->queryJSON($tvshowQ);
$episodeRows = $DBO->query($episodesQ);
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
        <li>Start Year</li>
        <li>End Year</li>
        <li>Release Country</li>
        <li class="ivt-name-last">Content Rating</li>
      </ul>
    </div>
  </div>
  <div class="col-sm-2 col-2 col-xs-12 no-padding">
    <div class="ivt-data">
      <ul>
        <h1>&nbsp;</h1>
        <li id='genre_type'></li>
        <li id='start_year'></li>
        <li id='end_year'></li>
        <li id='release_country'></li>
        <li id='content_rating' class='ivt-data-last'></li>
      </ul>
    </div>
  </div>
</section>

<table id="episodeTable" class="table table-bordered">
  <caption id='tableCaption'>Episodes</caption>
  <thead>
    <td>Season</td>
    <td>Episode #</td>
    <td>Title</td>
    <td>Aired</td>
    <td>Runtime</td>
  </thead>

<?php
  if (count($episodeRows) > 0): 
    foreach($episodeRows as $row): ?>
      <tr>
        <td><?=$row['season']?></td>
        <td><?=$row['number']?></td>
        <td><?=$row['title']?></td>
        <td><?=$row['airdate']?></td>
        <td><?=$row['runtime']?></td>
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

<button id="reloadView" class="btn btn-primary">BACK</button>
</div>
</body>
<?php
  include '../../classes/ENGRhelper.php';
  $ENGR = new ENGRhelper();
?>
<script>
  // export php vars
  var allData = <?=$tvshowJSON?>;
  var ratings = <?=json_encode($ratingRows)?>;
  var arow = <?=json_encode($actorRows)?>;
  var drow = <?=json_encode($directorRows)?>;
  var trow = <?=json_encode($tvshowJSON)?>;
  var rrow = <?=json_encode($ratingRows)?>;
</script>

<script src='<?=$ENGR->getCurrentDir()?>/handlers/tvshowItemHandler.js' type='text/javascript'></script>
