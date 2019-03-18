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
    .prev{width: 300px; text-align: center; margin: 0 auto;}
    .prev a{margin: 10px}
</style>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="payment">
                    <h2>Chose Payment Option</h2>
                    <a class="btn btn-primary" href="payonline.php">Online Payment</a>
                    <a class="btn btn-primary" href="payoffline.php">Offline Payment</a>
                </div>
                <div class="prev">
                    <a class="btn btn-info" href="cart.php">Previous</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>