<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Front.php'; ?>
<?php
    $frn = new Front();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateSocial = $frn->updateSocial($_POST);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php 
            if(isset($updateSocial)){
                echo $updateSocial;
            }
        ?>
        <div class="block">               
            <form action="" method="post">
                <table class="form">
                    <?php 
                        $getSocial = $frn->socialIcon();
                        if($getSocial){
                            while ($result = $getSocial->fetch_assoc()){
                    ?>
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['facebook']; ?>" name="facebook" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Twitter</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['twitter']; ?>" name="twitter"  class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Youtube</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['youtube']; ?>" name="youtube" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Google Plus</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['google']; ?>" name="googleplus" class="medium" />
                        </td>
                    </tr>
                    <?php
                            } 
                        }
                    ?>
                    <tr>
                        <td></td>
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