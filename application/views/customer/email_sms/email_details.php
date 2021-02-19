<?php 
$settings = $this->db->select("*")
	->get('setting')
	->row();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="mailbox">
            
            <div class="mailbox-body">
                

                    <div class="mailbox-body">
                        <div class="row m-0">

                            
                            <div class="col-xs-12 col-sm-12 col-md-12 p-0 inbox-mail">
                                <div class="inbox-avatar p-20 border-btm">
                                    <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="border-green hidden-xs hidden-sm" alt="">
                                    <div class="inbox-avatar-text">
                                        <div class="avatar-name"><strong>From: </strong>
                                            <em><?php echo $settings->email; ?></em>
                                        </div>
                                        <div><small><strong>Subject: </strong> <?php echo $notification->subject;?></small></div>
                                    </div>
                                    <div class="inbox-date text-right hidden-xs hidden-sm">
                                        <div><span class="bg-green badge"><small><?php echo $notification->subject;?></small></span></div>
                                        <div><small><?php echo $notification->date;?></small></div>
                                    </div>
                                </div>

                                <div class="inbox-mail-details p-20">
                                    <p><strong>Hi, <?php echo $this->session->userdata('fullname'); ?></strong></p>
                                    <p><span><?php echo $notification->details;?></span></p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>