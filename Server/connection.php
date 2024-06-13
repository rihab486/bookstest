<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Database Connection
 */
class DB_Connection
{
    private $server = 'localhost';
    private $dbname = 'bdbooks';
    private $user = 'root';
    private $pass = '';

    /**
     * Connects to the database using PDO.
     * @return PDO|null The PDO connection object or null on failure.
     * @error handle exception error
     */
    public function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return null;
        }
    }
}

?>
