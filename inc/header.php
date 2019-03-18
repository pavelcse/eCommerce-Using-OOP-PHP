<?php
    include_once ('lib/Session.php');
    Session::init();
    include_once ('lib/Database.php');
    include_once ('helpers/Format.php');
    
    spl_autoload_register(function($class) {
        include_once 'classes/'.$class.'.php';
    });
    
    $db = new Database();
    $fm = new Format();
    $pd = new Product();
    $cat = new Category();
    $ct = new Cart();
    $ur = new User();
    $bd = new Brand();
    $frn = new Front();
    $sld = new Slider();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
            <?php 
                $getTitle = $frn->info();
                if($getTitle){
                    while ($result = $getTitle->fetch_assoc()){
                        echo $result['title'];  
                    }
                }
            ?>
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="fonts/BebasNeueRegular.css">
        <link rel="stylesheet" href="css/slicknav.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="responsive.css">
        <!--slider-->
            <style>
                .slider {margin-top: 10px}
                .mySlides {display:none;}
            </style>
        <!--slider-->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <!--Start Header Area  -->
        <div class="header_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                            <div class="logo">
                                <?php 
                                    $getTitle = $frn->info();
                                    if($getTitle){
                                        while ($result = $getTitle->fetch_assoc()){
                                ?>
                                <a href="index.php"><img style="width: 150px" src="admin/<?php echo $result['logo']; ?>" alt="BackShop" /></a>
                                <?php 
                                        }
                                    }
                                ?>
                            </div>
                    </div>
                    <div style="margin-top: 7px;" class="col-md-5">
                            <div class="search">
                                <form action="searchresult.php" method="post">
                                    <div class="col-sm-10">
                                        <input type="text" name="search"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input style="width: 50px" type="image" src="img/search.png" alt="Search">
                                    </div>
                                </form>
                            </div>
                    </div>
                    <div style="margin-top: 7px;" class="col-md-2">
                            <div class="dollar_box">
                                <span title="View Shopping List" class="price">
                                    <?php
                                        $getData = $ct->getCartTable();
                                        if($getData){
                                            $sum = Session::get("sum");
                                            $qty = Session::get("qty");
                                            echo 'TK. '.$sum.'-('.$qty.')';
                                        } else {
                                            echo 'TK. 0';
                                        }
                                    ?>
                                </span>
                                <a title="View Shopping List" href="cart.php"><img src="img/dollar_box.png" alt="" /></a>
                            </div>
                    </div>
                    <?php 
                        if(isset($_GET['logout'])){
                            $custmrID = Session::get('cusID');
                            $delCart = $ct->DeleteAllCart();
                            $delComp = $pd->DeleteAllCompare($custmrID);
                            Session::destroy();
                        }
                    ?>
                    <div style="margin-top: 14px;" class="col-md-2">
                        <div class="dollar_box">
                            <img src="img/profile.png" alt="" />
                            <?php 
                                $login = Session::get('cuslogin');
                                if($login == false){
                            ?>
                            <a title="Client Login" href="login.php"><span style="padding: 0px 15px;color: #3CC2b4;font-weight: bold;font-size: 17px;text-decoration: null;">Login</span></a>
                            <?php
                                }else{
                            ?>
                            <a title="Client Logout" href="?logout=<?php Session::get('cusID'); ?>"><span style="padding: 0px 15px;color: #3CC2b4;font-weight: bold;font-size: 17px;text-decoration: null;">Logout</span></a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>	<!-- Header Ends -->
		
        <!-- Menu -->
        <div class="container">
            <div class="row">
                <div class="menu_area">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Products</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <?php 
                            $chkCart = $ct->getCartTable();
                            if($chkCart){
                                echo '<li><a href="payment.php">Payment</a></li>';
                            }
                        ?>
                        <?php
                            $user = Session::get('cuslogin');
                            if($user == true){
                                echo '<li><a href="profile.php">Profile</a></li>';
                                $customerID = Session::get("cusID");
                                $chkComp = $pd->compareProduct($customerID);
                                if($chkComp){
                                    echo '<li><a href="compare.php">Compare</a></li>';
                                } 
                                $chkwhite = $pd->whiteProduct($customerID);
                                if($chkwhite){
                                    echo '<li><a href="whitelist.php">White List</a></li>';
                                }  
                            }
                        ?>
                        <?php
                            $customerID = Session::get("cusID");
                            $orderList = $ct->getOrderProduct($customerID);
                            if($orderList){
                                echo '<li><a href="order.php">Order List</a></li>';
                            }
                        ?>
                        <li><a href="contact.php">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Menu Ends -->
