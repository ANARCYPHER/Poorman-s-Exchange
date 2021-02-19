<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">

                <?php echo form_open_multipart("customer/profile/change_save") ?>
                
  
                    <div class="row">

                        
                        <div class="form-group col-lg-12">
                            <label><?php echo display("enter_old_password") ?> *</label>
                            <input type="text" class="form-control" value="<?php echo (isset($set_old->old_pass)?$set_old->old_pass:'');?>" name="old_pass" placeholder="<?php echo display("enter_old_password") ?>">
                        </div>

                        <div class="form-group col-lg-12">
                            <label><?php echo display("enter_new_password") ?> *</label>
                            <input type="text"  class="form-control" value="<?php echo (isset($set_old->new_pass)?$set_old->new_pass:'');?>" name="new_pass" placeholder="<?php echo display("enter_new_password") ?>">
                        </div>

                        <div class="form-group col-lg-12">
                            <label><?php echo display("enter_confirm_password") ?> *</label>
                            <input type="text"  class="form-control" name="confirm_pass" value="<?php echo (isset($set_old->confirm_pass)?$set_old->confirm_pass:'');?>" placeholder="<?php echo display("enter_confirm_password") ?>">
                        </div>

                        
                    </div> 

                    <div>
                        <button type="submit" class="btn btn-success"><?php echo display("change") ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>

            </div>
        </div>
    </div>
</div>

 