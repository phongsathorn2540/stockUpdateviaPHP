<?php
    class Database{
        protected $host = 'localhost';
        protected $db = 'stockupdate';
        protected $user = 'root';
        protected $pass = '';
        public function db_con(){
            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            if ($conn->connect_error) {
                return die("Connection failed: " . $conn->connect_error);
            }else {
                return "conect";
            }
        }
    }
    class Main extends Database{
    }

    $testdb = new Main;
    echo $testdb->db_con();
?>