<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/Slider.php'; ?>
<?php
    $sld = new Slider();
    
    if (isset($_GET['sliderdel'])){
        $delid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sliderdel']);
        $sliderDel = $sld->sliderDelete($delid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <?php
            if(isset($sliderDel)){
                echo $sliderDel;
            }
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Slider Title</th>
                        <th>Slider Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sliderList = $sld->getSlider();
                    if($sliderList){
                        $i=0;
                        while ($result = $sliderList->fetch_assoc()){
                           $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['title']; ?></td>
                        <td><img src="<?php echo $result['slider']; ?>" height="50px" width="100px"/></td>				
                        <td>
                            <a onclick="return confirm('Are you sure to Delete!');" href="?sliderdel=<?php echo $result['id']; ?>" >Delete</a> 
                        </td>
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
