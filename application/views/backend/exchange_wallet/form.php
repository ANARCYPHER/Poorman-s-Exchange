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
                <?php echo form_open_multipart("backend/exchange_wallet/exchange_wallet/form/$exchange_wallet->ext_exchange_wallet_id") ?>
                <?php echo form_hidden('ext_exchange_wallet_id', $exchange_wallet->ext_exchange_wallet_id) ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('cryptocurrency') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control basic-single" name="cid" id="cid">
                                <option value=""><?php echo display('select_cryptocurrency') ?></option>
                                <?php foreach ($currency as $key => $value) { ?>
                                    <option value="<?php echo $value->cid; ?>" <?php echo ($exchange_wallet->coin_id==$value->cid)?'Selected':'' ?> ><?php echo $value->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wallet_data" class="col-sm-4 col-form-label"><?php echo display('wallet_data') ?></label>
                        <div class="col-sm-8">
                            <input name="wallet_data" value="<?php echo $exchange_wallet->wallet_data ?>" class="form-control" type="text" id="wallet_data" placeholder="<?php echo display('wallet_data') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sell_adjustment" class="col-sm-4 col-form-label"><?php echo display('sell_adjustment') ?> %</label>
                        <div class="col-sm-8">
                            <input name="sell_adjustment" value="<?php echo $exchange_wallet->sell_adjustment ?>" class="form-control" type="text" id="sell_adjustment" placeholder="<?php echo display('sell_adjustment') ?> %">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="buy_adjustment" class="col-sm-4 col-form-label"><?php echo display('buy_adjustment') ?> %</label>
                        <div class="col-sm-8">
                            <input name="buy_adjustment" value="<?php echo $exchange_wallet->buy_adjustment ?>" class="form-control" type="text" id="buy_adjustment" placeholder="<?php echo display('buy_adjustment') ?> %">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($exchange_wallet->status==1 || $exchange_wallet->status==null)?true:false)); ?>Active
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($exchange_wallet->status=="0")?true:false) ); ?>Inactive
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $exchange_wallet->ext_exchange_wallet_id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

 