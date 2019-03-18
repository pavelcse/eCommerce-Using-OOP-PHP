<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Product.php'; ?>
<?php  include '../classes/Category.php'; ?>
<?php  include '../classes/Brand.php'; ?>
<?php 
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL){
        echo '<script>window.location = "brandlist.php"; </script>';
    } else {
        //$brandid = $_GET['brandid'];
        $productid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
    }

    $product = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $editProduct = $product->editProduct($_POST, $_FILES, $productid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block"> 
            <?php 
                if(isset($editProduct)){
                    echo $editProduct;
                }
            ?>
            <?php
                $getProduct = $product->showProductById($productid);
                if($getProduct){
                    while ($result = $getProduct->fetch_assoc()){
            ?>
            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result['productName']; ?>" class="medium" required="" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select required="" id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                                $cat = new Category();
                                $getCat = $cat->showCategory();
                                if($getCat){
                                    while ($value = $getCat->fetch_assoc()){
                            ?>
                            <option 
                                <?php 
                                    if($result['catId'] == $value['catId']){
                                        echo 'selected=""';
                                    }
                                ?>
                                value="<?php echo $value['catId']; ?>">
                                <?php echo $value['catName']; ?>
                            </option>
                            <?php
                                    }
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select required="" id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php 
                                $brand = new Brand();
                                $getBrand = $brand->showBrand();
                                if($getBrand){
                                    while ($value = $getBrand->fetch_assoc()){
                            ?>
                            <option 
                                <?php 
                                    if($result['brandId'] == $value['brandId']){
                                        echo 'selected=""';
                                    }
                                ?>
                                value="<?php echo $value['brandId']; ?>">
                                <?php echo $value['brandName']; ?>
                            </option>
                            <?php
                                    }
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
				
		<tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" ><?php echo $result['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result['price']; ?>" class="medium" required="" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img height="120px" width="300px" src="<?php echo $result['image']; ?>" alt="" /> <br />
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type" required="">
                            <option>Select Type</option>
                            <?php 
                                if($result['type'] == 1){
                            ?>
                                <option selected="" value="1">Featured</option>
                                <option value="2">General</option>    
                            <?php
                                }else{
                            ?>
                                <option value="1">Featured</option>
                                <option selected="" value="2">General</option>
                            <?php
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


