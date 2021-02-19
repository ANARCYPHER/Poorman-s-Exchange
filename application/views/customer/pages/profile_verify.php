<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="5lmZlfyErQ">
        
        <!-- alert message -->
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Check your email 
            </div> 
            


        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="5lmZlfyErQ" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('change_verify')?></h4>
                </div>
            </div>

            <?php 

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
                                            <th><?php echo display('enter_verify_code');?></th>
                                            <td><input class="form-control" type="text" name="code" id="code"></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <?php echo form_close();?>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="sendEmail('<?php echo $this->uri->segment(4);?>');" class="btn btn-success w-md m-b-5"><?php echo display('confirm');?></button>
                                <button type="button" class="btn btn-danger w-md m-b-5"><?php echo display('cancle');?></button>
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
            url: '<?php echo base_url('customer/profile/profile_update'); ?>',
            type: 'POST', //the way you want to send data to your URL
            data: {'id': id,'code':code,'csrf_test_name':csrf_test_name },
            success: function(data) { 
                
                if(data==1){

                    swal({
                        title: "Good job!",
                        text: "Your Custom Email Send Successfully",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1500,

                    });
                    window.location.href = "<?php echo base_url('customer/profile'); ?>";

                    
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