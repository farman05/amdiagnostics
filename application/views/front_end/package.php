<div id="package" class="parallax section db" data-stellar-background-ratio="0.4" style="background:#fff;" data-scroll-id="doctors" tabindex="-1">
        <div class="container">
		
		<div class="heading">
               <span class="icon-logo"><img src="<?php echo base_url()?>assets/front_end/images/icon-logo.png" alt="#"></span>
               <h2>Packages</h2>
        </div>

            <div class="row dev-list text-center">
                <?php if(isset($package) && !empty($package)) { 
                        foreach ($package as $key => $value) {
                            # code...
                        
                    ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn " data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                    <div class="widget clearfix package-card">
                        <!-- <img src="<?php echo base_url()?>assets/front_end/images/doctor_01.jpg" alt="" class="img-responsive img-rounded"> -->
                        <div class="widget-title">
                            <h3><?php echo $value['name'];?></h3>
                            <small>Price - <span><?php echo $value['price']?></span></small>
                        </div>
                        <!-- end title -->
                        <p>Package includes the below test</p>

                        <div class="footer-social">
                            <ul>
                            <?php foreach ($value['test'] as $key1 => $value1) {
                                # code...
                            ?>
                            <li class = "package-test"><?php echo $value1;?></li>   
                            <?php }?>
                            </ul>
                        </div>
                    </div><!--widget -->
                </div><!-- end col -->
                <?php }  }?>       

            </div><!-- end row -->
        </div><!-- end container -->
        </div>