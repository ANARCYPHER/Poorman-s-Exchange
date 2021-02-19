<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
 
                <?php echo form_open('backend/dashboard/credit/send_credit','class="form-inner"') ?>

                   

                    <div class="form-group row">
                        <label for="user_id" class="col-xs-3 col-form-label"><?php echo display('user_id') ?> *</label>
                        <div class="col-xs-9">
                            <input name="user_id"  type="text" class="form-control" id="user_id" placeholder="<?php echo display('user_id') ?>" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-xs-3 col-form-label"><?php echo display('amount') ?> *</label>
                        <div class="col-xs-9">
                            <input name="amount" type="number" class="form-control" id="amount" placeholder="<?php echo display('amount') ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="notes" class="col-xs-3 col-form-label"><?php echo display('notes') ?> *</label>
                        <div class="col-xs-9">
                            <textarea name="note" class="form-control" placeholder="<?php echo display('notes') ?>"  rows="4"></textarea>
                        </div>
                    </div>  
                    

                    <div class="form-group  text-right">
                        <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary w-md m-b-5"><?php echo display("cancel") ?></a>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('send') ?></button>
                    </div>

                <?php echo form_close() ?>
            </div> 
        </div>
    </div>
</div>








 