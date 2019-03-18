<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
    }
?>
<?php
   if(isset($_GET['delpro'])){
       $delId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
       $deletePro = $ct->deleteFromOrder($delId);
   }
   
   if(isset($_GET['cusid'])){
        $id     = $_GET['cusid'];
        $price  = $_GET['price'];
        $time   = $_GET['time'];
        $shifted = $ct->confirmShifted($id, $price, $time);
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="border border-info">
                    <h1>Order List</h1>
                    <?php
                        if(isset($deletePro)){
                            echo $deletePro;
                        }
                    ?>
                    <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr style="background: #666666; color: white">
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                                            
                            <?php 
                                $customerID = Session::get('cusID');
                                $getpro = $ct->getOrderProduct($customerID);
                                if($getpro){
                                    $i = 0;
                                    while ($result = $getpro->fetch_assoc()){
                                        $i++;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $result['productName']; ?></td>
                                    <td><img style="width: 97px;height: 50px;" src="admin/<?php echo $result['image']; ?>" alt="NULL" /></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td>TK. <?php echo $result['price']; ?></td>
                                    <td><?php echo $fm->formatDate($result['date']); ?></td>
                                    <td>
                                        <?php
                                            if($result['status'] == "0"){
                                                echo 'Pending';
                                            }elseif($result['status'] == "1") {
                                                echo 'Shifted';
                                            }else{
                                                echo 'Success';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                       <?php
                                            if($result['status'] == "1"){
                                            ?>
                                            <a href="?cusid=<?php echo $result['cusID']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Confirm</a>
                                            <?php
                                            }elseif ($result['status'] == "2") {
                                                echo 'Success';         
                                            }else{
                                                echo 'N/A';
                                            }
                                       ?> 
                                    </td>
                                </tr>
                            </tbody>
                            <?php
                                    }
                                }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>