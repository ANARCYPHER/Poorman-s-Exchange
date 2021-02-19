<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
        <div class="page_header" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1><?php echo $cat_title1; ?></h1>
                                <p><?php echo $cat_title2; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->
        <div class="pricing">

            <?php 
                if($package!=NULL){ 
                $i=1;
                foreach ($package as $key => $value) {  
            ?>
            <div class="pricing_item">
                <h3 class="pricing_title"><?php echo $value->package_name;?></h3>
                <p class="pricing_sentence"><?php echo $value->package_deatils;?></p>
                <div class="pricing_price"><span class="pricing_currency">$</span><?php echo $value->package_amount;?><span class="pricing_period">/ <?php echo $value->period;?> days</span></div>
                <ul class="pricing_feature-list">
                    <li class="pricing_feature"><?php echo display('period');?> <span> <?php echo $value->period;?> days</span></li>
                    <li class="pricing_feature"><?php echo display('yearly_roi');?><span> $<?php echo $value->yearly_roi;?></span></li>
                    <li class="pricing_feature"><?php echo display('monthly_roi');?> <span> $<?php echo $value->monthly_roi;?></span></li>
                    <li class="pricing_feature"><?php echo display('weekly_roi');?> <span> $<?php echo $value->weekly_roi;?></span></li>
                    <li class="pricing_feature"><?php echo display('daily_roi');?> <span> $<?php echo $value->daily_roi;?></span></li>
                </ul>
                <a class="pricing_action" href="<?php echo base_url('customer/package/confirm_package/'.$value->package_id);?>" aria-label="Purchase this plan"><span class="icon lnr lnr-arrow-right"></span></a>
            </div>

            <?php } }?>
           
        </div>
        <!-- /.End of pricing -->