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
        <div class="ticker">
            <div class="list-wrpaaer">
                <ul id="marquee-horizontal">
                    
<?php foreach ($cryptocoins as $coin_key => $coin_value) {?>
                <li class="list-item" id="<?php echo $coin_value->Symbol ?>">
                    <div class="list-item-currency"><?php echo $coin_value->Symbol ?></div>
                    <div class="list-item-currency upgrade">
                        <span></span>
                    </div>
                </li>

<?php  } ?>

                </ul>
            </div>
        </div>

        <!-- /.End of tricker -->
        <div class="blog_wrapper">
            <div class="container">
                <div class="row">
                    <main class="col-sm-8">
                        <?php
                            foreach ($advertisement as $add_key => $add_value) { 
                                $ad_position   = $add_value->serial_position;
                                $ad_link       = $add_value->url;
                                $ad_script     = $add_value->script;
                                $ad_image      = $add_value->image;
                                $ad_name      = $add_value->name;
                        ?>

                        <?php if (@$ad_position==3) { ?>
                            <div class="widget_banner">
                                <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                                <?php } else { echo $ad_script; } ?>
                            </div><!-- /.End of banner -->
                        <?php } } ?>

<?php  
    foreach ($news as $news_key => $news_value) {
        $article_id         =   $news_value->article_id;
        $cat_id             =   $news_value->cat_id;
        $slug               =   $news_value->slug;
        $news_headline      =   isset($lang) && $lang =="french"?$news_value->headline_fr:$news_value->headline_en;
        $news_article1      =   isset($lang) && $lang =="french"?$news_value->article1_fr:$news_value->article1_en;
        $news_article_image =   $news_value->article_image;
        $publish_date       =   $news_value->publish_date;

        $cat_slug = $this->db->select("slug, cat_name_en, cat_name_fr")->from('web_category')->where('cat_id', $cat_id)->get()->row();
        $cat_name      =   isset($lang) && $lang =="french"?$cat_slug->cat_name_fr:$cat_slug->cat_name_en;
?>
                        <div class="post post_list post_list_lg">
                            <div class="post_img">
                                <a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><img src="<?php echo base_url($news_article_image); ?>" alt="<?php echo strip_tags($news_headline); ?>"></a>
                            </div>
                            <div class="post_body">
                                <div class="post-cat"><a href="<?php echo base_url('news/'.$cat_slug->slug); ?>"><?php echo $cat_name ?></a></div>
                                <h3 class="post_heading"><a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><?php echo strip_tags($news_headline); ?></a></h3>
                                <p><?php echo substr(strip_tags($news_article1), 0, 110); ?></p>
                                <div class="post_meta">
                                    <span class="post_date">
                                        <i class="fa fa-calendar-o"></i>
                                        <time datetime="<?php echo $publish_date ?>">
                                            <?php
                                                $date=date_create($publish_date);
                                                echo date_format($date,"jS, F Y");
                                            ?>                                            
                                        </time>
                                    </span>
                                </div>
                            </div>
                        </div><!-- /.End of post list -->


<?php

    }

?>
                        <?php echo $links; ?>
                        <!-- /.End of pagination -->


                        <?php
                            foreach ($advertisement as $add_key => $add_value) { 
                                $ad_position   = $add_value->serial_position;
                                $ad_link       = $add_value->url;
                                $ad_script     = $add_value->script;
                                $ad_image      = $add_value->image;
                                $ad_name      = $add_value->name;
                        ?>

                        <?php if (@$ad_position==4) { ?>
                            <div class="widget_banner">
                                <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                                <?php } else { echo $ad_script; } ?>
                            </div><!-- /.End of banner -->
                        <?php } } ?>

                    </main>
                    <?php echo (!empty($content)?$content:null) ?>
                </div>
            </div>
        </div>
        <!-- /.End of page content -->