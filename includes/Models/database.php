<?php

class MySqlDatabase
{
    private $connection;

    function __construct()
    {
        $this->open_connection();
    }


    //Connection function with defined values from config.php
    public function open_connection()
    {
        $this->connection = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if(($this->connection)->connect_error)
        {
            die("Connection Field: " . ($this->connection)->connect_error);
        }
    }

    //simple function to get query result from db
    public function query($sql)
    {
        $result = mysqli_query($this->connection,$sql);
        if(!$result)
        {
            die("Query Field: " . ($this->connection)->connect_error);
        }
        return $result;
    }
}
//Automatically open connection when this file (database.php) is required
$database = new MySqlDatabase();

?>

