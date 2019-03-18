<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Session.php");
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class AdminLogin{
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }

        public function adminLogin($adminUser, $adminPass){
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);
            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
            
            if(empty($adminUser) || empty($adminPass)){
                $loginmsg = "Username or Password must not be Empty...!";
                return $loginmsg;
            } else {
                $adminPass = md5($adminPass);
                $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' ";
                $resutl = $this->db->select($query);
                if($resutl != false){
                    $value = $resutl->fetch_assoc();
                    Session::set(adminLogin, true);
                    Session::set(adminId, $value['adminId']);
                    Session::set(adminUser, $value['adminUser']);
                    Session::set(adminName, $value['adminName']);
                    header('location: dashbord.php');
                } else {
                    $loginmsg = "Username or Password dos't match...!";
                    return $loginmsg;
                }
            }
        }
        
        public function adminProfileUpdate($userid, $data){
            $name = $this->fm->validation($data['adminName']);
            $username = $this->fm->validation($data['adminUser']);
            $email = $this->fm->validation($data['adminEmail']);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $username = mysqli_real_escape_string($this->db->link, $username);
            $email = mysqli_real_escape_string($this->db->link, $email);

            if ($name == "" || $username == "" || $email == "") {
                $msg = "<span class='error'>Error. Field Must Not Be Empty...!!!</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_admin SET 
                adminName        ='$name', 
                adminUser    ='$username', 
                adminEmail       ='$email' 
                WHERE adminId    = '$userid'";
                $update_row = $this->db->update($query);

                if ($update_row) {
                    $msg = "<span class='success'>User Details Updated Successfully.</span>";
                    return $msg;
                }else {
                    $msg = "<span class='error'>Sorry, Update Failed...!!!</span>";
                    return $msg;
                }
            }
        }
        
        public function adminProfile($adminid){
            $query = "SELECT * FROM tbl_admin WHERE adminId = '$adminid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function changePassword($adminid, $pass){
           $query = "SELECT * FROM tbl_admin WHERE adminId = '$adminid'";
            $resutl = $this->db->select($query)->fetch_assoc();
            $password = $resutl['adminPass'];
            $oldpass = md5(mysqli_real_escape_string($this->db->link, $pass['oldpass']));
            $newpass = md5(mysqli_real_escape_string($this->db->link, $pass['newpass']));
            if($oldpass == $password){
                $query = "UPDATE tbl_admin SET adminPass = '$newpass' WHERE adminId = '$adminid'";
                $resutl = $this->db->update($query);
                if($resutl){
                    $msg = "<span class='success'>Password Successfully Changed..!!</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Failed to Changed Password..!!</span>";
                    return $msg;
                }
            }else{
                $msg = "<span class='error'>Old Password Dosn't Match...!!!</span>";
                return $msg;
            }
            
        }
    }