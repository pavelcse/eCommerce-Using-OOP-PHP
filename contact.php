<?php include 'inc/header.php'; ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $sendMessage = $ur->sendMessage($_POST);
    }
?>
    <div class="cart_area">
        <div class="container">
            <div class="row">
                <div class="contact">
                    <div class="support col-md-12">
                        <h1>Live Support</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                       </p>
                       <p>
                           It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                       </p>
                   </div>
                    <div class="form col-md-12">
                        <div class="cont-form col-md-8">
                            <h4>Contact Us</h4>
                            <?php
                                if(isset($sendMessage)){
                                    echo $sendMessage;
                                }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="inputName" class="">Name :</label>
                                    <input type="text" class="form-control" id="inputName" name="name" required="" placeholder="Your Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="">Phone :</label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone" required="" placeholder="Your Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="">Email :</label>
                                    <input type="email" class="form-control" id="inputEmail" name="email" required="" placeholder="Your Email Address">
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage" class="">Message :</label>
                                    <textarea class="form-control" id="inputMessage" placeholder="Your Message" required="" name="message" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="SUBMIT">
                                </div>
                            </form>
                        </div>
                        <div class="info-form col-md-4">
                            <h4>Company Information : </h4>
                            <p>House: B-183, Road: 21</p>
                            <p>New DOHS, Mohakhali</p>
                            <p>Dhaka 1206</p>
                            <p>Phone: +88010000000</p>
                            <p>Tel : +8802 0000000</p>
                            <p>Email: me@backbenchers.org</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>