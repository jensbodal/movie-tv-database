document.addEventListener('DOMContentLoaded', addPerson);
document.addEventListener('DOMContentLoaded', addMovie);
document.addEventListener('DOMContentLoaded', addTVShow);
document.addEventListener('DOMContentLoaded', addEpisode);
document.addEventListener('DOMContentLoaded', addSite);
document.addEventListener('DOMContentLoaded', addGenre);

function addPerson() {
  document.getElementById('newPerson').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var birthday = document.getElementById('birthday').value;
    var media = document.getElementById('media_list').value;
    var roles = document.getElementsByName('role');
    var role;
    for (var i = 0; i < roles.length; i++) {
      if (roles[i].checked) {
        role = roles[i].value;
      }
    }
    // Ensure that all fields hold a value
    if (first_name == "" || last_name == "" || birthday == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = first_name + " " + last_name + " was added succesfully.";
      }
    }
    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addPerson.php?first_name=' + first_name + '&last_name=' + last_name + 
      '&birthday=' + birthday + '&role=' + role + '&media=' + media, true);
      request.send(null);
    }
    event.preventDefault();
  });
}

function addMovie() {
  document.getElementById('newMovie').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var title = document.getElementById('m_title').value;
    var release_date = document.getElementById('m_release_date').value;
    var country = document.getElementById('m_country').value;
    var run_time = document.getElementById('m_run_time').value;
    var genre = document.getElementById('m_genre').value;
    
    var ratings = document.getElementsByName('m_rating');
    var rating;
    for (var i = 0; i < ratings.length; i++) {
      if (ratings[i].checked) {
        rating = ratings[i].value;
      }
    }
    
    // Ensure that all fields hold a value
    if (title == "" || release_date == "" || country == "" || run_time == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = "\"" + title + "\" was added successfully.";
      }
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addMovie.php?title=' + title + '&release_date=' + release_date + 
        '&country=' + country + '&run_time=' + run_time + '&genre=' + genre + '&rating=' + rating, true);
      request.send(null);
    }
    event.preventDefault();
  });
}

function addTVShow() {
  document.getElementById('newTV').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var title = document.getElementById('title').value;
    var start_year = document.getElementById('start_year').value;
    var end_year = document.getElementById('end_year').value;
    var country = document.getElementById('country').value;
    var run_time = document.getElementById('run_time').value;
    var genre = document.getElementById('genre').value;

    var ratings = document.getElementsByName('rating');
    var rating;
    for (var i = 0; i < ratings.length; i++) {
      if (ratings[i].checked) {
        rating = ratings[i].value;
      }
    }    

    // Ensure that all fields hold a value
    if (title == "" || start_year == "" || country == "" || run_time == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = "\"" + title + "\" was added successfully.";
      }
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addTVShow.php?title=' + title + '&start_year=' + start_year + "&end_year=" + end_year +
        '&country=' + country + '&run_time=' + run_time + '&genre=' + genre + '&rating=' + rating, true);
      request.send(null);
    }
    event.preventDefault();
  });
}

function addEpisode() {
  document.getElementById('newEp').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var tvshow = document.getElementById('tvshow_list').value;
    var title = document.getElementById('ep_title').value;
    var date = document.getElementById('ep_date').value;
    var runtime = document.getElementById('ep_runtime').value;
    var season = document.getElementById('season').value;
    var number = document.getElementById('ep_number').value;    

    // Ensure that all fields hold a value
    if (title == "" || date == "" || runtime == "" || season == "" || number == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      $.get( 'addEpisode.php?tvshow=' + tvshow + '&title=' + title + "&date=" + date +
              '&runtime=' + runtime + '&season=' + season + '&number=' + number, function(result){
        if(result.length === 2) {
          document.getElementById('result').innerHTML = "Episode \"" + title + "\" of " +
          tvshow + " was added successfully.";
        }
        else {
          var episode = JSON.parse(result);
          document.getElementById("result").innerHTML = "Season " + episode[0].season + " episode " +
          episode[0].episode_number + " of " + tvshow + " is already in the database. It is called: \"" +
          episode[0].episode_title + "\"";
        }
      });
    }
    event.preventDefault();
  });
}

function addSite() {
  document.getElementById('newSite').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var site_name = document.getElementById('site_name').value;
    var url = document.getElementById('URL').value;
    var max = document.getElementById('max').value;

    // Ensure that all fields hold a value
    if (site_name == "" || url == "" || max == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = site_name + " was added successfully.";
      }
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addSite.php?site_name=' + site_name + '&url=' + url + "&max=" + max, true);
      request.send(null);
    }
    event.preventDefault();
  });
}

function addGenre() {
  document.getElementById('addNewGenre').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var genre = document.getElementById('newGenre').value;

    // Ensure that all fields hold a value
    if (genre == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = genre + " was added successfully.";
      }
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addGenre.php?genre=' + genre, true);
      request.send(null);
    }
    event.preventDefault();
  });
}