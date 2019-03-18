<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == false){
        header('location: login.php');
    }
?>
<style>
    .payment{width: 500px; min-height: 300px; text-align: center; margin: 0 auto; border: 1px solid #ddd;padding: 50px;}
    .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
    .payment p{text-align: left; line-height: 25px; font-size: 18px;}
</style>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="payment">
                    <h2>Payment Confirmation</h2>
                    <?php 
                        $customerID = Session::get('cusID');
                        $ammount = $ct->payableAmount($customerID);
                        if($ammount){
                            $total = 0;
                            while ($result = $ammount->fetch_assoc()){
                                $price = $result['price'];
                                $total = $total + $price;
                            }
                        } else {
                            echo '<h1 style="color: red">Sorry, No Order...!!!</h1>';
                        }
                        if($total){
                    ?>  <p>Total Payable Amount (Including Vat) : TK 
                            <?php
                                $vat = $total * 0.1;
                                $totalAmmount = $vat + $total;
                                echo $totalAmmount;
                            ?>
                        </p>
                        <p>Thank You for Purchase. Received Your Order Successfully. We Will Contract You As Soon As Possible With Delivery Details.</p> 
                        <?php 
                            } 
                        ?>
                        <p>Here Your Order Details... <a href="order.php">Click Here</a></p>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>