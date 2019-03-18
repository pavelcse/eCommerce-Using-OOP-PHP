<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Cart {
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function addToCart($quantity, $proid){
            $quantity  = $this->fm->validation($quantity);
            $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
            $productId = mysqli_real_escape_string($this->db->link, $proid);
            $sessionId = session_id();
            
            $pQuery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($pQuery)->fetch_assoc();
            $productName = $result['productName'];
            $price       = $result['price'];
            $image       = $result['image'];
            
            $chkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sessionId'";
            $getDpro = $this->db->select($chkQuery);
            if($getDpro){
                $msg = "Product Already Added...!";
                return $msg;
            }else{
            
                $query = "INSERT INTO tbl_cart (sId, productId, productName, price, quantity, image) VALUES('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";
                $resutl = $this->db->insert($query);
                if($resutl){
                    echo "<script> window.location = 'cart.php'; </script>";   
                } else {
                     echo "<script> window.location = 'cart.php'; </script>";    
                 }
             }
        }
        
        public function getCartProduct() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ORDER BY cartId DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function updateCart($Upquantity, $cartId) {
            $Upquantity  = mysqli_real_escape_string($this->db->link, $Upquantity);
            $cartId  = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE tbl_cart SET quantity = '$Upquantity' WHERE cartId = '$cartId'";
            $resutl = $this->db->update($query);
            if($resutl){
                echo "<script> window.location = 'cart.php'; </script>";  
            } else {
                $msg = "<span class='error'>Quantity Not Updated...!!!</span>";
                return $msg;
            }
        }
        
        public function deleteFromCart($delId){
            $delId  = mysqli_real_escape_string($this->db->link, $delId);
            $query = "DELETE FROM tbl_cart WHERE cartId = '$delId'";
            $resutl = $this->db->delete($query);
            if($resutl){
                header('location: cart.php');
            } else {
                $msg = "<span class='error'>Product Not Deleted...!!!</span>";
                return $msg;
            }
        }
        
        public function getCartTable() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
    
        public function DeleteAllCart() {
             $sId = session_id();
             $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
             $resutl = $this->db->delete($query);
        }
        
        public function comfirmOrder($customerID) {
            $sId = session_id();
            $getquery = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $getdtls = $this->db->select($getquery);
            if($getdtls){
                while ($result = $getdtls->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'] ;
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];
                    
                    $query = "INSERT INTO tbl_order (cusID, productId, productName, quantity, price, image) VALUES('$customerID', '$productId', '$productName', '$quantity', '$price', '$image')";
                $insert_order = $this->db->insert($query);
                
                }
            }
        }
        
        public function payableAmount($customerID){
            $query = "SELECT price FROM tbl_order WHERE cusId = '$customerID' AND date = now()";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getOrderProduct($customerID){
            $query = "SELECT * FROM tbl_order WHERE cusID = '$customerID' ORDER BY date DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function deleteFromOrder($delId){
            $delId  = mysqli_real_escape_string($this->db->link, $delId);
            $query = "DELETE FROM tbl_order WHERE id = '$delId'";
            $resutl = $this->db->delete($query);
            if($resutl){
                $msg = "<span class='success'>Order Deleted...!!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Deleted...!!!</span>";
                return $msg;
            }
        }
        
        public function getAllOrderProduct(){
            $query = "SELECT * FROM tbl_order ORDER BY date DESC";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function shiftedProduct($id, $price, $time){
            $id     = mysqli_real_escape_string($this->db->link, $id);
            $price  = mysqli_real_escape_string($this->db->link, $price);
            $time   = mysqli_real_escape_string($this->db->link, $time);
            
            $query = "UPDATE tbl_order SET status  = '1' WHERE cusID  = '$id' AND price = '$price' AND date = '$time'";
            $resutl = $this->db->update($query);
            if($resutl){
                $msg = "<span class='success'>Product Shifted...</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Shifted...!!!</span>";
                return $msg;
            }
        }
        
        public function delectShiftedProduct($id, $price, $time){
            $id     = mysqli_real_escape_string($this->db->link, $id);
            $price  = mysqli_real_escape_string($this->db->link, $price);
            $time   = mysqli_real_escape_string($this->db->link, $time);
            
            $query = "DELETE FROM tbl_order WHERE cusID  = '$id' AND price = '$price' AND date = '$time'";
            $resutl = $this->db->delete($query);
            if($resutl){
                $msg = "<span class='success'>Product Deleted...!!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Deleted...!!!</span>";
                return $msg;
            }
        }
        
        public function confirmShifted($id, $price, $time){
           $id     = mysqli_real_escape_string($this->db->link, $id);
           $price  = mysqli_real_escape_string($this->db->link, $price);
           $time   = mysqli_real_escape_string($this->db->link, $time);
            
            $query = "UPDATE tbl_order SET status  = '2' WHERE cusID  = '$id' AND price = '$price' AND date = '$time'";
            $resutl = $this->db->update($query);
            if($resutl){
                $msg = "<span class='success'>Product Shifted...</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Shifted...!!!</span>";
                return $msg;
            }
        }
}

