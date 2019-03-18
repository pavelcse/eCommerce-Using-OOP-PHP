<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class User {
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function createNewUser($data) {
            $name = $this->fm->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);
            
            $address = $this->fm->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link, $address);
            
            $city = $this->fm->validation($data['city']);
            $city = mysqli_real_escape_string($this->db->link, $city);
            
            $country = $this->fm->validation($data['country']);
            $country = mysqli_real_escape_string($this->db->link, $country);
            
            $zipcode = $this->fm->validation($data['zipcode']);
            $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
            
            $phone = $this->fm->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);
            
            $email = $this->fm->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);
            
            $password = $this->fm->validation($data['password']);
            $password = mysqli_real_escape_string($this->db->link, $password);
            $password = md5($password);
            
            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zipcode) || empty($phone) || empty($email) || empty($password)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            }
            $mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $chkemail = $this->db->select($mailQuery);
            if ($chkemail != false) {
                $msg = "<span class='error'>Email already Exist...!!!</span>";
                     return $msg;
            } else {
                $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) VALUES('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
                $resutl = $this->db->insert($query);
                $result;
                if($resutl){
                     $msg = "<span class='success'>You have successfuly created your account. Please Login....</span>";
                     return $msg;
                 } else {
                     $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                     return $msg;
                 }
            }
        }
        
        public function userLogin($data) {
            $email = $this->fm->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);
            
            $password = $this->fm->validation($data['password']);
            $password = mysqli_real_escape_string($this->db->link, $password);
            $password = md5($password);
            
            if(empty($email) || empty($password)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            } else {
                $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
                $result = $this->db->select($query);
                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set("cuslogin", true);
                    Session::set("cusID", $value['customerId']);
                    Session::set("cusName", $value['name']);
                    echo "<script> window.location = 'order.php'; </script>";
                 } else {
                     $msg = "<span class='error'>Username or Password dos't match...!!! Please try again.</span>";
                     return $msg;
                 }
            }
        }
        
        public function getCustomerProfile($cusid) {
            $query = "SELECT * FROM tbl_customer WHERE customerId = '$cusid'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function updateProfile($data, $cusid){
            
            $name = $this->fm->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);
            
            $address = $this->fm->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link, $address);
            
            $city = $this->fm->validation($data['city']);
            $city = mysqli_real_escape_string($this->db->link, $city);
            
            $country = $this->fm->validation($data['country']);
            $country = mysqli_real_escape_string($this->db->link, $country);
            
            $zipcode = $this->fm->validation($data['zipcode']);
            $zipcode = mysqli_real_escape_string($this->db->link, $zipcode);
            
            $phone = $this->fm->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);
            
            $email = $this->fm->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);
            
            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zipcode) || empty($phone) || empty($email)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            }else {
                $query = "UPDATE tbl_customer SET name = '$name', address = '$address', city = '$city', country = '$country', zipcode = '$zipcode', phone = '$phone', email = '$email' WHERE customerId = '$cusid'";
                $result = $this->db->update($query);
                if($result){
                    header('location: profile.php');
                }else{
                    $msg = "<span class='error'>Something Wrong. Please Try Again...!</span>";
                    return $msg;
                }
            }
        }
        
        public function sendMessage($data){
            $name = $this->fm->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $phone = $this->fm->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);
            $email = $this->fm->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $message = $this->fm->validation($data['message']);
            $message = mysqli_real_escape_string($this->db->link, $message);
            
            $query = "INSERT INTO tbl_message(name, phone, email, message) VALUES('$name', '$phone', '$email', '$message')";
            $resutl = $this->db->insert($query);
            $result;
            if($resutl){
                 $msg = "<span class='success'>You Message Has Been Sent. We Will Contact You ASAP. Thanks....  </span>";
                 return $msg;
             } else {
                 $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                 return $msg;
             }
        }
    

}

