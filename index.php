<?php
$title = 'Movie/TV Show Database';
include 'includes/header.php';
include 'classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$query = "
   SELECT COUNT(movie.id) AS info FROM movie
   UNION ALL
   SELECT COUNT(tvshow.id) FROM tvshow
   UNION ALL
   SELECT COUNT(tvshow_episode.id) FROM tvshow_episode
   UNION ALL
   SELECT COUNT(actor.id) FROM actor
   UNION ALL
   SELECT COUNT(director.id) FROM director
   UNION ALL
   SELECT COUNT(rating.id) FROM rating
   UNION ALL
   SELECT COUNT(site.id) FROM site
   UNION ALL
   SELECT COUNT(genre.id) FROM genre
    ";

$summaryInfo = $DBO->query($query);

?>

<body>
<?php include 'includes/navigation.php'; ?>
<div class="container theme-showcase" role="main">
    <div id="blockContent" class="page-header">
        <h3> Welcome! Use the navigation menu to find information on Movies and TV Shows </h3>
    </div>
    <section class="ivt-section">
      <div class="col-sm-8 col-8 col-xs-12 no-padding">
        <div class="ivt-name">
          <h1 id='title'>&nbsp;</h1>
          <ul>
            <li># Movies</li>
            <li># TV Shows</li>  
            <li># TV Show Episodes</li>
            <li># Actors</li>
            <li># Directors</li>
            <li># Ratings</li>
            <li># Rating Sites</li>
            <li class="ivt-name-last"># Genres</li>
          </ul>
        </div>
      </div>
      <div class="col-sm-2 col-2 col-xs-12 no-padding">
        <div class="ivt-data">
          <ul>
            <h1>&nbsp;</h1>
            <li id='movies'></li>
            <li id='tvshows'></li>
            <li id='episodes'></li>
            <li id='actors'></li>
            <li id='directors'></li>
            <li id='ratings'></li>
            <li id='sites'></li>
            <li id='genres' class='ivt-data-last'></li>
          </ul>
        </div>
      </div>
    </section>
</div>
  </body>
</html>

<script>
  // export php vars
  var summary = <?=json_encode($summaryInfo)?>;
  summary = summary;
  addSummaryInfo();
  function addSummaryInfo() {
    $('#title').text('SUMMARY');
    $('#movies').text(summary[0].info);
    $('#tvshows').text(summary[1].info);
    $('#episodes').text(summary[2].info);
    $('#actors').text(summary[3].info);
    $('#directors').text(summary[4].info);
    $('#ratings').text(summary[5].info);
    $('#sites').text(summary[6].info);
    $('#genres').text(summary[7].info);
  };
</script>

