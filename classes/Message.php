<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Message{
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }

        
        public function showMessage(){
            $query = "SELECT * FROM tbl_message WHERE status='0' ORDER BY id DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showSeenMessage(){
            $query = "SELECT * FROM tbl_message WHERE status='1' ORDER BY id DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showMessageById($messageid){
            $query = "SELECT * FROM tbl_message WHERE id = '$messageid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function deleteMessage($deleteid){
            $query = "DELETE FROM tbl_message WHERE id='$deleteid'";
            $resutl = $this->db->delete($query);
            if($resutl){
                    $msg = "<span class='success'>Message Deleted successfuly...</span>";
                    return $msg;
                }else {
                    $catmsg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
        }
        
        public function seenMessage($msgid){
            $query = "UPDATE tbl_message SET status ='1' WHERE id = '$msgid' ";
            $seen = $this->db->update($query);
            if ($seen) {
                $msg = "<span class='success'>Message Seen..!!!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Something Seems Wrong...!!!</span>";
                return $msg;
            }
        }
        
        public function unSeenMessage($msgid){
            $query = "UPDATE tbl_message SET status ='0' WHERE id = '$msgid' ";
            $seen = $this->db->update($query);
            if ($seen) {
                $msg = "<span class='success'>Message Unseen..!!!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Something Seems Wrong...!!!</span>";
                return $msg;
            }
        }
        
        public function MessageSent(){

            $to         = mysqli_real_escape_string($this->db->link, $_POST['to']);
            $from       = mysqli_real_escape_string($this->db->link, $_POST['from']);
            $subject    = mysqli_real_escape_string($this->db->link, $_POST['subject']);
            $message    = mysqli_real_escape_string($this->db->link, $_POST['message']);


            $sendEmail = mail($to, $subject, $message, $from);
            if ($sendEmail) {
                echo "<script>alert('Message Sent Successfully...');</script>";
                //echo "<script>window.location = 'message.php'; </script>";
            }else{
                echo "<script>alert('Sorry, Message not Sent...!!!');</script>";
                echo "<script>window.location = 'message.php'; </script>";
            }
        }
        
    }

