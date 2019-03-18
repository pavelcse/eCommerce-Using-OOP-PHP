<!-- Slider area   -->
    <div class="container">
            <div class="row">
                    <div class="slider_area">
                           <div class="slider">
                            <?php
                                $getSlider = $sld->getFrontSlider();
                                    if($getSlider){
                                        while ($result = $getSlider->fetch_assoc()){
                            ?>   
                               <img class="mySlides" src="admin/<?php echo $result['slider'] ?>" style="width:1170px; height: 400px" alt="pavel">
                               
                            </div>
                            <?php 
                                        }
                                    }
                            ?>
                            <script>
                              var myIndex = 0;
                              carousel();

                              function carousel() {
                                  var i;
                                  var x = document.getElementsByClassName("mySlides");
                                  for (i = 0; i < x.length; i++) {
                                     x[i].style.display = "none";  
                                  }
                                  myIndex++;
                                  if (myIndex > x.length) {myIndex = 1}    
                                  x[myIndex-1].style.display = "block";  
                                  setTimeout(carousel, 2000); // Change image every 2 seconds
                              }
                            </script>
                    </div>
            </div>
    </div>
<!-- Slider area ends  -->
