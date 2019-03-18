<!-- New_product area   -->
		<div class="container">
			<div class="row">
				<div class="feature_product">
					<h2>New PRODUCTS</h2>
				</div>	
			</div>
		</div>
		<!-- New_product ends   -->
		
		<!-- product area   -->
		<div class="product_area">
			<div class="container">
				<div class="row">
                                    <?php 
                                        $getNpd = $pd->getNewProduct();
                                        if($getNpd){
                                            while ($result = $getNpd->fetch_assoc()){
                                    ?>
                                        <div class="col-md-3">
                                                <div class="upper_product">
                                                    <a href="details.php?proid=<?php echo $result['productId']; ?>">
                                                       <img width="230px" height="120px" src="admin/<?php echo $result['image']; ?>" alt="" />
                                                    </a>
                                                    <h2><?php echo $result['productName']; ?></h2>
                                                    <h5><?php echo $fm->textShorten($result['body'], 40); ?></h5>
                                                    <h4><?php echo $result['price']; ?></h4>
                                                    <a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a>
						</div>
					</div>
                                    
                                    <?php
                                            } 
                                        }
                                    ?>
                                    
				</div>
			</div>
		</div>	<!-- product ends   -->