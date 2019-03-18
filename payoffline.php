<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
    }
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $customerID = Session::get('cusID');
        $confirmOrder = $ct->comfirmOrder($customerID);
        $delCart = $ct->DeleteAllCart();
        echo "<script> window.location = 'success.php'; </script>";  
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 order">
                    <div class="col-md-8 order-details">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr style="background: #666666; color: white">
                                    <th width="5%" scope="col">#</th>
                                    <th width="30%" scope="col">Product Name</th>
                                    <th width="15%" scope="col">Image</th>
                                    <th width="15%" scope="col">Price</th>
                                    <th width="20%" scope="col">Quantity</th>
                                    <th width="15%" scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>                                            
                            <?php 
                                $getpro = $ct->getCartProduct();
                                if($getpro){
                                    $i = 0;
                                    $sum = 0;
                                    $qty = 0;
                                    while ($result = $getpro->fetch_assoc()){
                                        $i++;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $result['productName']; ?></td>
                                    <td><img style="width: 100px;height: 50px;" src="admin/<?php echo $result['image']; ?>" alt="NULL" /></td>
                                    <td>TK. <?php echo $result['price']; ?></td>
                                    <td><?php echo $result['quantity']; ?>                                                </td>
                                    <td>TK. <?php echo $total = $result['quantity']*$result['price']; ?></td>
                                </tr>
                            <?php
                            $sum = $sum+$total;
                            $qty = $qty+$result['quantity'];
                            Session::set("sum",$sum);
                            Session::set("qty",$qty);
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                        <?php
                            $getData = $ct->getCartTable();
                            if($getData){
                        ?>
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <table class="table">
                                <tr>
                                    <td>Total Quantity</td>
                                    <td>: <?php echo $qty; ?></td>
                                </tr>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>: TK <?php echo $sum; ?></td>
                                </tr>
                                <tr>
                                    <td>Vat</td>
                                    <td>: 10%</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>: TK 
                                        <?php 
                                            $vat = $sum *0.1; 
                                            $gndTotal = $vat + $sum; 
                                            echo $gndTotal;
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <?php
                                }
                            ?> 
                    </div>
                    <div class="col-md-4 shipping-details">
                    <?php
                        $cusid = Session::get('cusID');
                        $getData = $ur->getCustomerProfile($cusid);
                        if($getData){
                            while ($result = $getData->fetch_assoc()){
                    ?>
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
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div align="center" class="col-md-12 conf-order">
                    <hr/>
                    <a class="btn btn-success" href="?orderid=order">Order Now</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>