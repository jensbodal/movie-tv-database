document.addEventListener('DOMContentLoaded', newRating);
//document.addEventListener('DOMContentLoaded', updateMax);

function newRating() {
  document.getElementById('addRating').addEventListener('click', function(event) {
    var request = new XMLHttpRequest();
    var valid = true;
    var site_name = document.getElementById('site_list').value;
    var url = document.getElementById('url').value;
    var rating = document.getElementById('rating').value;

    var ids = document.getElementsByName('media_id');
    var id = -1;
    for (var i = 0; i < ids.length; i++) {
      if (ids[i].checked) {
        id = ids[i].value;
      }
    } 
    
    
    // Ensure that all fields hold a value
    if (id == -1 || site_name == "" || url == "" || rating == "") {
      document.getElementById("result").innerHTML = "Cannot submit incomplete data."; 
      valid = false;
    }

    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        document.getElementById("result").innerHTML = "Your review was added successfully.";
      }
    }

    // When the submit button is pressed, send a GET request to update the database
    if (valid == true) {
      request.open('GET', 'insertReview.php?media_id=' + id + '&site_name=' + site_name + '&url=' + url + "&rating=" + rating, true);
      request.send(null);
    }
    event.preventDefault();
  });
}

// function updateMax() {

  // document.getElementById('site_list').addEventListener('change', function(event) {
    // var request = new XMLHttpRequest();
    
    // var site_name = document.getElementById('site_list').value;
    
    // request.onreadystatechange = function() {
      // if (request.readyState == 4 && request.status == 200) {
        // console.log(request.responseText);

        // var response = JSON.parse(request.responseText);
        // document.getElementById('max').innerHTML=response;
      // }
    // }
    
    // request.open('GET', 'getSiteMax.php?site_name=' + site_name, true);
    // request.send(null);
    // event.preventDefault();
  // });
// }

function updateMax() {
 $(document).ready(function() {
  // document.getElementById('site_list').addEventListener('change', function(event) {
    var site_name = document.getElementById('site_list').value;
    var site_request = 'getSiteMax.php?site_name=' + site_name;
    console.log(site_request);
    $.get('getSiteMax.php?site_name=IMDB', function(result) {
        console.log(result);
      }, 'json'
    );
    // $.getJSON('getSiteMax.php?site_name=IMDB', function(data) {
      // console.log(data[0].max_rating); 
    // });
  // });
 });
}
updateMax();