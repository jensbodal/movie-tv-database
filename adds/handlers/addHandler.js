createShowList();
createGenreList();
createCountryList();


// titles exported from PHP
function createShowList() {
  var reviewOptions = $('#review_list');
  var epOptions = $('#tvshow_list');  
  $.each(titles, function() {
    reviewOptions.append($("<option />").val(this.title).text(this.title));
    epOptions.append($("<option />").val(this.title).text(this.title));
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

