<?php include 'inc/header.php'; ?>
    <div class="prev_area">
        <div class="container">
            <div class="row">
                <?php
                    if (isset($_GET['proid'])){ 
                        $proid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
                    }
                ?> 
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                        $quantity = $_POST['quantity'];
                        $addCart = $ct->addToCart($quantity, $proid);
                    }
                ?>
                <?php
                    $cusID = Session::get("cusID");
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
                        $productid = $_POST['productId'];
                        $insertCompare = $pd->compareData($cusID, $productid);
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['white'])){
                        $addWhite = $pd->addToWhite($proid, $cusID);
                    }
                ?> 
                <?php
                    $getpro = $pd->getSingleProduct($proid);
                    if($getpro){
                        while ($result = $getpro->fetch_assoc()){
                ?>
                <div class="col-md-8 product-desc">
                    <div class="col-md-12">
                        <div style="margin-top: 20px;" class="col-md-6">
                            <img width="340px" height="260px" src="admin/<?php echo $result['image']; ?>" alt="" /> 
                        </div>    
                        <div class="col-md-6">
                            <h2><?php echo $result['productName']; ?></h2>
                            <style>
                                table {margin-left: 15px;}
                                table tr{}
                                table tr td{padding: 5px 0px;}
                            </style>
                            <table>
                                <tr>
                                    <td>Price </td>
                                    <td>: <b><?php echo $result['price']; ?></b></td>
                                </tr>
                                 <tr>
                                    <td>Category </td>
                                    <td>: <b><?php echo $result['catName']; ?></b></td>
                                </tr>
                                 <tr>
                                    <td>Brand </td>
                                    <td>: <b><?php echo $result['brandName']; ?></b></td>
                                </tr>
                                
                            </table>
                            <form action="" method="post">
                                <div class="col-xs-6">
                                    <input class="form-control" type="number" name="quantity" value="1" />
                                </div>
                                <input class="btn btn-primary" type="submit" name="submit"  value="Buy Now" />
                            </form>
                            <div style="margin-top: 10px" class="col-xs-8">
                                <span style="color:red;"> 
                                    <b>
                                        <?php
                                            if(isset($addCart)){
                                             echo $addCart;   
                                            }
                                        ?>
                                    </b>
                                </span>
                            </div>
                            <div class="col-xs-12">
                                <?php
                                    $user = Session::get('cuslogin');
                                    if($user == true){

                                    if(isset($insertCompare)){
                                     echo $insertCompare;   
                                    }

                                    if(isset($addWhite)){
                                     echo $addWhite;   
                                    }
                                ?>
                                <div style="margin-left: -15px;" class="col-xs-6">
                                    <form action="" method="post">
                                        <input type="hidden" name="productId" value="<?php echo $result['productId']; ?>" />
                                        <input class="btn btn-primary" type="submit" name="compare" value="Compare Product"/>
                                    </form>
                                </div>
                                <div class="col-xs-6">
                                    <form action="" method="post">
                                        <input class="btn btn-primary" type="submit" name="white" value="Add to List"/>
                                    </form>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2>Products Details</h2>
                        <p><?php echo $result['body']; ?></p>
                    </div>
                </div> 
                <?php
                        }
                    }
                ?>
                <div class="col-md-4">
                    <h2>Category</h2>
                    <ul class="list-group list-group-flush">
                        <?php
                            $getcat = $cat->showCategory();
                            if($getcat){
                                while ($result = $getcat->fetch_assoc()){
                        ?>
                        <li class="list-group-item"><a href="category-product.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>	<!-- Slider area ends   -->
<?php include 'inc/footer.php'; ?>