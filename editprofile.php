<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
    }
?>
<?php 
    $editid = Session::get('cusID');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updatepro = $ur->updateProfile($_POST, $editid);
    }
?>
<?php
    $cusid = Session::get('cusID');
    $getData = $ur->getCustomerProfile($cusid);
        if($getData){
            while ($result = $getData->fetch_assoc()){
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <form action="" method="post">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <?php
                                        if(isset($updatepro)){
                                            echo '<tr><th colspan="2"><h3></h3>'.$updatepro.'</th></tr>';
                                        }
                                    ?>
                                <tr>
                                    <th colspan="2"><h3>Update Profile</h3></th>
                                </tr>
                                <tr>
                                    <th>Name </th>
                                    <td>: <input type="text" name="name" value="<?php echo $result['name']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Address </th>
                                    <td>: <input type="text" name="address" value="<?php echo $result['address']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>City </th>
                                    <td>: <input type="text" name="city" value="<?php echo $result['city']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Country </th>
                                    <td>: <input type="text" name="country" value="<?php echo $result['country']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Zip Code </th>
                                    <td>: <input type="text" name="zipcode" value="<?php echo $result['zipcode']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Phone </th>
                                    <td>: <input type="text" name="phone" value="<?php echo $result['phone']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th>Email </th>
                                    <td>: <input type="text" name="email" value="<?php echo $result['email']; ?>"/></td>
                                </tr>
                            </tbody>
                        </table>
                        <div align="center" class="edtpro">
                            <input class="btn btn-primary" type="submit" name="submit" value="Update" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
            }
        }
?>
<?php include 'inc/footer.php'; ?>