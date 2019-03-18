<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Front.php'; ?>
<?php
    $frn = new Front();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateCopyRight = $frn->updateCopyRight($_POST);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php 
            if(isset($updateCopyRight)){
                echo $updateCopyRight;
            }
        ?>
        <div class="block copyblock"> 
            <form action="" method="post">
            <table class="form">
                <?php 
                $getCopy = $frn->copyRight();
                if($getCopy){
                    while ($result = $getCopy->fetch_assoc()){
                ?>
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['copyright'];?>" placeholder="Enter Copyright Text..." name="copyright" class="large" />
                    </td>
                </tr>
                <?php
                    } 
                }
                ?>
				
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>