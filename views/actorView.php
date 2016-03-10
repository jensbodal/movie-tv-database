<?php

$title = "Actors";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT first_name, last_name, birthdate FROM person INNER JOIN actor ON actor.person_id = person.id ORDER BY first_name");

if (count($rows) > 0):
?>

<body>
  <?php include '../includes/navigation.php' ?>;
  <div class="container theme-showcase" role="main">
    <div id="blockContent" class="page-header">
      <table id="mainTable" class="table table-bordered">
          <caption>Actors</caption>
          <thead>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Born</td>
          </thead>

      <?php foreach($rows as $row): ?>
          <tr>
              <td><?=$row['first_name']?></td>
              <td><?=$row['last_name']?></td>
              <td><?=$row['birthdate']?></td>
          </tr>
      <?php endforeach; ?>

      </table>
    </div>
  </div>

<?php

else:
    echo "0 results";
endif;
?>

</body>

<script src='handlers/tableHandler.js' type='text/javascript'></script>
