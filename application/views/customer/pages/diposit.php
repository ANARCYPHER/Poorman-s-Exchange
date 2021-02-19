<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('diposit');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

        
                        <div class="border_preview">
                            <?php echo form_open('customer/home/payment',array('name'=>'deposit_form'));?>
                            <div class="form-group row">
                                <label for="p_name" class="col-sm-4 col-form-label"><?php echo display('deposit_amount');?></label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="deposit_amount" required type="text" id="p_name" onkeyup="Fee()" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="p_name" class="col-sm-4 col-form-label"><?php echo display('deposit_method');?></label>
                                <div class="col-sm-8">
                                    <select class="form-control basic-single" name="method" required onchange="Fee()" id="payment_method" disabled>
                                        <option value=""><?php echo display('deposit_method');?></option>
                                        <?php foreach ($payment_gateway as $key => $value) {  ?>
                                        <option value="<?php echo $value->identity; ?>"><?php echo $value->agent; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="changed" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <span id="fee" class="text-success"></span>
                                </div>
                            </div>

                            <span class="payment_info">
                            <div class="form-group row">
                                <label for="comments" class="col-sm-4 col-form-label"><?php echo display('comments');?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                                </div>
                            </div>
                            </span>

                            <div class="row m-b-15">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('diposit');?></button>
                                    <a href="<?php echo base_url('customer/home');?>" class="btn btn-danger w-md m-b-5"><?php echo display('cancel')?></a>
                                </div>
                            </div>

                            <input type="hidden" name="level" value="deposit">
                            <input type="hidden" name="fees" value="">

                            <?php echo form_close();?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.row -->


<script type="text/javascript">
    function Fee(method){
        
        var amount = document.forms['deposit_form'].elements['deposit_amount'].value;
        var method = document.forms['deposit_form'].elements['method'].value;
        var level = document.forms['deposit_form'].elements['level'].value;
        var csrf_test_name = document.forms['deposit_form'].elements['csrf_test_name'].value;

        console.log(amount + " :: " + method + "::" + level + "::" + csrf_test_name);

        if (amount!="" || amount==0) {
            $("#payment_method" ).prop("disabled", false);
        }
        if (amount=="" || amount==0) {
            $('#fee').text("Fees is "+0);
        }
        if (amount!="" && method!=""){
            $.ajax({
                'url': '<?php echo base_url();?>'+'customer/ajaxload/fees_load',
                'type': 'POST', //the way you want to send data to your URL
                'data': {'method': method,'level':level,'amount':amount,'csrf_test_name':csrf_test_name },
                'dataType': "JSON",
                'success': function(data) { 
                    if(data){
                        $('[name="amount"]').val(data.amount);
                        $('[name="fees"]').val(data.fees);
                        $('#fee').text("Fees is "+data.fees);                    
                    } else {
                        alert('Error!');
                    }  
                }
            });
        } 
    }
</script>
<?php 
$gateway = $this->db->select('*')->from('payment_gateway')->where('id',4)->where('status',1)->get()->row();
?>
<!-- Ajax Payable -->
<script type="text/javascript">
    $(function(){
        $("#payment_method").on("change", function(event) {
            event.preventDefault();
            var payment_method = $("#payment_method").val()|| 0;

            if (payment_method=='phone') {
                $( ".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 col-form-label'>Send Money</label><div class='col-sm-8'><h2><a href='tel:<?=$gateway->public_key?>'><?=$gateway->public_key?></a></h2></div></div><div class='form-group row'><label for='om_name' class='col-sm-4 col-form-label'><?php echo display("om_name") ?></label><div class='col-sm-8'><input name='om_name' class='form-control om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label for='om_mobile' class='col-sm-4 col-form-label'><?php echo display("om_mobile_no") ?></label><div class='col-sm-8'><input name='om_mobile' class='form-control om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label for='transaction_no' class='col-sm-4 col-form-label'><?php echo display("transaction_no") ?></label><div class='col-sm-8'><input name='transaction_no' class='form-control transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label for='idcard_no' class='col-sm-4 col-form-label'><?php echo display("idcard_no") ?></label><div class='col-sm-8'><input name='idcard_no' class='form-control idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
            }
            else{
                $( ".payment_info").html("<div class='form-group row'><label for='comments' class='col-sm-4 col-form-label'><?php echo display("comments") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control editor' placeholder='' type='text' id='comments'></textarea></div></div>");
            }

        });

    }); 
</script>