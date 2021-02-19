<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">

            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('payment_method_setting');?></h4>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" disabled value="bitcoin">
                                        <input name="bitcoin" class="form-control" type="hidden" value="bitcoin">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label"><?php echo display('bitcoin_wallet_id');?></label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="bitcoin_wallet_id" value="<?php echo @$bitcoin->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input  class="form-control" type="text" disabled value="payeer">
                                        <input name="payeer" class="form-control" type="hidden" value="payeer">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label"><?php echo display('payeer_wallet_id');?> *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="payeer_wallet_id" value="<?php echo @$payeer->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input  class="form-control" type="text" disabled value="paypal">
                                        <input name="paypal" class="form-control" type="hidden" value="paypal">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label">Paypal *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="phone_no" value="<?php echo @$paypal->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input  class="form-control" type="text" disabled value="stripe">
                                        <input name="stripe" class="form-control" type="hidden" value="stripe">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label">Stripe *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="phone_no" value="<?php echo @$stripe->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input  class="form-control" type="text" disabled value="phone">
                                        <input name="phone" class="form-control" type="hidden" value="phone">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label"><?php echo display('mobile');?> *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="phone_no" value="<?php echo @$phone->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="border_preview">
                            <?php echo form_open('customer/settings/payment_method_update');?>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><?php echo display('payment_method');?> *</label>
                                    <div class="col-sm-12">
                                        <input  class="form-control" type="text" disabled value="paystack">
                                        <input name="paystack" class="form-control" type="hidden" value="paystack">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-12 col-form-label">Paystack *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" name="phone_no" value="<?php echo @$paystack->wallet_id;?>" required type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-8">
                                       <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close();?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> <!-- /.row -->