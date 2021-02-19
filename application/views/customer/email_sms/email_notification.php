<?php 
$settings = $this->db->select("*")
	->get('setting')
	->row();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="mailbox">
            <div class="mailbox-header">
                <div class="row">
                    <div class="col-xs-4">
                    	<?php $image = $this->session->userdata('image'); ?>
						
                        <div class="inbox-avatar"><img src="<?php echo base_url(!empty($image)?$image:"assets/images/icons/user.png") ?>" class="img-circle border-green" alt="">
                            <div class="inbox-avatar-text hidden-xs hidden-sm">
                                <div class="avatar-name"><?php echo $this->session->userdata('fullname'); ?></div>
                                <div><small>Mailbox</small></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="mailbox-body">
                <div class="row m-0">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 p-0 inbox-mail">
                        <div class="mailbox-content">
                        	<?php foreach($notification as $val){?>
                            <a href="<?php echo base_url()?>customer/notification/email_details/<?php echo $val->notification_id;?>" class="inbox_item unread">
                                <div class="inbox-avatar"><img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="border-green hidden-xs hidden-sm" alt="">
                                    <div class="inbox-avatar-text">
                                        <div class="avatar-name"><?php echo $val->subject;?></div>
                                        <div><small><?php echo $val->details;?></small></div>
                                    </div>
                                    <div class="inbox-date hidden-sm hidden-xs hidden-md">
                                        <div class="date"><?php echo $val->date;?></div>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                             <?php echo $links; ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>