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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                        foreach ($advertisement as $add_key => $add_value) { 
                            $ad_position   = $add_value->serial_position;
                            $ad_link       = $add_value->url;
                            $ad_script     = $add_value->script;
                            $ad_image      = $add_value->image;
                            $ad_name      = $add_value->name;
                    ?>

                    <?php if (@$ad_position==1) { ?>
                        <div class="widget_banner">
                            <?php if ($ad_script=="") { ?>
                            <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                            <?php } else { echo $ad_script; } ?>
                        </div><!-- /.End of banner -->
                    <?php } } ?>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="exchange-wrapper">
                        <iframe src="https://changelly.com/widget/v1?auth=email&from=BTC&to=ETH&merchant_id=&address=&amount=1&color=000066" class="changelly" scrolling="no"></iframe>  
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                        foreach ($advertisement as $add_key => $add_value) { 
                            $ad_position   = $add_value->serial_position;
                            $ad_link       = $add_value->url;
                            $ad_script     = $add_value->script;
                            $ad_image      = $add_value->image;
                            $ad_name      = $add_value->name;
                    ?>

                    <?php if (@$ad_position==2) { ?>
                        <div class="widget_banner">
                            <?php if ($ad_script=="") { ?>
                            <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                            <?php } else { echo $ad_script; } ?>
                        </div><!-- /.End of banner -->
                    <?php } } ?> 
                </div>
            </div>
        </div> 
        <!-- /.End of Exchange content -->