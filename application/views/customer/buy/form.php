<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("customer/buy") ?>"><i class="fa fa-list" aria-hidden="true"></i> <?php echo display('buy_list') ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                    <?php echo form_open_multipart("customer/buy/form"); ?>
                        <div class="form-group row">
                            <label for="cid" class="col-sm-4 col-form-label"><?php echo display("cryptocurrency") ?></label>
                            <div class="col-sm-8">
                                <select class="form-control basic-single" name="cid" id="cid">
                                    <option value=""><?php echo display("select_cryptocurrency") ?></option>
                                    <?php foreach ($currency as $key => $value) {  ?>
                                         <option value="<?php echo $value->coin_id; ?>"><?php echo $value->coin_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="buy_amount" class="col-sm-4 col-form-label"><?php echo display("buy_amount") ?></label>
                            <div class="col-sm-8">
                                <input name="buy_amount" class="form-control buy_amount" type="text" id="buy_amount" disabled>
                            </div>
                        </div>
                        <span class="buy_payable">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <fieldset>
                                    <legend><?php echo display("payable") ?>:</legend>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th><?php echo display("currency") ?></th>
                                                <th><?php echo display("payable") ?></th>
                                                <th><?php echo display("rate") ?></th>
                                            </tr>
                                            <tr>
                                                <td>USD</td>
                                                <td>$</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $selectedlocalcurrency->currency_name; ?></td>
                                                <td><?php echo $selectedlocalcurrency->currency_symbol; ?></td>
                                                <td>0</td>
                                            </tr>
                                        </table>
                                    </div>
                                 </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wallet_id" class="col-sm-4 col-form-label">Your <i></i> <?php echo display("wallet_data") ?></label>
                            <div class="col-sm-8">
                                <input name="wallet_id" class="form-control" type="text" id="wallet_id" autocomplete="off">
                            </div>
                        </div>
                        </span>
                        <div class="form-group row">
                            <label for="payment_method" class="col-sm-4 col-form-label"><?php echo display("payment_method") ?></label>
                            <div class="col-sm-8">
                                <select class="form-control basic-single" name="payment_method" id="payment_method">
                                    <option value=""><?php echo display("select_payment_method") ?></option>
                                    <?php foreach ($payment_gateway as $key => $value) {  ?>
                                    <option value="<?php echo $value->identity; ?>"><?php echo $value->agent; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <span class="payment_info">
                            <div class="form-group row">
                                <label for="comments" class="col-sm-4 col-form-label"><?php echo display("comments") ?></label>
                                <div class="col-sm-8">
                                    <textarea name="comments" class="form-control editor" placeholder="" type="text" id="comments" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </span>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display("buy") ?></button>
                                <a href="<?php echo base_url('customer'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$gateway = $this->db->select('*')->from('payment_gateway')->where('id',4)->where('status',1)->get()->row();
?>
<!-- Ajax Payable -->
<script type="text/javascript">
    $(function(){
        $("#cid").on("change", function(event) {
            event.preventDefault();
            var cid = $("#cid").val()|| 0;

            var inputdata = 'cid='+cid+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            $.ajax({
                url: "<?php echo base_url('customer/buy/buypayable'); ?>",
                type: "post",
                data: inputdata,
                success: function(data) {
                    $( ".buy_payable").html(data);
                    $( "#buy_amount" ).prop( "disabled", false );
                },
                error: function(){
                }
            });
        });

        $("#buy_amount").on("keyup", function(event) {
            event.preventDefault();
            var buy_amount = parseFloat($("#buy_amount").val())|| 0;
            var cid = $("#cid").val()|| 0;
            if (cid=="") {
                alert("<?php echo display("please_select_cryptocurrency_first") ?>");
                return false;
            } else {
                var inputdata = "cid="+cid+"&amount="+buy_amount+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                $.ajax({
                    url: "<?php echo base_url('customer/buy/buypayable'); ?>",
                    type: "post",
                    data: inputdata,
                    success: function(data) {
                        $( ".buy_payable").html(data);
                    },
                    error: function(){
                        return false;
                    }
                });
            }
        });

        $("#payment_method").on("change", function(event) {
            event.preventDefault();
            var payment_method = $("#payment_method").val()|| 0;
            var cid = $("#cid").val()|| 0;

            if (payment_method==='bitcoin' && cid==1) {
                alert("<?php echo display("please_select_diffrent_payment_method") ?>");
                $('#payment_method option:selected').removeAttr('selected');
                return false;
            }

            if (payment_method==='phone') {
                $( ".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 col-form-label'><?php echo display("send_money") ?></label><div class='col-sm-8'><h2><a href='tel:<?=@$gateway->public_key?>'><?=@$gateway->public_key?></a></h2></div></div><div class='form-group row'><label for='om_name' class='col-sm-4 col-form-label'><?php echo display("om_name") ?></label><div class='col-sm-8'><input name='om_name' class='form-control om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label for='om_mobile' class='col-sm-4 col-form-label'><?php echo display("om_mobile_no") ?></label><div class='col-sm-8'><input name='om_mobile' class='form-control om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label for='transaction_no' class='col-sm-4 col-form-label'><?php echo display("transaction_no") ?></label><div class='col-sm-8'><input name='transaction_no' class='form-control transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label for='idcard_no' class='col-sm-4 col-form-label'><?php echo display("idcard_no") ?></label><div class='col-sm-8'><input name='idcard_no' class='form-control idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
            }
            else{
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label'><?php echo display("comments") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
            }

        });

    }); 
</script>