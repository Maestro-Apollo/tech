<?php

class database
{
    private $hostname = "remotemysql.com";
    private $username = "gwRBZDSW6o";
    private $password = "LEnnyi3t1o";
    private $dbname = "gwRBZDSW6o";

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