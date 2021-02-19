<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("backend/currency/currency/form/$currency->cid") ?>
                <?php echo form_hidden('cid', $currency->cid) ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label"><?php echo display('name') ?></label>
                        <div class="col-sm-8">
                            <h3><?php echo $currency->name; ?></h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($currency->status==1 || $currency->status==null)?true:false)); ?><?php echo display("active") ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($currency->status=="0")?true:false) ); ?><?php echo display("inactive") ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $currency->cid?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

 