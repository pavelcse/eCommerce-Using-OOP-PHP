<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Slider {
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function getSlider(){
            $query = "SELECT * FROM tbl_slider ORDER BY id DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getFrontSlider(){
            $query = "SELECT * FROM tbl_slider ORDER BY id ASC LIMIT 3";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function addSlider($data, $files){
            $title = $this->fm->validation($data['title']);
            $title = mysqli_real_escape_string($this->db->link, $title);
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['slider']['name'];
            $file_size = $files['slider']['size'];
            $file_temp = $files['slider']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            
            if(empty($title) || empty($file_name)){
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
                $query = "INSERT INTO tbl_slider (title, slider) VALUES ('$title', '$uploaded_image')";
                $resutl = $this->db->insert($query);
                if($resutl){
                    $msg = "<span class='success'>Data successfuly Inserted...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                } 
            }
            
            
        }
        
        public function sliderDelete($delid){
            $delquery = "SELECT * FROM tbl_slider WHERE id='$delid'";
            $delresult = $this->db->select($delquery);
            if($delresult){
                while ($delimg = $delresult->fetch_assoc()){
                    $img = $delimg['slider'];
                    unlink($img);
                }
            }
            
            $query = "DELETE FROM tbl_slider WHERE id='$delid'";
            $resutl = $this->db->delete($query);
            if($resutl){
                $msg = "<span class='success'>Slider Deleted successfuly...</span>";
                    return $msg;
                }else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
        }
        
       
}



