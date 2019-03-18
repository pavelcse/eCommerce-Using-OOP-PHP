<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/AdminLogin.php';
    $admin    = new AdminLogin();
    $userid = Session::get('adminId');
?>       
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $updateAdmin = $admin->adminProfileUpdate($userid, $_POST);
                if($updateAdmin){
                    echo $updateAdmin;
                }     
            }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    <?php
                        $adminProfile = $admin->adminProfile($userid);
                        if($adminProfile){
                            while ($user_result = $adminProfile->fetch_assoc()){
                    ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="adminName" value="<?php echo $user_result['adminName']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>UserName</label>
                        </td>
                        <td>
                            <input type="text" name="adminUser" value="<?php echo $user_result['adminUser']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="adminEmail" value="<?php echo $user_result['adminEmail']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Details</label>
                        </td>
                        <td>
                            <select name="adminLevel" id="select">
                                <option>
                                    <?php
                                        if($user_result['adminLevel'] == 0){
                                            echo 'Admin';
                                        }
                                        if($user_result['adminLevel'] == 1){
                                            echo 'Editor';
                                        }
                                        if($user_result['adminLevel'] == 3){
                                            echo 'Authore';
                                        }
                                    ?>
                                </option>
                            </select>
                        </td>
                    </tr> 
                    <?php
                        }
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update Profile" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>