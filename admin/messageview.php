<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Message.php';
    include_once "../helpers/Format.php";
?>
<?php
    $message    = new Message();
    $fm         = new Format(); 
?>
<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'message.php'; </script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['inbox'])){
        echo "<script>window.location = 'message.php'; </script>";
        
    }
    elseif ($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['seen'])){

        $seen = $message->seenMessage($msgid);
            if ($seen) {
                echo "<script>window.location = 'message.php'; </script>";
            }else{
                echo "<span class='error'>Something Seems Wrong...!!!</span>";
            }
    }
    elseif ($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['replay'])){
        echo "<script>window.location = 'messagereply.php?msgid=$msgid'; </script>";
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message</h2>
                <div class="block">               
                    <form action="" method="post">
                        <table class="form">
                        <?php
                            $msg = $message->showMessageById($msgid); 
                            if ($msg) {
                                while ($result = $msg->fetch_assoc()) {       
                        ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <?php echo $result['name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Phone</label>
                            </td>
                            <td>
                                <?php echo $result['phone']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <?php echo $result['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <?php echo $fm->formatDate($result['date']); ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea cols="60" rows="10" readonly><?php echo $result['message']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="inbox" Value="Inbox" />
                                <input type="submit" name="seen" Value="Make it Seen" />
                                <input type="submit" name="replay" Value="Reply" />
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

    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

<?php
    include 'inc/footer.php';
?>