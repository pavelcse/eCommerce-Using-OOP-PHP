<?php include 'inc/header.php'; ?>
<?php
    $login = Session::get('cuslogin');
    if($login == true){
        header('location: order.php');
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row login_sec">
                <div class="col-md-4 form-group">
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
                            $userlogin = $ur->userLogin($_POST);
                        }
                ?>    
                   <h4>Existing Customers</h4>
                   <p>Sign in with the form below.</p>
                   <?php
                        if(isset($userlogin)){
                            echo $userlogin;
                        }
                    ?>
                   <form action="" method="post">
                       <input class="form-control" type="text" name="email" placeholder="Username" />
                        <input class="form-control" type="password" name="password" placeholder="Password" />
                        <input class="btn btn-primary" type="submit" name="login" value="Sign In" />
                    </form>
                   <p>Forgot your password? <a href="#">Click Here</a></p>
                </div>
                <div class="col-md-1">
                    <img src="img/vartical-line1.png" alt="" />
                </div>
                <div class="col-md-6 form-group">
                    <?php 
                        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])){
                            $newuser = $ur->createNewUser($_POST);
                        }
                    ?>
                    <h4>Register New Account</h4>
                    <?php
                        if(isset($newuser)){
                            echo $newuser;
                        }
                    ?>
                    <form action="" method="post">
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="city" placeholder="City">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="country" placeholder="Country">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="zipcode" placeholder="Zip-Code">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-xs-6">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="col-xs-3">
                            <input class="btn btn-primary" type="submit" name="create" value="Create account" />
                        </div>
                        <div class="col-xs-12">
                            <p>By clicking 'Create Account' you agree to the <a href="#">Terms & Conditions</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>