<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Category{
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }

        public function addCategory($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            
            if(empty($catName)){
                $catmsg = "<span class='error'>Category must not be Empty...!</span>";
                return $catmsg;
            } else {
                $query = " INSERT INTO tbl_category(catName) VALUES('$catName')";
                $resutl = $this->db->insert($query);
                if($resutl){
                    $catmsg = "<span class='success'>Category added successfuly...</span>";
                    return $catmsg;
                } else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $catmsg;
                }
            }
        }
        
        public function showCategory(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showCategoryForFooter(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC LIMIT 8";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showCategoryById($catid){
            $query = "SELECT * FROM tbl_category WHERE catId = '$catid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function editCategory($catName, $catid){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            
            if(empty($catName)){
                $catmsg = "<span class='error'>Category must not be Empty...!</span>";
                return $catmsg;
            } else {
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$catid'";
                $resutl = $this->db->update($query);
                if($resutl){
                    $catmsg = "<span class='success'>Category added successfuly...</span>";
                    return $catmsg;
                } else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $catmsg;
                }
            }
        }
        
        public function catDelete($delid){
            $query = "DELETE FROM tbl_category WHERE catId='$delid'";
            $resutl = $this->db->delete($query);
            if($resutl){
                    $catmsg = "<span class='success'>Category Deleted successfuly...</span>";
                    return $catmsg;
                }else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $catmsg;
                }
        }
    }
