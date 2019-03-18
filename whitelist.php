<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
    }
?>
<?php
   if(isset($_GET['delid'])){
       $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
       $deleteList = $pd->deleteFromList($delId, $customerID);
   } 
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="border border-info">
                    <h2>Your White List</h2>
                    <div class="table-responsive cart">
                        <?php 
                            if(isset($deleteList)){
                            echo $deleteList;   
                       }
                        ?>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr style="background: #666666; color: white">
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                                            
                            <?php
                                $whiteProduct = $pd->whiteProduct($customerID);
                                if($whiteProduct){
                                    $i = 0;
                                    while ($result = $whiteProduct->fetch_assoc()){
                                        $i++;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $result['productName']; ?></td>
                                    <td>TK. <?php echo $result['price']; ?></td>
                                    <td><img style="width: 150px;height: 120px;" src="admin/<?php echo $result['image']; ?>" alt="NULL" /></td>
                                    <td>
                                        <a href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a> ||
                                        <a href="?delid=<?php echo $result['productId']; ?>">Remove</a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart_check">
                        <div class="col-md-4"></div>
                        <div align="center" class="col-md-4">
                            <a class="btn btn-info" href="index.php">Continue Shopping</a>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>