<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('deposit'); ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                        <table class="table table-bordered">
                                <tr>
                                    <th><?php echo display("user_id") ?></th>
                                    <td class="text-right"><?php echo $user_id; ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("usd_amount") ?></th>
                                    <td class="text-right">$<?php echo $deposit_amount ?></td>
                                </tr>
                            </table>

<?php echo form_open('customer/home/stripe_confirm', 'method="post" '); ?>
<input type="hidden" value="<?php echo $deposit_id ?>" name="asdfasd">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="<?php echo $description ?>"
          data-amount="<?php echo round($deposit_amount*100) ?>"
          data-locale="auto"></script>
<?php echo form_close();?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
