<?php

class database
{
    private $hostname = "localhost:3325";
    private $username = "root";
    private $password = "";
    private $dbname = "tech";

    protected $link;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {

        $this->link = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);

        if ($this->link) {
            // echo "connected";
        } else {
            echo "not connected";
        }
    }
}

// $obj = new database;