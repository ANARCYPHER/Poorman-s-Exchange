<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('confirm_transfer')?></h4>
                </div>
            </div>

            <?php 
                $data = json_decode($v->data);
            ?>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <div class="border_preview">
                            <div class="table-responsive">
                                <?php 
                                $att = array('name'=>'verify');
                                echo form_open('#',$att);
                                ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th><?php echo display('receiver_name')?></th>
                                            <td><?php echo $u->f_name.' '. $u->l_name;?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('email');?></th>
                                            <td><?php echo $u->email;?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('user_id');?></th>
                                            <td><?php echo $u->user_id;?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('transfer_amount');?></th>
                                            <td>$<?php echo $data->amount;?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('enter_verify_code');?></th>
                                            <td><input class="form-control" type="text" name="code" id="code"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php echo form_close();?>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="sendEmail('<?php echo $v->id;?>');" class="btn btn-success w-md m-b-5">Confirm</button>
                                <button type="button" class="btn btn-danger w-md m-b-5">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function sendEmail(id){

var code = document.forms['verify'].elements['code'].value;
var csrf_test_name = document.forms['verify'].elements['csrf_test_name'].value;


        swal({
            title: 'Please Wait......',
            type: 'warning',
            showConfirmButton: false,
            onOpen: function () {
                swal.showLoading()
              }
        });



        $.ajax({
            'url': '<?php echo base_url('customer/transfer/transfer_verify'); ?>',
            'type': 'POST', //the way you want to send data to your URL
            'data': {'id': id,'code':code,'csrf_test_name':csrf_test_name },
            'success': function(data) { 
                
                if(data!=0){
                    
                    swal({
                        title: "Good job!",
                        text: "Transfer Successfully",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    window.location.href = "<?php echo base_url('customer/transfer/send_details/');?>"+data;

                    
                } else {

                    swal({
                        title: "Wops!",
                        text: "Error Message",
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }
                
            }
        });
    }
</script>