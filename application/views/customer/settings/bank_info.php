<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        

        <div class="panel panel-bd lobidrag">
                
                            <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('bank_details');?></h4>
                    </div>
                </div>

                <?php echo form_open('customer/settings/bank_info_update')?>
                <div class="panel-body">
                    <div class="form-group row">
                        <label for="beneficiary_name" class="col-sm-4 col-form-label"><?php echo display('beneficiary_name');?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="beneficiary_name" value="<?php echo @$my_bangk_info->beneficiary_name;?>" name="beneficiary_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name');?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="bank_name" value="<?php echo @$my_bangk_info->bank_name;?>" id="bank_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch" class="col-sm-4 col-form-label"><?php echo display('branch');?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="branch" id="branch" value="<?php echo @$my_bangk_info->branch;?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="account_number" class="col-sm-4 col-form-label"><?php echo display('account_number');?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="account_number" id="account_number" value="<?php echo @$my_bangk_info->account_number;?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="code" class="col-sm-4 col-form-label"><?php echo display('ifsc_code');?></label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="code" id="code" value="<?php echo @$my_bangk_info->ifsc_code;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update');?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div> <!-- /.row -->

                           


