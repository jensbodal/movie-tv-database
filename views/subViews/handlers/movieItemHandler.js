$(document).ready(function() {
  backButtonHandler();
  addMovieInfo();
  addWeightedAverage();
});

function backButtonHandler() {
  $('#reloadMovies').on('click', function(event) {
    location.reload();
  });
}

function addMovieInfo() {
  movie = allData[0];
  $('#title').text(movie.title);
  var genre = movie.genre_type;
  genre = genre == null ? "" : genre;
  console.log(genre);
  $('#genre_type').text(genre);
  $('#release_date').text(movie.release_date);
  $('#release_country').text(movie.release_country);
  $('#runtime').text(movie.runtime+" minutes");
  $('#content_rating').text(movie.content_rating);
}

function addWeightedAverage() {
  var weightedAvg = function() {
    var ratingSum = 0;
    var maxRatingSum = 0;
    $.each(ratings, function() {
      ratingSum += parseFloat($(this)[0].rating);
      maxRatingSum += parseFloat($(this)[0].max_rating);
    });
    return (ratingSum / maxRatingSum * 100).toFixed(2);
  };
  $('#weightedAvg').text("The weighted average is: "+weightedAvg()+'%');
}
