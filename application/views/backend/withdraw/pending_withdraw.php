<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable2 table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('user_id') ?></th>
                                <th><?php echo display('payment_method') ?></th>
                                <th><?php echo display('wallet_id') ?></th>
                                <th><?php echo display('amount') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($withdraw)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($withdraw as $value) { ?>
                            <tr>
                                <td><?php echo $value->user_id; ?></td>
                                <td><?php echo $value->method; ?></td>
                                <td><?php echo $value->walletid; ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td>
                                    <?php if($value->status==1){?>
                                     <a class="btn btn-warning btn-sm"><?php echo display('pending_withdraw')?></a>
                                     <?php } else if($value->status==2){?>
                                     <a class="btn btn-success btn-sm"><?php echo display('success')?></a>
                                     <?php } else{ ?>
                                     <a class="btn btn-danger btn-sm"><?php echo display('cancel')?></a>
                                     <?php } ?>
                                 </td>
                                 <td>
                                     <a href="<?php echo base_url()?>backend/withdraw/withdraw/confirm_withdraw?id=<?php echo $value->withdraw_id;?>&user_id=<?php echo $value->user_id;?>&set_status=2" class="btn btn-success btn-sm"><?php echo display('confirm')?></a>
                                     <a href="<?php echo base_url()?>backend/withdraw/withdraw/cancel_withdraw?id=<?php echo $value->withdraw_id;?>&user_id=<?php echo $value->user_id;?>&set_status=3" class="btn btn-danger btn-sm"><?php echo display('cancel')?></a>
                                     <a href="#<?php echo $value->user_id;?>" class="AjaxModal btn btn-info btn-sm" data-toggle="modal" data-target="#newModal"> Information</a>
                                 </td>
                                
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                    <?php echo $links; ?>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- Modal body load from ajax start-->
<div class="modal fade modal-success" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h1 class="modal-title"><?php echo display('profile');?></h1>
        </div>
        <div class="modal-body">
            <table>
                <tr><td><strong><?php echo display('name');?> : </strong></td> <td id="name"></td></tr>
                <tr><td><strong><?php echo display('email');?> : </strong></td> <td id="email"></td></tr>
                <tr><td><strong><?php echo display('mobile');?> : </strong></td> <td id="phone"></td></tr>
                <tr><td><strong><?php echo display('user_id');?> : </strong></td> <td id="user_id"></td></tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- Modal body load from ajax end-->

<!-- Modal ajax call start -->
<script type="text/javascript">

    $(".AjaxModal").click(function(){
      var url = $(this).attr("href");
      var href = url.split("#");  
      
      jquery_ajax(href[1]);
    });

    function jquery_ajax(id) {
           $.ajax({
                url : "<?php echo site_url('backend/Ajax_load/user_info_load/')?>" + id,
                type: "GET",
                data: {'id':id},
                dataType: "JSON",
                success: function(data)
                {

                    $('#name').text(data.f_name+' '+data.l_name);
                    $('#email').text(data.email);
                    $('#phone').text(data.phone);
                    $('#user_id').text(data.user_id);
                  
                   
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

    }
</script>
