<?php include 'inc/header.php'; ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])){
       $search = $_POST['search'];
        if (!isset($search) || $search == NULL) {
           echo "<script> window.location = '404.php'; </script>";
        }else{
            $search = $search;
        } 
    }else{
        echo "<script> window.location = '404.php'; </script>";
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
            <h1>Search Result</h1>
            <?php 
                 $searchvalue = $frn->getSearchValue($search);
                 if($searchvalue){
                     while ($result = $searchvalue->fetch_assoc()){
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
                 }else{
            ?>
                <div align="center">
                     <span style="text-align: center" class='error'>Sorry... No Data Found.</span>
                </div>
            <?php
                 }
            ?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>