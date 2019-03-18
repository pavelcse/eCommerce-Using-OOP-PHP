<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../classes/Cart.php");
    $ct = new Cart();
    $fm = new Format();
?>
<?php 
    if(isset($_GET['shifted'])){
        $id     = $_GET['shifted'];
        $price  = $_GET['price'];
        $time   = $_GET['time'];
        $shifted = $ct->shiftedProduct($id, $price, $time);
    }
    if(isset($_GET['delete'])){
        $id     = $_GET['delete'];
        $price  = $_GET['price'];
        $time   = $_GET['time'];
        $delete = $ct->delectShiftedProduct($id, $price, $time);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order List</h2>
                <?php 
                        if(isset($shifted)){
                            echo $shifted;
                        }
                        if(isset($delete)){
                            echo $delete;
                        }
                    ?>
                <div class="block">  
                    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
                                            <?php
                                                $data = $ct->getAllOrderProduct();
                                                if($data){
                                                    while ($result = $data->fetch_assoc()){    
                                            ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
                                                        <td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><?php echo $result['cusID']; ?></td>
                                                        <td><a href="customer.php?cusid=<?php echo $result['cusID']; ?>">View Details</a></td>
                                            <?php
                                                if($result['status'] == "0"){
                                            ?>
                                                    <td><a href="?shifted=<?php echo $result['cusID']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
                                            <?php
                                               }elseif ($result['status'] == "1") {
                                                   echo '<td>Pending</td>'; 
                                                }else {
                                            ?>
                                                    <td><a href="?delete=<?php echo $result['cusID']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Removed</a></td>
                                            <?php
                                                } 
                                                    }
                                                }
                                            ?>      
						</tr>                                            
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
