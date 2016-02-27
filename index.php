<?php
// turn on errors
ini_set('display_errors', 'On');

$root_dir = "/nfs/stak/students/b/bodalj/public_html/cs340/movie-tv-database/";
$dbconfig = $root_dir . ".private/config.ini";
$read_config = parse_ini_file($dbconfig, true);

$servername = $read_config["database"]["servername"];
$username = $read_config["database"]["username"];
$password = $read_config["database"]["password"];
$dbname = $read_config["database"]["dbname"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT title, release_date, release_country, runtime, content_rating FROM movie ORDER BY title";
$result = $conn->query($sql);

if ($result->num_rows > 0):
    while ($rows[] = mysqli_fetch_assoc($result));
    // last entry is empty so remove it
    array_pop($rows);
?>

<table>
    <thead>
        <td>ID</td>
        <td>Movie Title</td>
        <td>Release Date</td>
        <td>Runtime</td>
        <td>Content Rating</td>
    </thead>

<?php foreach($rows as $row): ?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['release_date']?></td>
        <td><?=$row['release_country']?></td>
        <td><?=$row['runtime']?></td>
        <td><?=$row['content_rating']?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php

else:
    echo "0 results";

endif;
$conn->close();
?>
