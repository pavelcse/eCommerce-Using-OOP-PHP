<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Customer {
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function showCustomerById($customerID){
            $query = "SELECT * FROM tbl_customer WHERE customerId = '$customerID'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
}


