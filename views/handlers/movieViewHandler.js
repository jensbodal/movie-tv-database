createCountryList();
createRatingOptions();
createGenreList();
document.addEventListener('DOMContentLoaded', search);

function createCountryList() {
  var searchCountries = $('#searchCountry');
  var countries = [ 
    {'country':'USA'},
    {'country':'UK'}
  ]
  searchCountries.append($("<option />").val("").text(""));
  $.each(countries, function() {
    searchCountries.append($("<option />").val(this.country).text(this.country));
  });
}

function createRatingOptions() {
  var searchRatings = $('#ratingsHolder');
  var ratings = [ 
    {'rating':'G'},
    {'rating':'PG'},
    {'rating':'PG-13'},
    {'rating':'R'},
    {'rating':'NC-17'},
    {'rating':'NR'}    
  ]
  $.each(ratings, function() {
    searchRatings.append($("<label />").val(this.rating).text(this.rating));
    searchRatings.append($("<input type='checkbox' name='searchRatings'/>").val(this.rating).text(this.rating));
  });
}

// genres exported from PHP
function createGenreList() {
  var movieGenres = $('#genresHolder');
  $.each(genres, function() {
    movieGenres.append($("<label />").val(this.genre).text(this.genre));
    movieGenres.append($("<input type='checkbox' name='searchGenres'/>").val(this.genre).text(this.genre));
  });
}

function search() {
  
  document.getElementById('movieSearch').addEventListener('click', function(event) {
    var actorFirst = document.getElementById('searchActorFirst').value;
    var actorLast = document.getElementById('searchActorLast').value;
    var actorIncluded = document.getElementById('actorIn');
    var actorIn;
    for (var i = 0; i < actorIncluded.length; i++) {
      if (actorIncluded[i].checked) {
        actorIn = actorIncluded[i].value;
      }
    }
    var queryString = '?actorFirst=' + actorFirst + '&actorLast=' + actorLast + '&actorIn=' + actorIn;
    
    var directorFirst = document.getElementById('searchDirectorFirst').value;
    var directorLast = document.getElementById('searchDirectorLast').value;
    var directorIncluded = document.getElementById('directorIn');
    var directorIn;
    for (var i = 0; i < directorIncluded.length; i++) {
      if (directorIncluded[i].checked) {
        directorIn = directorIncluded[i].value;
      }
    }
    queryString += '&directorFirst=' + directorFirst + '&directorLast=' + directorLast + '&directorIn=' + directorIn;
    
    var year = document.getElementById('searchRelease').value;  
    var country = document.getElementById('searchCountry').value;
    var runtime = document.getElementById('searchRuntime').value;
    queryString += '&year=' + year + '&country=' + country + '&runtime=' + runtime;
    
    var allGenres = document.getElementsByName('searchGenres');
    var genres = "";
    for (var i = 0; i < allGenres.length; i++) {
      if (allGenres[i].checked) {
        genres += allGenres[i].value + ",";
      }
    }
    queryString += '&genres' + genres;
    
    var allRatings = document.getElementsByName('searchRatings');
    var ratings = "";
    for (var i = 0; i < allRatings.length; i++) {
      if (allRatings[i].checked) {
        ratings += allRatings[i].value + ",";
      }
    } 
    queryString += '&ratings=' + ratings;
    window.location = queryString;

    event.preventDefault();
  });
}