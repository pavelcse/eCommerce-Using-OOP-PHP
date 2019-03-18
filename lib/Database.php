<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../config/config.php");
    class Database{
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbname = DB_NAME;
        
        public $link;
        public $error;
        
        public function __construct() {
            $this->connectDB();
        }
        public function connectDB(){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if(!$this->link){
                $this->error = "Connection fail".$this->link->connect_error;
                return false;
            }
        }
        
        // Read Data
        public function select($query){
            $result = $this->link->query($query) or die($this->link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            } else {
                return false;
            }
        }
        
        // Insert Data
        public function insert($query){
            $insert = $this->link->query($query) or die($this->link->error.__LINE__);
            if($insert){
                return $insert;
            } else {
                return false;
            }
        }
        
        // Update Data
        public function update($query){
            $update = $this->link->query($query) or die($this->link->error.__LINE__);
            if($update){
                return $update;
            } else {
                return false;
            }
        }
        
        // Delete Data
        public function delete($query){
            $delete = $this->link->query($query) or die($this->link->error.__LINE__);
            if($delete){
                return $delete;
            } else {
                return false;
            }
        }
    }
