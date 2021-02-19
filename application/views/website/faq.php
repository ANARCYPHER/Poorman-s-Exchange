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
        <div class="faq_content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="">
                            <ul class="accordion">
                                <?php 
                                    $i=1; 
                                    foreach ($article as $key => $value) { ?>
                                     <li>
                                        <a><?php echo isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en; ?></a>
                                        <p><?php echo isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en; ?></p>
                                    </li>
                                <?php $i++; } ?>                   
                            </ul>
                            <!-- / accordion -->                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of page content -->