createMediaList();
createGenreList();
createCountryList();
createTVShowList();


// titles exported from PHP
function createMediaList() {
  var reviewOptions = $('#review_list'); 
  var personMediaOptions = $('#media_list');
  personMediaOptions.append($("<option />").val("").text(""));
  $.each(titles, function() {
    reviewOptions.append($("<option />").val(this.title).text(this.title));
    personMediaOptions.append($("<option />").val(this.media_id).text(this.title));
  });
}

// genres exported from PHP
function createGenreList() {
  var movieOptions = $('#m_genre');
  var tvshowOptions = $('#genre');
  $.each(genres, function() {
    movieOptions.append($("<option />").val(this.genre).text(this.genre));
    tvshowOptions.append($("<option />").val(this.genre).text(this.genre));
  });
}

function createCountryList() {
  var movieOptions = $('#m_country');
  var tvshowOptions = $('#country');
  var genres = [ 
    {'country':'USA'},
    {'country':'UK'}
  ]
  $.each(genres, function() {
    movieOptions.append($("<option />").val(this.country).text(this.country));
    tvshowOptions.append($("<option />").val(this.country).text(this.country));
  });
}

function createTVShowList() {
  var epOptions = $('#tvshow_list');  
  $.each(tvshow_titles, function() {
    epOptions.append($("<option />").val(this.title).text(this.title));
  });
}
    