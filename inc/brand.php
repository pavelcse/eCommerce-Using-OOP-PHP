
<!-- brand area   -->
		<div class="brand_area">
			<div class="container">
				<div class="row">
                                    <?php 
                                        $getbrand = $bd->showFrontBrand();
                                        if($getbrand){
                                            while ($result = $getbrand->fetch_assoc()){
                                    ?>
					<div class="col-md-2 brand_slide">
						<p><?php echo $result['brandName']; ?></p>
                                                <a class="btn btn-primary" href="brand-product.php?getbrand=<?php echo $result['brandId']; ?>">Shop Now</a>
					</div>
                                    <?php
                                            } 
                                        }
                                    ?>
                                        
				</div>
			</div>
		</div>	<!-- Slider area ends   -->