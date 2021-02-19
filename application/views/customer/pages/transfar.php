<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="33kfJghXJU">
        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="33kfJghXJU" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('transfer');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <?php echo form_open('customer/Transfer/store',array('name'=>'transfer_form'));?>
                        <div class="border_preview">
                            <div class="form-group row">
                                <label for="receiver_id" class="col-sm-4 col-form-label"><?php echo display('reciver_account')?></label>
                                <div class="col-sm-7">
                                    <input class="form-control" onblur="ReciverChack(this.value)" name="receiver_id" type="text" required id="receiver_id">
                                </div>

                                <div class="col-sm-1">
                                    <img src="<?php echo base_url()?>assets/images/Group.svg" class="suc">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-sm-4 col-form-label"><?php echo display('amount')?></label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="amount" type="text" required id="amount">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comments" class="col-sm-4 col-form-label"><?php echo display('comment')?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-7 col-form-label"><?php echo display('otp_send_to')?></label>
                                <div class="col-sm-5">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="varify_media" checked="">
                                        <label for="inlineRadio1"> SMS </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" id="inlineRadio2" value="2" name="varify_media">
                                        <label for="inlineRadio2"> Email </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-b-15">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('transfer')?></button>
                                    <button type="button" class="btn btn-danger w-md m-b-5"><?php echo display('cancel')?></button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function ReciverChack(receiver_id){

        var csrf_test_name = document.forms['transfer_form'].elements['csrf_test_name'].value;

        $.ajax({
            url: '<?php echo base_url('customer/ajaxload/checke_reciver_id');?>',
            type: 'POST', //the way you want to send data to your URL
            data: {'receiver_id': receiver_id,'csrf_test_name':csrf_test_name },
            success: function(data) { 
                
                if(data!=0){
                    $('#receiver_id').css("border","1px green solid");
                    $('.suc').css("border","1px green solid");
                } else {
                     $('#receiver_id').css("border","1px red solid");
                     $('.suc').css("border","1px red solid");
                }  
            },
        });
    }
</script>

<style type="text/css">
    .red{
        border:1px red solid;
    }
</style>