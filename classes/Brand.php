<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Brand{
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }

        public function addBrand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            if(empty($brandName)){
                $msg = "<span class='error'>Brand must not be Empty...!</span>";
                return $msg;
            } else {
                $query = " INSERT INTO tbl_brand(brandName) VALUES('$brandName'); ";
                $resutl = $this->db->insert($query);
                if($resutl){
                    $msg = "<span class='success'>Brand added successfuly...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function showBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showBrandById($brandid){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$brandid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function editBrand($brandName, $brandid){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            if(empty($brandName)){
                $msg = "<span class='error'>Brand must not be Empty...!</span>";
                return $msg;
            } else {
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$brandid'";
                $resutl = $this->db->update($query);
                if($resutl){
                    $msg = "<span class='success'>Brand added successfuly...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function brandDelete($delid){
            $query = "DELETE FROM tbl_brand WHERE brandId='$delid'";
            $resutl = $this->db->delete($query);
            if($resutl){
                    $msg = "<span class='success'>Brand Deleted successfuly...</span>";
                    return $msg;
                }else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
        }
        
        public function showFrontBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC LIMIT 6";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showFooterBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC LIMIT 8";
            $resutl = $this->db->select($query);
            return $resutl;
        }
    }

