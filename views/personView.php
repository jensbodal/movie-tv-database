<?php

$title = "People";
include '../includes/header.php';
include '../classes/MovieActorDBO.php';

// turn on errors
ini_set('display_errors', 'On');

$DBO = new MovieActorDB();

$rows = $DBO->query("SELECT first_name, last_name, birthdate FROM person ORDER BY first_name");

if (count($rows) > 0):
?>

<div id="actorTable" class="viewTable">
<table>
    <caption>All People</caption>
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

<?php

else:
    echo "0 results";

endif;

include 'footer.html';
?>
