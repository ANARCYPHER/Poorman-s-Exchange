<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display("buy"); ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">

                        <?php if ($sbuypayment->payment_method=='bitcoin') { ?>
                            
                            <script src="<?php echo base_url('assets/crypto/'); ?>cryptobox.min.js" type='text/javascript'></script>
                            <div style='margin:30px 0 5px 480px'>Language: &#160; <?php echo $languages_list; ?></div>
                            <?php echo $paymentbox; ?>
                            <center><?php echo $message; ?></center>

                        <?php } elseif ($sbuypayment->payment_method=='payeer') { ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo display("user_id") ?></th>
                                    <td class="text-right"><?=$sbuypayment->user_id?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("order_id") ?></th>
                                    <td class="text-right"><?=$m_orderid?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("usd_amount") ?></th>
                                    <td class="text-right">$<?=$sbuypayment->usd_amount?></td>
                                </tr>
                            </table>
                            <form method="post" action="https://payeer.com/merchant/">
                            <input type="hidden" name="m_shop" value="<?=$m_shop?>">
                            <input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
                            <input type="hidden" name="m_amount" value="<?=$m_amount?>">
                            <input type="hidden" name="m_curr" value="<?=$m_curr?>">
                            <input type="hidden" name="m_desc" value="<?=$m_desc?>">
                            <input type="hidden" name="m_sign" value="<?=$sign?>">
                           
                            <input type="submit" name="m_process" value="Payment Process" class="btn btn-success w-md m-b-5" />

                            <a href="<?php echo base_url('customer/buy/form'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            
                            <br>
                            <br>
                            <br>
                            </form>

                        <?php } elseif ($sbuypayment->payment_method=='paypal')  { ?>

                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo display("user_id") ?></th>
                                    <td class="text-right"><?=$sbuypayment->user_id?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("usd_amount") ?></th>
                                    <td class="text-right">$<?=$sbuypayment->usd_amount?></td>
                                </tr>
                            </table>

                            <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $approval_url ?>">Payment Process</a>

                        <?php } elseif ($sbuypayment->payment_method=='stripe')  { ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo display("user_id") ?></th>
                                    <td class="text-right"><?=$sbuypayment->user_id?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("usd_amount") ?></th>
                                    <td class="text-right">$<?=$sbuypayment->usd_amount?></td>
                                </tr>
                            </table>

                            <?php echo form_open('customer/buy/stripe_confirm', 'method="post" '); ?>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>" data-description="<?php echo $description ?>" data-amount="<?php echo round($sbuypayment->usd_amount*100) ?>" data-locale="auto"></script>
                            <?php echo form_close();?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 