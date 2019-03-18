<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Message.php';
    //include_once "../helpers/Format.php";
?>
<?php
    $message    = new Message();
    $fm         = new Format(); 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
    <?php
        if (isset($_GET['seenid'])){
            $msgid = $_GET['seenid'];
            $seen = $message->seenMessage($msgid);
            if ($seen) {
                echo $seen;
            } 
        }
        if (isset($_GET['unseenid'])){
            $msgid = $_GET['unseenid'];
            $unseen = $message->unSeenMessage($msgid);
            if ($unseen) {
                echo $unseen;
            }
        }
        if (isset($_GET['deleteid'])){
            $deleteid = $_GET['deleteid'];
            $delete = $message->deleteMessage($deleteid);
            if ($delete) {
                echo $delete;
            }  
        }
    ?>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>phone</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $usermsg = $message->showMessage();
                    if ($usermsg) {
                        $sl = 0;
                        while ($result = $usermsg->fetch_assoc()) {  
                        $sl++;   	
                ?>
                    <tr class="odd gradeX">
                            <td><?php echo $sl ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['phone']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->formatDate($result['date']); ?></td>
                            <td><?php echo $fm->textShorten($result['message'], 30); ?></td>
                            <td>
                                <a href="messageview.php?msgid=<?php echo $result['id']; ?>">View</a> ||  
                                <a onclick = "return confirm('Are You Sure to Move?')" href="?seenid=<?php echo $result['id']; ?>">Seen</a> || 
                                <a href="messagereply.php?msgid=<?php echo $result['id']; ?>">Reply</a>
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

    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $usermsg = $message->showSeenMessage();
                    if ($usermsg) {
                        $sl = 0;
                        while ($result = $usermsg->fetch_assoc()) {  
                        $sl++; 
                ?>
                    <tr class="odd gradeX">
                            <td><?php echo $sl ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['phone']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->formatDate($result['date']); ?></td>
                            <td><?php echo $fm->textShorten($result['message'], 30); ?></td>
                            <td>
                                <a href="messageview.php?msgid=<?php echo $result['id']; ?>">View</a> || 
                                <a onclick = "return confirm('Are You Sure to Move?')" href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> || 
                                <a onclick = "return confirm('Are You Sure to Delete?')" href="?deleteid=<?php echo $result['id']; ?>">Delete</a>
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
<?php include 'inc/footer.php'; ?>