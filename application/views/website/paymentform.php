<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
        <div class="page_header" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1><?php echo $cat_title1; ?></h1>
                                <p><?php echo $cat_title2; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of page header -->

        <div class="buySell_content">
            <div class="container">
                <div class="row">

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
                            <input type="submit" name="m_process" value="Payment Process" class="btn btn-success w-md m-b-5 " style="float: right;" />
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

                            <?php echo form_open('home/stripe_confirm', 'method="post" '); ?>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>" data-description="<?php echo $description ?>" data-amount="<?php echo round($sbuypayment->usd_amount*100) ?>" data-locale="auto"></script>
                            <?php echo form_close();?>
                        <?php } ?>

                </div>
            </div>
        </div>
 