<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Category.php'; ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo '<script>window.location = "catlist.php"; </script>';
    } else {
        $catid = $_GET['catid'];
    }
 ?>   
 <?php
    $cat = new Category();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $catEdit = $cat->editCategory($catName, $catid);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($catEdit)){
                        echo $catEdit;
                    }
                ?>
                   <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <?php
                                $catList = $cat->showCategoryById($catid);
                                if($catList){                                                    
                                    while ($result = $catList->fetch_assoc()){
                                ?>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" placeholder="Enter Category Name..." class="medium" />
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
