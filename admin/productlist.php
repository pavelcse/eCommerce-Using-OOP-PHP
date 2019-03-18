<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  
    include '../classes/Product.php'; 
    include_once '../helpers/Format.php';
    $product = new Product();
    $format = new Format();
?>
<?php
    if (isset($_GET['productdel'])){
        //$delid = $_GET['productdel'];
        $delid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productdel']);
        $productDel = $product->productDelete($delid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php 
            if(isset($productDel)){
                echo $productDel;
            }
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th> SL.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                                    <?php
                                        $pro = $product->showProduct();
                                        if($pro){
                                            $i = 0;
                                            while ($result = $pro->fetch_assoc()){
                                                $i++;
                                ?>
                                <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td class=""> <?php echo $result['catName']; ?></td>
					<td class=""> <?php echo $result['brandName']; ?></td>
					<td class="">
                                            <img height="50px" width="70px" src="<?php echo $result['image']; ?>" alt="" />
                                        </td>
					<td class=""> <?php echo $format->textShorten($result['body'], 100); ?></td>
                                        <td><?php echo $result['price']; ?></td>
                                        <td class=""> 
                                            <?php 
                                                if ($result['type'] == 1)
                                                echo "Featured";
                                            else {
                                                echo "General";
                                            }
                                            ?>
                                        </td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?productdel=<?php echo $result['productId']; ?>">Delete</a></td>
                                </tr>
                                <?php
                                            }
                                        }
                                    ?>
					
				
			</tbody>
		</table>
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
