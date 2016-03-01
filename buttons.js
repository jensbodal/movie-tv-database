document.addEventListener('DOMContentLoaded', addActor);
document.addEventListener('DOMContentLoaded', addMovie);
document.addEventListener('DOMContentLoaded', addTVShow);
document.addEventListener('DOMContentLoaded', addSite);


function addActor() {
  document.getElementById('newActor').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var birthday = document.getElementById('birthday').value;
    var role = document.getElementById('role').value;
    // Ensure that all fields hold a value
    if (first_name == "" || last_name == "" || birthday == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = first_name + " " + last_name + " was added succesfully.";
      }
      else {
        console.log("Error adding Person");
      }
    }
    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'addPerson.php?first_name=' + first_name + '&last_name=' + last_name + '&birthday=' + birthday + '&role=' + role, true);
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
    var rating = document.getElementById('m_rating').value;
    
    // Ensure that all fields hold a value
    if (title == "" || release_date == "" || country == "" || run_time == "" || genre == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = title + " was added successfully.";
      }
      else {
        console.log("Error adding Movie");
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
    var rating = document.getElementById('rating').value;
    // Ensure that all fields hold a value
    if (title == "" || start_year == "" || country == "" || run_time == "" || genre == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = title + " was added successfully.";
      }
      else {
        console.log("Error adding TV Show");
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
      else {
        console.log("Error adding TV Show");
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