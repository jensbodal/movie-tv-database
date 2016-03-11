<!DOCTYPE html>
<html lang='en'>
<?php
  $title = "Add to DB";
  include '../includes/header.php';
?>
  <body>
  <?php include '../includes/navigation.php'; ?>
  <div class="container theme-showcase" role="main">
    <div id="blockContent" class="page-header addForms">
      <form>
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
          
          <input type="submit" id="newActor">
        </fieldset>
      </form>
      <form>
        <fieldset>
          <legend>Movie</legend>
          <label for="title">Title:</label>
          <input type="text" name="title" id="m_title">
          
          <label for="release_date">Release date:</label>
          <input type="date" name="release_date" id="m_release_date">
          
          <label for="country">Country:</label>
          <input type="text" name="country" id="m_country">

          <label for="run_time">Run Time:</label>
          <input type="number" name="run_time" id="m_run_time">
          
          <label for="genre">Genre:</label>
          <input type="text" name="genre" id="m_genre">

          <input type="radio" name="m_rating" id="m_rating" value="G"/>G
          <input type="radio" name="m_rating" id="m_rating" value="PG"/>PG     
          <input type="radio" name="m_rating" id="m_rating" value="PG-13"/>PG-13
          <input type="radio" name="m_rating" id="m_rating" value="R"/>R
          <input type="radio" name="m_rating" id="m_rating" value="NC-17"/>NC-17
          <input type="radio" name="m_rating" id="m_rating" value="NR" checked="checked"/>NR

          <input type="submit" id="newMovie">
        </fieldset>
      </form>
      <form>
        <fieldset>
          <legend>TV Show</legend>
          <label for="title">Title:</label>
          <input type="text" name="title" id="title">
          
          <label for="start_year">Start Year:</label>
          <input type="number" name="start_year" id="start_year">
          
          <label for="end_year">End Year:</label>
          <input type="number" name="end_year" id="end_year">
          
          <label for="country">Country:</label>
          <input type="text" name="country" id="country">

          <label for="run_time">Run Time:</label>
          <input type="number" name="run_time" id="run_time">
   
          <label for="genre">Genre:</label>
          <input type="text" name="genre" id="genre">

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
      
      <form method="get" id="gettitle" action="findReviewTitle.php">
        <fieldset>
          <legend>Add Review</legend>
          <label for="review_title">Title of Movie / TV Show:</label>
          <input type="text" name="review_title" id="review_title">
          <input type="submit" id="addReviewTitle">
        </fieldset>
      </form> 
      <p id="result"><p>
  </div>
</div>
  </body>
  <script src='buttons.js'></script>
</html>