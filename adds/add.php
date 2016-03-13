<!DOCTYPE html>
<html lang='en'>

<?php
  $title = "Add to DB";
  include '../includes/header.php';
  include '../classes/MovieActorDBO.php';

  $DBO = new MovieActorDB();
  $movieShowJSON = $DBO->queryJSON("
    SELECT movie.title AS title, movie.media_id AS media_id FROM movie
    UNION ALL
    SELECT tvshow.title AS title, tvshow.media_id AS media_id  FROM tvshow
    ORDER BY title ASC
    ");
    
  $tvShowJSON = $DBO->queryJSON("
    SELECT title FROM tvshow
    ORDER BY title ASC
    ");
    
  $genresJSON = $DBO->queryJSON("
    SELECT genre.genre_type AS genre FROM genre
      ORDER BY genre ASC
      ");

?>
  <body>
  <?php include '../includes/navigation.php'; ?>
  <div id="addContainer" class="container theme-showcase addForms" role="main">
    <div id="blockContent" class="page-header">
      <form class="addForms">
        <fieldset>
          <legend>Person</legend>
          <label for="first_name">First Name:</label>
          <input type="text" name="first_name" id="first_name">
          
          <label for="last_name">Last Name:</label>
          <input type="text" name="last_name" id="last_name">

          <label for="birthday">Birthday:</label>
          <input type="date" name="birthday" id="birthday">
          
          <input type="radio" name="role" id="role" value="actor" checked="checked"/>Actor
          <input type="radio" name="role" id="role" value="director"/>Director
          
          <label for="person_media">Movie / TV Show:</label>
          <select name="person_media" id="media_list"></select>
          
          <input type="submit" id="newPerson">
        </fieldset>
      </form>
      <form class="addForms">
        <fieldset>
          <legend>Movie</legend>
          <label for="title">Title:</label>
          <input type="text" name="title" id="m_title">
          
          <label for="release_date">Release date:</label>
          <input type="date" name="release_date" id="m_release_date">
          
          <label for="country">Country:</label>
          <select name="movie_country_list" id="m_country"></select>

          <label for="run_time">Run Time:</label>
          <input type="number" name="run_time" id="m_run_time">
          
          <label for="genre">Genre:</label>
          <select name="movie_genre_list" id="m_genre"></select>

          <input type="radio" name="m_rating" id="m_rating" value="G"/>G
          <input type="radio" name="m_rating" id="m_rating" value="PG"/>PG     
          <input type="radio" name="m_rating" id="m_rating" value="PG-13"/>PG-13
          <input type="radio" name="m_rating" id="m_rating" value="R"/>R
          <input type="radio" name="m_rating" id="m_rating" value="NC-17"/>NC-17
          <input type="radio" name="m_rating" id="m_rating" value="NR" checked="checked"/>NR

          <input type="submit" id="newMovie">
        </fieldset>
      </form>
      <form class="addForms">
        <fieldset>
          <legend>TV Show</legend>
          <label for="title">Title:</label>
          <input type="text" name="title" id="title">
          
          <label for="start_year">Start Year:</label>
          <input type="number" name="start_year" id="start_year">
          
          <label for="end_year">End Year:</label>
          <input type="number" name="end_year" id="end_year">
          
          <label for="country">Country:</label>
          <select name="tvshow_country_list" id="country"></select>

          <label for="run_time">Run Time:</label>
          <input type="number" name="run_time" id="run_time">
   
          <label for="genre">Genre:</label>
          <select name="tvshow_genre_list" id="genre"></select>

          <input type="radio" name="rating" id="rating" value="TV-Y"/>TV Y
          <input type="radio" name="rating" id="rating" value="TV-Y7"/>TV Y7     
          <input type="radio" name="rating" id="rating" value="TV-Y7-FV"/>TV Y7 FV
          <input type="radio" name="rating" id="rating" value="TV-G"/>TV G
          <input type="radio" name="rating" id="rating" value="TV-PG"/>TV PG
          <input type="radio" name="rating" id="rating" value="TV-14"/>TV 14
          <input type="radio" name="rating" id="rating" value="TV-MA"/>TV MA        
          <input type="radio" name="rating" id="rating" value="NR" checked="checked"/>NR

          <input type="submit" id="newTV">
        </fieldset>
      </form> 

      <form>
        <fieldset>
          <legend>TV Show Episode</legend>
          <label for="tv_show_list">TV Show:</label>
          <select name="tvshow_list" id="tvshow_list"></select>
          
          <label for="title">Episode Title:</label>
          <input type="text" name="title" id="ep_title">
          
          <label for="ep_date">Air Date:</label>
          <input type="date" name="ep_date" id="ep_date">
          
          <label for="ep_runtime">Runtime:</label>
          <input type="number" name="ep_runtime" id="ep_runtime">

          <label for="season">Season:</label>
          <input type="number" name="season" id="season">
   
          <label for="ep_number">Episode Number:</label>
          <input name="ep_number" id="ep_number"></input>

          <input type="submit" id="newEp">
        </fieldset>
      </form>       

      <form class="addForms">
        <fieldset>
          <legend>Rating Site</legend>
          <label for="name">Site Name:</label>
          <input type="text" name="name" id="site_name">
          
          <label for="URL">URL:</label>
          <input type="text" name="URL" id="URL">

          <label for="max">Max Rating:</label>
          <input type="number" name="max" id="max">

          <input type="submit" id="newSite">
        </fieldset>
      </form> 
    
      <form method="get" id="gettitle" class="addForms" action="writeReview.php">
        <fieldset>
          <legend>Add Review</legend>
          <label for="review_title">Title of Movie / TV Show:</label>
          <select name="review_title" id="review_list"></select>
          <input type="submit" id="addReviewTitle">
        </fieldset>
      </form> 

  </div>
  <p id="result"><p>
</div>
  <script src='buttons.js'></script>
  <script>
    // export PHP vars
    var titles = <?= $movieShowJSON ?>;
    var genres = <?= $genresJSON ?>;
    var tvshow_titles = <?= $tvShowJSON ?>;
  </script>
  <script src='handlers/addHandler.js' type='text/javascript'></script>
  </body>
</html>


