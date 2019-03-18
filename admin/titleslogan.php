<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Front.php'; ?>
<?php
    $frn = new Front();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updatitle = $frn->updateTilte($_POST, $_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php 
            if(isset($updatitle)){
                echo $updatitle;
            }
        ?>
        <div class="block sloginblock">               
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php 
                        $getTitle = $frn->info();
                        if($getTitle){
                            while ($result = $getTitle->fetch_assoc()){
                    ?>
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Logo</label>
                        </td>
                        <td>
                            <img style="width: 200px" height="150px" src="<?php echo $result['logo'];?>" alt=""><br>
                            <input type="file" name="logo" class="medium" />
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>

                     <tr>
                        <td>
                        </td>
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