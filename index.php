<?php

$root_dir = "/users/u1/b/bodalj/public_html/cs340/movie-tv-database/";
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

$sql = "SELECT id, f_name, l_name FROM actor_test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["f_name"] . "" . $row["l_name"] . "<br>";
    }

}
else {
    echo "0 results";
}
$conn->close();
?>
