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
                                    <td class="text-right"><?=$user_id?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("order_id") ?></th>
                                    <td class="text-right"><?=$m_orderid?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("usd_amount") ?></th>
                                    <td class="text-right">$<?=$m_amount?></td>
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
                            <br>
                            <br>
                            <br>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 