<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
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
                <div class="">
                    <div class="profile">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th colspan="2"><h3>Profile Details</h3></th>
                                </tr>
                                <tr>
                                    <th>Name </th>
                                    <td>: <?php echo $result['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Address </th>
                                    <td>: <?php echo $result['address']; ?></td>
                                </tr>
                                <tr>
                                    <th>City </th>
                                    <td>: <?php echo $result['city']; ?></td>
                                </tr>
                                <tr>
                                    <th>Country </th>
                                    <td>: <?php echo $result['country']; ?></td>
                                </tr>
                                <tr>
                                    <th>Zip Code </th>
                                    <td>: <?php echo $result['zipcode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone </th>
                                    <td>: <?php echo $result['phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email </th>
                                    <td>: <?php echo $result['email']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div align="center" class="edtpro">
                            <a class="btn btn-primary" href="editprofile.php">Update Your Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
            }
        }
?>
<?php include 'inc/footer.php'; ?>