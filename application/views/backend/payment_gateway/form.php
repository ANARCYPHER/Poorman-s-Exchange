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
                    <?php if ($payment_gateway->identity=='payeer') { ?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-form-label col-sm-4">Success Url</label>
                            <div class="input-group col-sm-8">
                                <input type="text" class="form-control" id="copyed1" value="<?php echo base_url('payment_callback/payeer_confirm'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="myFunction1()">Copy</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label col-sm-4">Cancel Url</label>
                            <div class="input-group col-sm-8">
                                <input type="text" class="form-control" id="copyed2" value="<?php echo base_url('payment_callback/payeer_cancel'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="myFunction2()">Copy</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($payment_gateway->identity=='paystack') { ?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-form-label col-sm-4">Callback Url</label>
                            <div class="input-group col-sm-8">
                                <input type="text" class="form-control" id="copyed1" value="<?php echo base_url('customer/buy/paystackSuccess'); ?>" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="myFunction1()">Copy</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="border_preview">
                <?php echo form_open_multipart("backend/payment_gateway/payment_gateway/form/$payment_gateway->id") ?>
                <?php echo form_hidden('id', $payment_gateway->id) ?> 
                    <div class="form-group row">
                        <label for="agent" class="col-sm-4 col-form-label"><?php echo display('gateway_name') ?></label>
                        <div class="col-sm-6">
                            <input name="agent" value="<?php echo $payment_gateway->agent ?>" class="form-control" type="text" id="agent">
                        </div>

                        <?php 
                        if ($payment_gateway->identity=='bitcoin') {
                            $level1 = display('public_key');
                            $level2 = display('private_key');

                            echo "<div class='col-sm-2'>
                               <a href='https://gourl.io/view/registration' target='_blank'>Create Account</a>
                            </div>";
                        }
                        else if ($payment_gateway->identity=='payeer') {
                            $level1 = display('shop_id');
                            $level2 = display('secret_key');

                            echo "<div class='col-sm-2'>
                               <a href='https://payeer.com/en/account/?register=yes' target='_blank'>Create Account</a>
                            </div>";
                        }
                        else if ($payment_gateway->identity=='phone') {
                            $level1 = display('phone');
                            $level2 = "";
                        }
                        else if ($payment_gateway->identity=='paypal') {
                            $level1 = display('client_id');
                            $level2 = display('client_secret');

                            echo "<div class='col-sm-2'>
                               <a href='https://www.paypal.com' target='_blank'>Create Account</a>
                            </div>";
                        }
                        else if ($payment_gateway->identity=='paystack') {
                            $level1 = display('public_key');
                            $level2 = display('secret_key');

                            echo "<div class='col-sm-2'>
                               <a href='https://www.paystack.com' target='_blank'>Create Account</a>
                            </div>";
                        }
                        else if ($payment_gateway->identity=='stripe') {
                            $level1 = display('public_key');
                            $level2 = display('private_key');

                            echo "<div class='col-sm-2'>
                               <a href='https://stripe.com/' target='_blank'>Create Account</a>
                            </div>";
                        }
                        else {
                            $level1 = display('public_key');
                            $level2 = display('private_key');

                        }
                    ?>

                    </div>
                    <div class="form-group row">
                        <label for="public_key" class="col-sm-4 col-form-label"><?php echo $level1; ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input name="public_key" value="<?php echo $payment_gateway->public_key ?>" class="form-control" type="text" id="public_key">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="private_key" class="col-sm-4 col-form-label"><?php echo $level2; ?> <i class="text-danger">*</i></label>
                        <div class="col-sm-6">
                            <input name="private_key" value="<?php echo $payment_gateway->private_key ?>" class="form-control" type="text" id="private_key">
                        </div>
                    </div>
                    <?php if ($payment_gateway->identity=='paypal') { ?>
                    <div class="form-group row">
                        <label for="secret_key" class="col-sm-4 col-form-label">Mode</label>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <?php echo form_radio('secret_key', 'sandbox', (($payment_gateway->secret_key=='sandbox' || $payment_gateway->secret_key==null)?true:false)); ?>SandBox
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('secret_key', 'live', (($payment_gateway->secret_key=="live")?true:false) ); ?>Live
                             </label> 
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($payment_gateway->status==1 || $payment_gateway->status==null)?true:false)); ?><?php echo display('active') ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($payment_gateway->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $payment_gateway->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function myFunction1() {
  var copyText = document.getElementById("copyed1");
  copyText.select();
  document.execCommand("Copy");
}
function myFunction2() {
  var copyText = document.getElementById("copyed2");
  copyText.select();
  document.execCommand("Copy");
}
</script>
 