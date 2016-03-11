document.addEventListener('DOMContentLoaded', newRating);

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