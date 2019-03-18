<?php include 'inc/header.php'; ?>
<?php 
    if(!isset($_GET['getbrand']) || $_GET['getbrand'] == NULL){
     header('location: 404.php');
   }else{
      $brandid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['getbrand']);
   }
?>
	<div class="container">
		<div class="row">
			<div class="brand_product">
                                <h2><span>Brand Product</span></h2>
			</div>
		</div>
	</div>	
		<!-- product area   -->
	<div class="product_area">
		<div class="container">
			<div class="row">
                <?php 
                    $getBpd = $pd->getBrandProduct($brandid);
                    if($getBpd){
                        while ($result = $getBpd->fetch_assoc()){
                ?>
                <div class="col-md-3">
                        <div class="upper_product">
                            <a href="details.php?proid=<?php echo $result['productId']; ?>">
                               <img width="230px" height="145px" src="admin/<?php echo $result['image']; ?>" alt="" />
                            </a>
                            <h2><?php echo $result['productName']; ?></h2>
                            <h5><?php echo $fm->textShorten($result['body'], 40); ?></h5>
                            <h4><?php echo $result['price']; ?></h4>
                            <a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a>
                    </div>
                </div>
                <?php
                        } 
                    } else {
                        echo '<div align="center" style="padding: 20px; color: red; font-style: bold"> Sorry, No Product Available at this Moment...!!!</div>';
                    }
                ?>
			</div>
		</div>
	</div>
<?php include 'inc/footer.php'; ?>