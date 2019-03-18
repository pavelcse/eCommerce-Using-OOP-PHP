<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Front {
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function socialIcon(){
            $query = "SELECT * FROM tbl_social";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function info(){
            $query = "SELECT * FROM tbl_title";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function copyRight(){
            $query = "SELECT * FROM tbl_copyright";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function updateCopyRight($data){
            $copyright = $this->fm->validation($data['copyright']);
            $copyright = mysqli_real_escape_string($this->db->link, $copyright);
            
            if(empty($copyright)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            } else {
                $query = "UPDATE tbl_copyright SET copyright = '$copyright' WHERE id = '1'";
                $resutl = $this->db->update($query);
                if($resutl){
                    $msg = "<span class='success'>Copy Right Title successfuly Updated...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function updateSocial($data){
            $facebook = $this->fm->validation($data['facebook']);
            $facebook = mysqli_real_escape_string($this->db->link, $facebook);
            $twitter = $this->fm->validation($data['twitter']);
            $twitter = mysqli_real_escape_string($this->db->link, $twitter);
            $youtube = $this->fm->validation($data['youtube']);
            $youtube = mysqli_real_escape_string($this->db->link, $youtube);
            $googleplus = $this->fm->validation($data['googleplus']);
            $googleplus = mysqli_real_escape_string($this->db->link, $googleplus);
            
            $query = "UPDATE tbl_social SET facebook = '$facebook', twitter = '$twitter', youtube = '$youtube', google = '$googleplus'  WHERE id = '1'";
            $resutl = $this->db->update($query);
            if($resutl){
                $msg = "<span class='success'>Social Link successfuly Updated...</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                return $msg;
            }
        }
        
        public function updateTilte($data, $files){
            $title = $this->fm->validation($data['title']);
            $title = mysqli_real_escape_string($this->db->link, $title);
            $slogan = $this->fm->validation($data['slogan']);
            $slogan = mysqli_real_escape_string($this->db->link, $slogan);
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['logo']['name'];
            $file_size = $files['logo']['size'];
            $file_temp = $files['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            
            if(empty($title) || empty($slogan) || empty($file_name)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            }elseif (empty($file_name)) {
                $msg = "<span class='error'>Please Select any Image !</span>";
                return $msg;
            }elseif ($file_size >1048567) {
                $msg = "<span class='error'>Image Size should be less then 1MB!
                </span>";
                return $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<span class='error'>You can upload only:-"
                .implode(', ', $permited)."</span>";
                return $msg;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
               $query = "UPDATE tbl_title SET title = '$title', slogan = '$slogan', logo = '$uploaded_image'  WHERE id = '1'";
                $resutl = $this->db->update($query);
                if($resutl){
                    $msg = "<span class='success'>Data successfuly Updated...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                } 
            }
        }
        
        public function getSearchValue($search){
            $search = mysqli_real_escape_string($this->db->link, $search);
            
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%'";
            $result = $this->db->select($query);
            return $result;
        }
        
       
}


