<?php

class MovieActorDB {

    private $root_dir = "/nfs/stak/students/b/bodalj/public_html/cs340/movie-tv-database/";
    private $connection;

    public function __construct() {
        $dbconfig = $this->root_dir . ".private/config.ini";
        $read_config = parse_ini_file($dbconfig, true);

        $servername = $read_config["database"]["servername"];
        $username = $read_config["database"]["username"];
        $password = $read_config["database"]["password"];
        $dbname = $read_config["database"]["dbname"];

        // Create connection
        $this->connection = new mysqli(
            $servername, $username, $password, $dbname
        );
        
        // Check Connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function __destruct() {
        $this->connection->close();
    }

    function query($query) {
        $result = $this->connection->query($query);
        $rows = array();
        
        if ($result) {
            while ($rows[] = mysqli_fetch_assoc($result));
            array_pop($rows);
        }
        return $rows;
    }
}

?>

