<?php 
    $settings = $this->db->select("*")
    ->get('setting')
    ->row();
?>
<script src="<?php echo base_url('assets/crypto/'); ?>cryptobox.js" crossorigin="anonymous"></script>
<!-- <?php //echo base_url()?>customer/home/payment JQuery Payment Box Script, see https://github.com/cryptoapi/Payment-Gateway/blob/master/cryptobox.js#L14 -->
<script> 
    var test = cryptobox_custom('<?php echo $jsurl->u1; ?>', <?php echo $jsurl->u2; ?>, '<?php echo $jsurl->u3;?>', 'gourl_', '<?php echo $jsurl->u4; ?>'); 
</script>

 <div class="container theme-showcase" role="main">
    
    <!-- Loading ... -->
    <div class="gourl_loader">
    
        <div class="container text-center gourl_loader_button">
        	<a style="margin:80px 20px 40px 20px" href="" class="btn btn-default btn-lg"><i class='fa fa-spinner fa-spin'></i> &#160; <?php echo $jsurl->coin_name?> Box Loading ...</a>
        </div>
        
        <div style="margin:70px;display:none" class="panel panel-danger gourl_cryptobox_error">
        
            <div class="panel-heading">
            	<h3 class="panel-title">Error !</h3>
            </div>
            
            <div class="panel-body">
            	<div class="gourl_error_message"></div>
            </div>
            
        </div>
        
    </div>


	
    <!-- Area above Payment Box -->
    
    <div class="gourl_cryptobox_top" style="display:none">	
    
        <div class="row">
            <!-- Box message -->
            <div class="col-xs-6 col-md-10">
                <?php echo $jsurl->message; ?>
            </div>


            <!-- Box Language -->
            <div class="col-xs-6 col-md-3">
                <div class="dropdown" style='margin-bottom:20px'>
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Language<?php  echo " &#160; <span class='small'>" . json_decode(CRYPTOBOX_LOCALISATION, true)[CRYPTOBOX_LANGUAGE]["name"] . "</span>"; ?>
                <span class="caret"></span></button>
                <?php  echo display_language_box("en", "gourlcryptolang", false); ?>
                </div>
            </div>
             
            <!-- Logo -->
            <div class="col-xs-6 col-md-3 gourl_boxlogo_paid" style="display:none">
                <div class='text-right'><img class='gourl_boxlogo' alt='logo' src='<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>'></div>
                <br>
            </div>
            
            <div class="col-xs-6 col-md-3 gourl_boxlogo_unpaid"  style="display:none">
                <div class='text-right'><img class='gourl_boxlogo' alt='logo' src='<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>'></div>
                <br>
            </div>
        </div>
    </div>        
    


    
    <!-- Crypto Payment Box -->
    
    <div class="gourl_cryptobox_unpaid" style="display:none">        
            

        <div class="row">   
            <div class="col-md-10">
                <div class="panel panel-primary">
            
                    <div class="panel-heading">
                        <h3 class="panel-title gourl_addr_title">2. <span class="gourl_texts_coin_address"></span></h3>
                    </div>
                    
                    <div class="panel-body">
                        <div style="float:right; margin-bottom:0px">
                        	<a class='gourl_wallet_url' href='#'>
                                <img class='gourl_qrcode_image' alt='qrcode' data-size='200' src='#'></a>
                        </div>

                        <div>
                            <ol>
                                <!-- <li class="gourl_texts_intro1"></li> -->
                                <li data-site="circle.com" data-url="https://www.circle.com/" class="gourl_texts_intro1b"></li>
                                <li class="gourl_texts_intro2"></li>
                                <li><b class="gourl_texts_intro3"></b></li>
                            </ol>
                        </div>
                        <br>
                        <div style="margin-left: 25px;">
                            <div class="gourl_texts_send"></div>
                            <br>
                           	<div><a class="gourl_addr gourl_wallet_url" href="#"></a> &#160; <a class="gourl_wallet_url gourl_wallet_open" href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col-md-5">
            
                <div class="panel panel-warning">
                    <div class="panel-heading">
                    	<h3 class="panel-title">3. <span class="gourl_paymentcaptcha_amount"></span></h3>
                    </div>
                    <div class="panel-body">
                    	<span class="gourl_amount"></span> <span class="gourl_coinlabel"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-5">   
                <div class="panel panel-success">
                    <div class="panel-heading">
                    	<h3 class="panel-title">4. <span class="gourl_paymentcaptcha_status"></span></h3>
                    </div>
                    <div class="panel-body">
                    	<div class="gourl_paymentcaptcha_statustext"></div>
                    </div>
                </div>
                
            </div>
            
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('customer/home/payment');?>
                
                    <input type="hidden" id="cryptobox_refresh_" name="cryptobox_refresh_" value="1">
                    
                    <input type="hidden" name="orderID" value="<?php echo $post_info->orderID;?>">
                    <input type="hidden" name="userID" value="<?php echo $post_info->userID;?>">
                    <input type="hidden" name="deposit_amount" value="<?php echo $post_info->amountUSD;?>">
                  
                    <button style="margin:10px 20px" class="gourl_button_refresh btn btn-default btn-lg"></button>
                    <button style="margin:10px 20px" class="gourl_button_wait btn btn-info btn-lg"></button>
                <?php echo form_close();?>
            
            </div>
            <div class="col-md-10">
                <div class="gourl_texts_btn_wait_hint"></div>
            </div>
        </div>
    
    </div>
    
    
    <!-- Successful Result -->
    
    <div class="gourl_cryptobox_paid" style="display:none">	
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                
                    <div class="panel-heading">
                        <div style="float:right; margin-left:10px">  
                        	<span class="gourl_texts_total"></span>: <span class="gourl_amount"></span> <span class="gourl_coinlabel"></span>
                        </div>
                        <h3 class="panel-title gourl_paymentcaptcha_title">Result</h3>
                    </div>
                    
                	<div class="panel-body text-center">
                	
                        <div style="float:left" class="gourl_paidimg">
                            <br>
                            <img style='border:0' src='https://coins.gourl.io/images/paid.png' alt='Successful'>
                            <br><br>
                        </div>
                        
                        <h3 style='color:#3caf00;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:22px;line-height:35px;font-weight:bold;' class="gourl_paymentcaptcha_successful">.</h3>
                        
                        <div class="gourl_paymentcaptcha_date"></div>
                        
                        <br>
                        <a style="margin:10px 20px" href="#" class="gourl_button_details btn btn-info"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="well well-sm" style="height: 1500px">
        <div class='gourl_jsondata'></div>
    </div> -->

</div>




  
