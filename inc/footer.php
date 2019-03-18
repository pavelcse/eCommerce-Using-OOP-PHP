<!-- footer_top_area  -->	
        <div class="container">
            <div class="row">
                <div class="footer_top_area col-sm-12">
                    <div class="footer_top col-sm-3">
                        <h2>Latest Product</h2>
                        <ul>
                        <?php 
                            $getNpd = $pd->getNewProduct();
                            if($getNpd){
                                while ($result = $getNpd->fetch_assoc()){
                        ?>
                            <li><a href="preview.php?proid=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a></li>
                        <?php
                                } 
                            }
                        ?>
                        </ul>
                    </div>

                        <div class="footer_top col-sm-3">
                                <h2>Category</h2>
                                <ul>
                                <?php
                                    $getcat = $cat->showCategoryForFooter();
                                    if($getcat){
                                        while ($result = $getcat->fetch_assoc()){
                                ?>
                                        <li><a href="category-product.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
                                <?php
                                        }
                                    }
                                ?>
                                </ul>
                        </div>	
                        <div class="footer_top col-sm-3">
                                <h2>Top Brands</h2>
                                <ul>
                                <?php 
                                    $getbrand = $bd->showFooterBrand();
                                    if($getbrand){
                                        while ($result = $getbrand->fetch_assoc()){
                                ?>
                                        <li><a href="brand-product.php?getbrand=<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></a></li>
                                <?php
                                        } 
                                    }
                                ?>
                                </ul>
                        </div>	
                        <div class="footer_top col-sm-3">
                            <h2>Social Link</h2>
                            <?php 
                                $getSocial = $frn->socialIcon();
                                if($getSocial){
                                    while ($result = $getSocial->fetch_assoc()){
                            ?>
                                <a target="_blank" href="<?php echo $result['facebook']; ?>"><img style="width: 50px; margin: 0px 0px 10px 10px" src="img/fb.png" alt=""></a>
                                <a target="_blank" href="<?php echo $result['twitter']; ?>"><img style="width: 50px; margin: 0px 0px 10px 10px" src="img/tw.png" alt=""></a>
                                <a target="_blank" href="<?php echo $result['youtube']; ?>"><img style="width: 50px; margin: 0px 0px 10px 10px" src="img/yo.png" alt=""></a>
                                <a target="_blank" href="<?php echo $result['google']; ?>"><img style="width: 50px; margin: 0px 0px 10px 10px" src="img/gp.png" alt=""></a>
                            <?php
                                    } 
                                }
                            ?>
                        </div>
                </div>
        </div>
</div>	<!-- footer_top_area ends  -->


<!-- footer area  -->
<div class="footer_area">
        <p>Copyright &copy; by 
            <?php 
                $getCopy = $frn->copyRight();
                if($getCopy){
                    while ($result = $getCopy->fetch_assoc()){
                        echo $result['copyright'];
                    } 
                }
            ?>
        </p>

</div>	<!-- footer_area  ends  -->
		
		
		
		
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
         div.col-md-12e			(e,r)}(window,document,'script',          ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
   

        <script window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
