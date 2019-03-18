<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
  
    $filedir = realpath(dirname(__FILE__));
    include_once ($filedir."/../classes/Customer.php"); 

    if (!isset($_GET['cusid']) || $_GET['cusid'] == NULL){
        echo '<script>window.location = "inbox.php"; </script>';
    } else {
        $cusid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cusid']);
    }

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo '<script>window.location = "inbox.php"; </script>';
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 
                   <form action="" method="post">
                       <table style="text-align: left" class="form">					
                        <?php
                            $cus = new Customer();

                            $cusDtls = $cus->showCustomerById($cusid);
                            if($cusDtls){                                                    
                                while ($result = $cusDtls->fetch_assoc()){
                        ?>
                        <tr>
                            <th>Name</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <th>email</th>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
			<tr> 
                            <th></th>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                        <?php    
                                }
                            }
                        ?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
