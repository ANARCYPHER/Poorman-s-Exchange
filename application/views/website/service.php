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
        <div class="service_content">
            <div class="container">
                <div class="row">

<?php 

    foreach ($article as $key => $value) { 
        $slug        = $value->slug;      
        $headline_en = isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en;      
        $article1_en = isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
        $article2_en = isset($lang) && $lang =="french"?$value->article2_fr:$value->article2_en;
        $icon        = $value->video;
?>


                    <div class="col-sm-6 col-md-4">
                        <div class="features-box">
                            <h3 class="features-title"><?php echo $headline_en; ?></h3>
                            <i class="<?php echo $icon ?>"></i>
                            <p><?php echo $article1_en; ?></p>
                            <a href="<?php echo base_url("service/$slug"); ?>" class="link-btn"><?php echo display('read_more'); ?> <span class="lnr lnr-chevron-right"></span></a>
                        </div>
                    </div>
<?php

    } 

?>

                </div>
            </div>
        </div>
        <!-- /.End of page content -->