<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('coin_name') ?></th>
                            <th><?php echo display('fullname') ?></th>
                            <th><?php echo display('wallet_data') ?></th>
                            <th><?php echo display('transection_type') ?></th>
                            <th><?php echo display('coin_amount') ?></th>
                            <th><?php echo display('usd_amount') ?></th>
                            <th><?php echo display('local_amount') ?></th>
                            <th><?php echo display('payment_method') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($exchange)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($exchange as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td>
                                <?php 
                                    foreach ($currency as $ckey => $cvalue) {
                                         echo ($value->coin_id==$cvalue->cid)?$cvalue->name:'';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    foreach ($userinfo as $ukey => $uvalue) {
                                        echo ($value->user_id==$uvalue->user_id)?$uvalue->f_name." ".$uvalue->l_name:'';
                                    }
                                ?>
                            </td>
                            <td><?php echo $value->coin_wallet_id; ?></td>
                            <td><?php echo $value->transection_type; ?></td>
                            <td><?php echo $value->coin_amount; ?></td>
                            <td><?php echo $value->usd_amount; ?></td>
                            <td><?php echo $value->local_amount; ?></td>
                            <td><?php echo $value->payment_method; ?></td>
                            <td><?php echo $value->date_time ; ?></td>
                            <td><?php echo (($value->status==0)?display('cancel'):(($value->status==1)?display('request'):display('complete'))); ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/exchange/exchange/form/$value->ext_exchange_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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

 