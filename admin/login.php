<?php
    include '../classes/AdminLogin.php';
    Session::checkLogin();
    $al = new AdminLogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $adminUser = $_POST['adminUser'];
        $adminPass = $_POST['adminPass'];
        
        $checkLogin = $al->adminLogin($adminUser, $adminPass);
    } 
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
                        <span style="color:red; font-size: 18px;"> 
                            <?php
                                if(isset($checkLogin)){
                                   echo $checkLogin; 
                                }
                            ?>
                        </span> 
			<div>
                            <input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required=""  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
