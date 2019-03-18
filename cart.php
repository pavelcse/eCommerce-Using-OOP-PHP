<?php include 'inc/header.php'; ?>
<?php
   if(isset($_GET['delpro'])){
       $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
       $deletePro = $ct->deleteFromCart($delId);
   } 
?>
<?php
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cartId = $_POST['cartId'];
        $Upquantity = $_POST['quantity'];
        $updareCart = $ct->updateCart($Upquantity, $cartId);
        if($Upquantity <= 0){
            $deletePro = $ct->deleteFromCart($cartId);
        }
    }
?>
<?php
    if(!isset($_GET['id'])){
        echo '<meta http-equiv="refresh" content="0;URL=?id=live" />';
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="border border-info">
                    <h2>Your Cart</h2>
                    <div class="table-responsive cart">
                        <div style="margin-top: 10px; margin-bottom: 10px;">
                            <?php
                                if(isset($updareCart)){
                                    echo $updareCart;
                                }
                                if(isset($deletePro)){
                                    echo $deletePro;
                                }
                            ?>
                        </div>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr style="background: #666666; color: white">
                                    <th width="5%" scope="col">#</th>
                                    <th width="30%" scope="col">Product Name</th>
                                    <th width="10%" scope="col">Image</th>
                                    <th width="10%" scope="col">Price</th>
                                    <th width="20%" scope="col">Quantity</th>
                                    <th width="15%" scope="col">Total Price</th>
                                    <th width="10%" scope="col">Action</th>
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
                                    <td><img style="width: 97px;height: 50px;" src="admin/<?php echo $result['image']; ?>" alt="NULL" /></td>
                                    <td>TK. <?php echo $result['price']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>" />
                                            <div class="form-group col-md-7">
                                                <input class="form-control" type="number" name="quantity" value="<?php echo $result['quantity']; ?>" />
                                            </div>
                                            <input class="btn btn-primary" type="submit" value="Update" />
                                        </form>
                                    </td>
                                    <td>TK. <?php echo $total = $result['quantity']*$result['price']; ?></td>
                                    <td>
                                        <a onclick="return confirm('Are you Sure to Delete');" class="form-control btn btn-danger" href="?delpro=<?php echo $result['cartId']; ?>">Delete</a>
                                    </td>
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
                    </div>
                    <div class="cart_price">
                        <?php
                            $getData = $ct->getCartTable();
                            if($getData){
                        ?>
                        
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <table class="table">
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
                                } else {
                                    echo "<div style='padding-bottom: 10px; color: red;' align='center'>You did't Shopping Yet. Please Shop Now</div>";
                                }
                            ?>
                        
                    </div>
                    <div class="cart_check">
                        <div class="col-md-4"></div>
                        <div align="center" class="col-md-4">
                            <a class="btn btn-info" href="index.php">Continue Shopping</a>
                            <a class="btn btn-success" href="payment.php">Checkout</a>
                        </div>
                        <div class="col-md-4"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>