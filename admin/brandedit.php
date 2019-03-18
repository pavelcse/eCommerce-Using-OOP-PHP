<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Brand.php'; ?>
<?php
    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo '<script>window.location = "brandlist.php"; </script>';
    } else {
        //$brandid = $_GET['brandid'];
        $brandid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
    }
 ?>   
 <?php
    $brand = new Brand();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $brandEdit = $brand->editBrand($brandName, $brandid);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($brandEdit)){
                        echo $brandEdit;
                    }
                ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <?php
                                $brandList = $brand->showBrandById($brandid);
                                if($brandList){                                                    
                                    while ($result = $brandList->fetch_assoc()){
                                ?>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                            <?php    
                                    }
                                }
                            ?>
                        </tr>
			<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
