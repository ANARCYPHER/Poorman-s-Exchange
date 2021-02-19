<div class="row">
    <div class="col-sm-8 col-sm-offset-4">
        <h3 class="form-title"><?php echo display("payable") ?>:</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo display("currency") ?></th>
                        <th><?php echo display("payable") ?></th>
                        <th><?php echo display("rate") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>USD</td>
                        <td>$
                            <?php echo $payableusd; ?>
                            <?php echo form_hidden('usd_amount', $payableusd) ?>
                        </td>
                        <td>
                            <?php echo $price_usd; ?>
                            <?php echo form_hidden('rate_coin', $price_usd) ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $selectedlocalcurrency->currency_name; ?></td>
                        <td><?php echo ($selectedlocalcurrency->currency_position=='l')?$selectedlocalcurrency->currency_symbol." ".$payablelocal:$payablelocal." ".$selectedlocalcurrency->currency_symbol; ?>
                            <?php echo form_hidden('local_amount', $payablelocal) ?>
                        </td>
                        <td><?php echo $selectedlocalcurrency->usd_exchange_rate ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-4 control-label">Your <i><?php echo isset($selectedexccurrency->coin_name)?$selectedexccurrency->coin_name:''; ?></i> <?php echo display("wallet_data") ?></label>
    <div class="col-sm-8">
        <input  name="wallet_id" type="text" class="form-control input-solid" id="wallet_id" autocomplete="off">
    </div>
</div>