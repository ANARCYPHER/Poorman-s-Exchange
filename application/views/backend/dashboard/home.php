

<style type="text/css">
    .panel-navy-blue{
        background: #1b1464;
        color: #fff;
    }
    .panel-orenge{
        background: #f8931f;
        color: #fff;
    }

    .panel-blue{
        background: #0071bd;
        color: #fff;
    }
    .panel-sky{
        background: #00a99e;
        color: #fff;
    }
</style>
                    <!-- /.Social share -->
                    <div class="row">

                        <div class="col-sm-6 col-md-3">
                            <div class="count_panel panel-navy-blue">
                                <div class="stats-title">
                                    <h4><?php echo display('total_user')?></h4>
                                </div>
                                <h1 class="currency_text "><?php echo (@$total_user?$total_user:'0'); ?></h1>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="count_panel panel-orenge">
                                <div class="stats-title ">
                                    <h4><?php echo display('total_roi')?></h4>
                                </div>
                                <h1 class="currency_text">$<?php echo (@$total_roi?number_format($total_roi, 2):'0.0');?></h1>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="count_panel panel-blue">
                                <div class="stats-title ">
                                    <h4><?php echo display('total_commission')?></h4>
                                </div>
                                <h1 class="currency_text">$<?php echo (@$commission?number_format($commission, 2):'0.0');?></h1>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="count_panel panel-sky">
                                <div class="stats-title ">
                                    <h4><?php echo display('total_investment');?></h4>
                                </div>
                                <h1 class="currency_text">$<?php echo (@$total_investment?number_format($total_investment, 2):'0.0');?></h1>
                            </div>
                        </div>
                    </div>



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Exchange all Request</h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Exchange Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Deatils</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($exchange as $key => $value) { ?>
                                    <tr>
                                    <td><?php echo $value->user_id; ?></td>
                                    <td><?php echo $value->transection_type; ?> - 
                                        <?php foreach ($cryptocurrency as $keyc => $valuec) {
                                            if ($value->coin_id==$valuec->cid) {
                                               echo $valuec->symbol;
                                            }
                                        } ?>
                                        </td>
                                    <td><?php echo $value->usd_amount; ?></td>
                                    <td><?php echo date("jS F, Y", strtotime("$value->date_time")); ?></td>
                                    <td><a href='<?php echo base_url("backend/exchange/exchange/form/$value->ext_exchange_id"); ?>'>Details</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?php echo base_url()?>backend/exchange/exchange">See All | Exchange Request</a>
            </div>
        </div>
    </div>
</div> <!-- /.row -->


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Withdraw all Panding</h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo display('user_id') ?></th>
                                <th><?php echo display('payment_method') ?></th>
                                <th><?php echo display('ip_address') ?></th>
                                <th><?php echo display('amount') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($wrequest)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($wrequest as $value) { ?>
                            <tr>
                                <td><?php echo $value->user_id; ?></td>
                                <td><?php echo $value->method; ?></td>
                                <td><?php echo $value->request_ip; ?></td>
                                <td><?php echo $value->amount; ?></td>
                               
                                 <td>
                                     <a href="<?php echo base_url()?>backend/withdraw/withdraw/confirm_withdraw?id=<?php echo $value->withdraw_id;?>&user_id=<?php echo $value->user_id;?>&set_status=2" class="btn btn-warning btn-sm"><?php echo display('confirm')?></a>
                                     <a href="<?php echo base_url()?>backend/withdraw/withdraw/cancel_withdraw?id=<?php echo $value->withdraw_id;?>&user_id=<?php echo $value->user_id;?>&set_status=3" class="btn btn-danger btn-sm"><?php echo display('cancel')?></a>
                                     
                                     <a href="#<?php echo $value->user_id;?>" class="AjaxModal btn btn-info btn-sm" data-toggle="modal" data-target="#newModal"> Information</a>
                                 </td>
                                
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
                <a href="<?php echo base_url()?>backend/withdraw/withdraw/pending_withdraw">See All | Withdraw Panding</a>
            </div>
        </div>
    </div>
</div> <!-- /.row -->


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