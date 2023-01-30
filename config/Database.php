<?php

class Database
{

    //Databate parameters

    private $host = 'localhost';
    private $db_name = 'test';
    private $username = 'root';
    private $password = '';
    private $conn;



    //Database Connection

    public function connect()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Connection Error: ' . $ex->getMessage();
        }

        return $this->conn;
    }
}
