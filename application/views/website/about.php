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
<?php 
    $i=1; 
    foreach ($article as $key => $value) {
        $headline[]     =   isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en;
        $article1[]     =   isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
        $article2[]     =   isset($lang) && $lang =="french"?$value->article2_fr:$value->article2_en;
        $article_image[]=   $value->article_image;
        $article_video[]=   $value->video;

    $i++;

    }

?>
        <div class="about_content">
            <div class="container">
                <div class="row about-text justify-content">
                    <div class="col-md-6">
                        <div class="about-info">
                            <h2><?php echo @$headline[0]; ?></h2>
                            <div class="definition"><?php echo @$article1[0]; ?></div>
                            <?php echo @$article2[0]; ?>
                            <a href="<?php echo base_url("contact"); ?>" class="btn btn-default mr-20 mb-10"><?php echo display('contact_us'); ?></a>
                            <div class="play-button">
                                <a href="<?php echo @$article_video[0]; ?>" class="btn-play popup-youtube">
                                    <div class="play-icon"><i class="fa fa-play"></i></div>
                                    <div class="play-text">
                                        <div class="btn-title-inner">
                                            <div class="btn-title"><span><?php echo display('watch_video'); ?></span></div>
                                            <div class="btn-subtitle"><span><?php echo display('about_bitcoin'); ?></span></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <img src="<?php echo base_url(@$article_image[1]); ?>" class="img-responsive" alt="<?php echo strip_tags(@$headline[1]); ?>">
                        </div>
                        <div class="quote">
                            <?php echo @$article1[1]; ?>
                            <div class="author-address"><?php echo @$headline[1]; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of about content -->
        <div class="team__content">
            <div id="content__bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <section class="title_content">
                            <h2 class="content__title"><?php echo @$headline[2]; ?></h2>
                            <p class="content__description"><?php echo @$article1[2]; ?></p>
                        </section>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="row">

<?php 

    foreach ($team as $tea_key => $tea_value) {
        $tea_headline       =   $tea_value->headline_en;
        $tea_article1       =   isset($lang) && $lang =="french"?$tea_value->article1_fr:$tea_value->article1_en;
        $tea_article_image  =   $tea_value->article_image;
        $position_serial    =   $tea_value->position_serial;
?>
                            <div class="col-sm-4 team">
                                <h2 class="team__number">0<?php echo $position_serial; ?></h2>
                                <div class="team__member">
                                    <a href="#" class="team__member__img" style="background-image: url(<?php echo base_url($tea_article_image); ?>)"></a>
                                </div>
                                <div class="member__detail">
                                    <a href="#" class="member__title"><h4><?php echo $tea_headline; ?></h4></a>
                                    <p class="member__description"><?php echo $tea_article1; ?></p>
                                </div>
                            </div>
                            <!-- /.End of team -->
<?php

    }

?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of team content -->
        <div class="testimonial-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="section_title">
                            <h3><?php echo @$headline[3]; ?></h3>
                            <?php echo @$article1[3]; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-testimonial owl-carousel owl-theme">
                            
<?php

    foreach ($testimonial as $tes_key => $tes_value) {
        $tes_headline     =   $tes_value->headline_en;
        $tes_article1     =   $tes_value->article1_en;
        $tes_article2     =   $tes_value->article2_en;
        $tes_article_image=   $tes_value->article_image;

?>
                            <div class="testimonial-panel">
                                <div class="tes-quoteInfo">
                                    <img src="<?php echo base_url($tes_article_image); ?>" class="quoteAvatar" alt="<?php echo strip_tags($tes_headline); ?>">
                                    <div>
                                        <div class="quoteAuthor"><span><?php echo $tes_headline; ?></span></div>
                                        <div class="quotePosition">
                                            <span><?php echo $tes_article1; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial--body">
                                    <?php echo $tes_article2; ?>
                                </div>
                                <!-- /.testimonial-body end -->
                            </div>
<?php

    }

?>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="client-logo">

<?php
    foreach ($client as $cli_key => $cli_value) {
        $cli_headline     =   $cli_value->headline_en;
        $cli_article1     =   $cli_value->article1_en;
        $cli_article_image=   $cli_value->article_image;

?>
                            <div class="logo-item">
                                <a href="<?php echo $cli_article1; ?>" target="_blank"><img src="<?php echo base_url($cli_article_image); ?>" class="img-responsive" alt="<?php echo strip_tags($cli_headline); ?>"></a>
                            </div>
<?php

    }

?>


                        </div>
                        <!-- /.End of client logo -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of testimonial content -->