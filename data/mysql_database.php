<?php
require_once __DIR__ . "/" . "./interfaces/database.php";
//
class MySQLDatabase implements Database {

    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect("localhost", "root", "competitor");
        mysqli_set_charset($this->connection, "utf8");
        // Verifying possible errors
        if(!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error(0));
        } else {
            mysqli_query($this->connection, "USE SoftwareManager");
        }
    }

    public function __destruct() {
        // Review the usage of this method
        // mysqli_close($this->connection);
    }

    public function db_list($name) {
        // Build SQL query
        $sqlQuery = "SELECT * FROM $name";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
        // Turn results into objects
        $results = [];
        while($resultRow = mysqli_fetch_assoc($queryResult)) {
            array_push($results, $resultRow);
        }
        // Return results
        return $results;
    }

    public function db_update($name, $id, $object) {
        // Get key values from object
        $keyValues = "";
        foreach($object as $key => $value) {
            if(is_array($value)) {
                // Method addslashes escape quotes
                $keyValues .= $key . " = \"" . addslashes(json_encode($value)) . "\",";
            } else {
                $keyValues .= $key . " = \"" . addslashes($value) . "\",";
            }
        }
        // Removing trailing commas
        if(strlen($keyValues) > 0) {
            $keyValues = substr($keyValues, 0, strlen($keyValues) - 1);
        }
        // Build SQL Query
        $sqlQuery = "UPDATE $name SET $keyValues WHERE id = \"$id\"";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
    }

    public function db_read($name, $id) {
        // Build SQL Query
        $sqlQuery = "SELECT * FROM $name WHERE id = \"$id\"";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
        // Turn result into object
        if(mysqli_num_rows($queryResult) > 0) {
            $resultRow = mysqli_fetch_assoc($queryResult);
            // Return result
            return $resultRow;
        } else {
            // Return null to indicate not found
            return null;
        }
    }

    public function db_exists($name, $id) {
        // Build SQL Query
        $sqlQuery = "SELECT * FROM $name WHERE id = \"$id\"";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
        // Turn result into object
        if(mysqli_num_rows($queryResult) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function db_delete($name, $id) {
        // Build SQL Query
        $sqlQuery = "DELETE FROM $name WHERE id = \"$id\"";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
    }

    public function db_create($name, $object) {
        // Inserting ID into object
        $id = com_create_guid();
        $object["id"] = $id;
        // Get properties from object
        $fields = "";
        $values = "";
        foreach ($object as $key => $value) {
            $fields .= $key . ",";
            if(is_array($value)) {
                $values .= "\"" . addslashes(json_encode($value)) . "\"" . ",";
            } else {
                $values .= "\"" . addslashes($value) . "\"" . ",";
            }
        }
        // Removing trailing commas
        if(strlen($fields) > 0)
            $fields = substr($fields, 0, strlen($fields) - 1);
        if(strlen($values) > 0)
            $values = substr($values, 0, strlen($values) - 1);
        // Build SQL Query
        $sqlQuery = "INSERT INTO $name ($fields) VALUES ($values)";
        // Execute SQL Query
        $queryResult = mysqli_query($this->connection, $sqlQuery);
    }

}
?>