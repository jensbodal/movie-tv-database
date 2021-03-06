<!DOCTYPE html>
<html lang='en'>
<?php

$title = "People";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT person.id AS person_id, first_name, last_name, birthdate FROM person ORDER BY first_name");

?>
<body>
  <?php include '../includes/navigation.php' ?>;
  <div class="container theme-showcase" role="main">
    <div id="blockContent" class="page-header">
      <table id="mainTable" class="table table-bordered">
        <caption id='tableCaption'>All People</caption>
          <thead>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Born</td>
          </thead>

    <?php if (count($rows) > 0): ?>
      <?php foreach($rows as $row): ?>
        <tr id="personItem-<?=$row['person_id']?>">
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

  <script src='handlers/tableHandler.js' type='text/javascript'></script>
</body>
</html>
