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
    foreach ($article as $con_key => $con_value) {
        $con_headline[]     =   isset($lang) && $lang =="french"?$con_value->headline_fr:$con_value->headline_en;
        $con_address[]      =   $con_value->article1_en;
        $con_phone[]        =   $con_value->article1_fr;
        $con_officetime[]   =   $con_value->article2_en;

    $i++;

    }

?>

        <div class="contact_content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="row">
                            <div class="col-sm-5 p_r_40">
                                <h1 class="contact_title"><?php echo @$con_headline[0]; ?></h1>
                                <div class="contacts_info">                                    
                                    <div class="address">
                                        <p><?php echo @$con_address[0]; ?></p>
                                    </div>
                                    <div class="phone_fax">
                                        <?php echo @$con_phone[0]; ?>                                        
                                    </div>
                                    <?php echo @$con_officetime[0]; ?>                                    
                                </div>
                            </div>
                            <div class="col-sm-7 p_l_40">
                                <div class="map_widget">
                                    <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_open('home/contactMsg','id="contactForm"  class="contact_form" name="contactForm"'); ?>
                            <h1 class="contact_title">By email</h1>
                            <div class="form-group">
                                <label><?php echo display('name'); ?></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="f_name" name="f_name">
                                        <p class="help-block"><?php echo display('firstname'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="l_name" name="l_name">
                                        <p class="help-block"><?php echo display('lastname'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo display('company'); ?></label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label><?php echo display('email'); ?></label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="col-sm-6">
                                        <label><?php echo display('phone'); ?></label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo display('tell_us_about_your_project'); ?></label>
                                <textarea class="form-control" rows="7" id="comment" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default"><?php echo display('get_in_touch'); ?></button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of page content -->