<?php

/*
* SQL Server database connection class - only one connection allowed (SINGLETON PATTERN)
*/

class IdentityDBModel
{

    private $_connection;
    private static $_instance; //The single instance

    /*
    Get an instance of the Database
    @return Instance
    */

    public static function getInstance()
    {
        // If no instance of Database, then make one
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    // Constructor
    // We could improve it by passing the config file path as a parameter
    private function __construct()
    {
        //config.ini could be used

        $config = include_once('/var/simplesaml/identidades_config.php');
        $serverName = $config['serverName'];
        $connectionOptions = array(
          'database' => $config['database'],
          'uid' => $config['uid'],
          'pwd' => $config['pwd']
        );
        // Try and connect to the database

        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn === false) {
            self::formatErrors(sqlsrv_errors());
            die;
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

    public function formatErrors($errors)
    {
        // Display errors
        echo "<h1>SQL Error:</h1>";
        echo "Error information: <br/>";
        foreach ($errors as $error) {
            echo "SQLSTATE: ". $error['SQLSTATE'] . "<br/>";
            echo "Code: ". $error['code'] . "<br/>";
            echo "Message: ". $error['message'] . "<br/>";
        }
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
