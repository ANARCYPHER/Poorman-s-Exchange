<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;

$headline      =   isset($lang) && $lang =="french"?$service_details->headline_fr:$service_details->headline_en;
$article2      =   isset($lang) && $lang =="french"?$service_details->article2_fr:$service_details->article2_en;
$article_image =   $service_details->article_image;
$article_icon  =   $service_details->video;

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


                    <div class="col-sm-12 col-md-12">
                        <div class="features-box">
                            <h3 class="features-title"><?php echo $headline; ?></h3>
                            <i class="<?php echo $article_icon; ?>"></i>
                            <?php echo $article2; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.End of page content -->