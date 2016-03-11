<?php

class MovieActorDB {

    private $connection;

    public function __construct() {
        $root_dir = dirname(dirname(__FILE__)); 
        $dbconfig = $root_dir . "/.private/config.ini";
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
    
    /**
      * Returns an array of the query results
      */
    function query($query) {
        $result = $this->connection->query($query);
        $rows = array();
        
        if ($result) {
            while ($rows[] = mysqli_fetch_assoc($result));
            // need to remove last item since it's always empty
            array_pop($rows);
        }
        return $rows;
    }
    
    /**
      * Returns a JSON encoded result from the SQL query
      */
    function queryJSON($query) {
      return json_encode($this->query($query));
    }
}

?>

