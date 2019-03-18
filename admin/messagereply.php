<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Message.php';
    include_once "../helpers/Format.php";
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sendmessage = $message->MessageSent();
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message</h2>
                <?php 
                    if(isset($sendmessage)){
                        echo $sendmessage;
                    }
                ?>
                <div class="block">               
                    <form action="" method="post">
                       <table class="form">
                        <?php 
                            $usermsg = $message->showMessageById($msgid);
                            if ($usermsg) {
                                $sl = 0;
                                while ($result = $usermsg->fetch_assoc()) {        
                        ?>
                           <tr>
                               <td>
                                   <label>To</label>
                               </td>
                               <td>
                                   <input type="text" readonly name="to" value="<?php echo $result['email']; ?> " class="medium" />
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   <label>From</label>
                               </td>
                               <td>
                                   <input type="text"  name="from" placeholder="Please enter your email here"  class="medium" />

                               </td>
                           </tr>
                           <tr>
                               <td>
                                   <label>Subject</label>
                               </td>
                               <td>
                                   <input type="text"  name="subject" placeholder="Please enter subject here"  class="medium" />
                               </td>
                           </tr>
                           <tr>
                               <td style="vertical-align: top; padding-top: 9px;">
                                   <label>Message</label>
                               </td>
                               <td>
                                   
                                   <textarea name="message" id="" cols="110" rows="10"></textarea>
                               </td>
                           </tr>
                           <tr>
                               <td></td>
                               <td>
                                   <input type="submit" name="submit" Value="Send" />
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