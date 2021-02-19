<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">

            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('bitcoin_setting');?></h4>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

        
                        <div class="border_preview">

                            <?php echo form_open('customer/settings/bitcoin');?>
                                <div class="form-group row">
                                    <label for="bitcoin_wallet_id" class="col-sm-4 col-form-label"><?php echo display('bitcoin_wallet_id');?></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="bitcoin_wallet_id" required type="text" id="bitcoin_wallet_id">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bitcoin_wallet_id" class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>

                                <div>
                                    
                                </div>
     
                            <?php echo form_close();?>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div> <!-- /.row -->

