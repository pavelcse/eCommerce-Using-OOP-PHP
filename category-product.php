<?php include 'inc/header.php'; ?>
<?php 
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
     header('location: 404.php');
   }else{
      $catid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
   }
?>
	<div class="container">
		<div class="row">
			<div class="brand_product">
                                <h2><span>Latest From Category</span></h2>
			</div>
		</div>
	</div>	
		<!-- product area   -->
	<div class="product_area">
		<div class="container">
			<div class="row">
                <?php 
                    $getCpd = $pd->getProductByCat($catid);
                    if($getCpd){
                        while ($result = $getCpd->fetch_assoc()){
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
	</div>	<!-- product ends   -->
<?php include 'inc/footer.php'; ?>