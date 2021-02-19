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
if ($article) {

    foreach ($article as $key => $value) {
        $headline     =   isset($lang) && $lang =="french"?$value->headline_fr:$value->headline_en;
        $article1     =   isset($lang) && $lang =="french"?$value->article1_fr:$value->article1_en;
        $article2     =   isset($lang) && $lang =="french"?$value->article2_fr:$value->article2_en;
        $article_image=   $value->article_image;

    }

?>

        <div class="about_content">
            <div class="container">
                <div class="row about-text justify-content">
                    <div class="col-md-12">
                        <h1><?php echo $headline; ?></h1>
                        <img src="<?php echo base_url($article_image); ?>" alt="<?php echo strip_tags($headline); ?>">
                        <?php echo $article1; ?>
                        <?php echo $article2; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of about content -->
<?php } ?> 