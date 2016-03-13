$(document).ready(function() {
  backButtonHandler();
  addTVShowInfo();
  addWeightedAverage();
});

function backButtonHandler() {
  $('#reloadView').on('click', function(event) {
    location.reload();
  });
}

function addTVShowInfo() {
  tvshow = allData[0];
  $('#title').text(tvshow.title);
  var genre = tvshow.genre_type;
  genre = genre == null ? "" : genre;
  var end_year = tvshow.end_year;
  end_year = end_year == null ? "" : end_year;
  $('#genre_type').text(genre);
  $('#start_year').text(tvshow.start_year);
  $('#end_year').text(end_year);
  $('#release_country').text(tvshow.release_country);
  $('#content_rating').text(tvshow.content_rating);
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
