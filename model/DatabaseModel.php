<?php

/*
* Mysql database class - only one connection allowed (SINGLETON PATTERN)
*/

class DatabaseModel
{

    private $_connection;
    private static $_instance; //The single instance

    /*
    Get an instance of the Database
    @return Instance
    */

    public static function getInstance()
    {
        //Syntax used to access static fields: class::$field_name
        if (!(self::$_instance instanceof self)) { // If no instance of Database, then make one
            self::$_instance = new self(); //it is the same as new Database()
        }
        return self::$_instance;
    }


    // Constructor
    // We could improve it by passing the config file path as a parameter
    private function __construct()
    {
        //config.ini could be used

        $config = array("host" => "localhost:3306",
        "dbname" => "myBD",
        "username" => "myuser",
        "password" => "mypassword");

        // Try and connect to the database
        $this->_connection = new mysqli($config['host'], $config['username'],
            $config['password'], $config['dbname']);

        // Error handling
        if ($this->_connection->connect_error) {
            trigger_error("Failed to connect to MySQL: " . $this->_connection->connect_error,
                E_USER_ERROR);
        }
    }

    // Prevents connection duplication. Instantly raises error
    public function __clone()
    {
        trigger_error("Cloning of " . get_class($this) . " not allowed: ", E_USER_ERROR);
    }

    // Also prevents connection duplication through serialization - deserialization
    public function __wakeup()
    {
        trigger_error("Deserialization of " . get_class($this) . " not allowed: ", E_USER_ERROR);
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    
    public function closeConnection()
    {
        $this->_connection->close();
        self::$_instance=null;
    }

    public function reconnect(){
        $this->_connection->close();
        self::$_instance=null;
        return self::getInstance()->getConnection();
    }

}
