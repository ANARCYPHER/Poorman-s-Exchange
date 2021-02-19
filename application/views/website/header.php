<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo ucwords($title).' - '.$settings->title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url($settings->favicon); ?>">
        <!-- style css -->
        <link href="<?php echo base_url('assets/website/css/style.css'); ?>" rel="stylesheet">
        <!-- Chart -->
        <link href="<?php echo base_url('assets/website/amcharts/export.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- /.End of loader wrapper-->
        <nav class="navbar navbar-default navbar-fixed navbar-transparent bootsnav">
            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->
            <div class="container">            
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <?php if($this->session->userdata('user_id')!=NULL){?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo display('account'); ?></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="<?php echo base_url('customer/home'); ?>"><?php echo display('dashboard'); ?></a></li>
                                <li><a href="<?php echo base_url('customer/auth/logout'); ?>"><?php echo display('logout'); ?></a></li>
                            </ul>
                        </li>
                        <?php } else{ ?>
                        <li><a href="<?php echo base_url('register'); ?>#tab2" class="btn nav-btn"><?php echo display('login'); ?></a></li>
                        <li><a href="<?php echo base_url('register'); ?>#tab1" class="btn nav-btn btn-orange"><?php echo display('sign_up'); ?></a></li>
                        <?php } ?>

                    </ul>
                </div>
                <!-- End Atribute Navigation -->
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url($settings->logo_web); ?>" class="logo" alt="<?php echo strip_tags($settings->title) ?>"></a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav" data-in="" data-out="">



<?php
                            foreach ($category as $cat_key => $cat_value) {                                
                                if ($cat_value->parent_id==0 && ($cat_value->menu==1 || $cat_value->menu==3)) {
                                    $cat_name = isset($lang) && $lang =="french"?$cat_value->cat_name_fr:$cat_value->cat_name_en;
                                    
?>
<?php
                                $where = "(status =1 OR status = 3)";
                                $child_cat = $this->db->select("cat_name_en,cat_name_fr,slug,menu")->from('web_category')->where('parent_id', $cat_value->cat_id)->where($where)->order_by('position_serial', 'asc')->get()->result();
?>
                                <li class="<?php echo ($this->uri->segment(1) == $cat_value->slug)?"active ":null ?><?php echo $child_cat?"dropdown":null ?>"><a <?php echo $child_cat?'href="#" class="dropdown-toggle" data-toggle="dropdown"':'href="'.base_url($cat_value->slug).'"'; ?>><?php echo $cat_name; ?></a>
<?php
                                if ($child_cat) { ?>

                                    <ul class="dropdown-menu">
<?php
                                    foreach ($child_cat as $chi_key => $chi_value) {
                                        if ($chi_value->menu==1 || $chi_value->menu==3) {
                                            $chi_cat_name = isset($lang) && $lang =="french"?$chi_value->cat_name_fr:$chi_value->cat_name_en;
?>
                                        <li class=""><a href="<?php echo base_url($chi_value->slug) ?>"><?php echo $chi_cat_name; ?></a></li>
<?php
                                        }
                                    }
?>
                                    </ul> 
<?php
                                }
?>
                                </li>

                        <?php
                                }
                            }
                        ?>
                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>    
        </nav>