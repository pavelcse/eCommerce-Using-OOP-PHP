<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../lib/Database.php");
    include_once ($filedir."/../helpers/Format.php");

    class Product{
        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new format();
        }
        
        public function addProduct($data, $files){
            $productName = $this->fm->validation($data['productName']);
            $productName = mysqli_real_escape_string($this->db->link, $productName);
            
            $catId       = $this->fm->validation($data['catId']);
            $catId       = mysqli_real_escape_string($this->db->link, $catId);
            
            $brandId     = $this->fm->validation($data['brandId']);
            $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
            
            $body        = mysqli_real_escape_string($this->db->link, $data['body']);
            
            $price       = $this->fm->validation($data['price']);
            $price       = mysqli_real_escape_string($this->db->link, $price);
            
            $type        = $this->fm->validation($data['type']);
            $type        = mysqli_real_escape_string($this->db->link, $type);  
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            
            if(empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($file_name) || empty($price) || empty($type)){
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
                $query = " INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
                $resutl = $this->db->insert($query);
                if($resutl){
                    $msg = "<span class='success'>Product added successfuly...</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function showProduct(){
//            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId ORDER BY tbl_product.productId DESC";
            // Same Code..............
            
            $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId = c.catId AND p.brandId = b.brandId ORDER BY p.productId DESC";
            
            // Same Code..............
            /*    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName "
                        . "FROM tbl_product "
                        . "INNER JOIN tbl_category "
                        . "ON tbl_product.catId = tbl_category.catId "
                        . "INNER JOIN tbl_brand "
                        . "ON tbl_product.brandId = tbl_brand.brandId "
                        . "ORDER BY tbl_product.productId DESC"; 
             
             */
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function showProductById($productid){
            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function editProduct($data, $files, $productid){
            $productName = $this->fm->validation($data['productName']);
            $productName = mysqli_real_escape_string($this->db->link, $productName);
            
            $catId       = $this->fm->validation($data['catId']);
            $catId       = mysqli_real_escape_string($this->db->link, $catId);
            
            $brandId     = $this->fm->validation($data['brandId']);
            $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
            
            $body        = mysqli_real_escape_string($this->db->link, $data['body']);
            
            $price       = $this->fm->validation($data['price']);
            $price       = mysqli_real_escape_string($this->db->link, $price);
            
            $type        = $this->fm->validation($data['type']);
            $type        = mysqli_real_escape_string($this->db->link, $type);  
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            
            if(empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($price) || empty($type)){
                $msg = "<span class='error'>Field must not be Empty...!</span>";
                return $msg;
            } else {
                if (!empty($file_name)){
                    if ($file_size >1048567) {
                        $msg = "<span class='error'>Image Size should be less then 1MB!
                        </span>";
                        return $msg;
                    } elseif (in_array($file_ext, $permited) === false) {
                        $msg = "<span class='error'>You can upload only:-"
                        .implode(', ', $permited)."</span>";
                        return $msg;
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = " UPDATE tbl_product SET productName = '$productName', catId = '$catId', brandId = '$brandId', body = '$body', price = '$price', image = '$uploaded_image', type = '$type' WHERE productId = '$productid'";
                        $resutl = $this->db->update($query);
                        if($resutl){
                            $msg = "<span class='success'>Product Uploded successfuly...</span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                            return $msg;
                        }
                    }
                } else {
                    $query = " UPDATE tbl_product SET productName = '$productName', catId = '$catId', brandId = '$brandId', body = '$body', price = '$price', type = '$type' WHERE productId = '$productid'";
                        $resutl = $this->db->update($query);
                        if($resutl){
                            $msg = "<span class='success'>Product Updated successfuly...</span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                            return $msg;
                        }
                }
            }
            
            
        }
        
        public function productDelete($delid){
            $delquery = "SELECT * FROM tbl_product WHERE productId='$delid'";
            $delresult = $this->db->select($delquery);
            if($delresult){
                while ($delimg = $delresult->fetch_assoc()){
                    $img = $delimg['image'];
                    unlink($img);
                }
            }
            
            $query = "DELETE FROM tbl_product WHERE productId='$delid'";
            $resutl = $this->db->delete($query);
            if($resutl){
                    $msg = "<span class='success'>Product Deleted successfuly...</span>";
                    return $msg;
                }else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
        }
        
        public function getFeaturedProduct(){
            $query = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 4";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getNewProduct(){
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 8";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getSingleProduct($proid){
            $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$proid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getBrandProduct($brandid) {
            $query = "SELECT * FROM tbl_product WHERE brandId='$brandid' ORDER BY productId DESC LIMIT 8";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function getProductByCat($catid){
            $catid = mysqli_real_escape_string($this->db->link, $catid);
            $query = "SELECT * FROM tbl_product WHERE catId = '$catid'";
            $resutl = $this->db->select($query);
            return $resutl;
        }
        
        public function compareData($cusID, $proid){
            $cusID       = mysqli_real_escape_string($this->db->link, $cusID);
            $proid       = mysqli_real_escape_string($this->db->link, $proid);
            
             $checkQuery = "SELECT * FROM tbl_compare WHERE productID='$proid' AND cusID = '$cusID'";
             $result = $this->db->select($checkQuery);
             if($result){
                 $msg = '<span class="error">Already Added</span>';
                 return $msg;
             }
            
            $query = "SELECT * FROM tbl_product WHERE productId='$proid'";
            $data = $this->db->select($query)->fetch_assoc();
            if($data){
                $productID = $data['productId'];
                $productName = $data['productName'];
                $price = $data['price'];
                $image = $data['image'];
                
                $query = "INSERT INTO tbl_compare (cusID, productID, productName, price, image) VALUES ('$cusID', '$productID', '$productName', '$price', '$image')";
                $insert_query = $this->db->insert($query);
                if($insert_query){
                    $msg = "<span class='success'>Product Added to Compare...</span>";
                    return $msg;
                }else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function compareProduct($customerID){
            $query = "SELECT * FROM tbl_compare WHERE cusID = '$customerID'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function DeleteAllCompare($custmrID){
            $query = "DELETE FROM tbl_compare WHERE cusID='$custmrID'";
            $resutl = $this->db->delete($query);
        }
        
        public function addToWhite($proid, $cusID){
            $cusID       = mysqli_real_escape_string($this->db->link, $cusID);
            $proid       = mysqli_real_escape_string($this->db->link, $proid);
            
            $checkwhite = "SELECT * FROM tbl_white WHERE productID='$proid' AND cusID = '$cusID'";
             $result = $this->db->select($checkwhite);
             if($result){
                 $msg = '<span class="error">Already Added to List</span>';
                 return $msg;
             }
            
            $query = "SELECT * FROM tbl_product WHERE productId='$proid'";
            $data = $this->db->select($query)->fetch_assoc();
            if($data){
                $productID = $data['productId'];
                $productName = $data['productName'];
                $price = $data['price'];
                $image = $data['image'];
                
                $query = "INSERT INTO tbl_white (cusId, productId, productName, price, image) VALUES ('$cusID', '$productID', '$productName', '$price', '$image')";
                $insert_query = $this->db->insert($query);
                if($insert_query){
                    $msg = "<span class='success'>Product Added to List...</span>";
                    return $msg;
                }else {
                    $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                    return $msg;
                }
            }
        }
        
        public function whiteProduct($customerID){
            $query = "SELECT * FROM tbl_white WHERE cusId = '$customerID'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function deleteFromList($delId, $customerID){
            $query = "DELETE FROM tbl_white WHERE productId='$delId' AND cusId = '$customerID'";
            $resutl = $this->db->delete($query);
            if($resutl){
                $msg = "<span class='success'>Remove from List...</span>";
                return $msg;
            }else {
                $msg = "<span class='error'>Something wrong!!! Please try again.</span>";
                return $msg;
            }
        }
    }


