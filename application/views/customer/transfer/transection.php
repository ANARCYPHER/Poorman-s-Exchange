<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="zvTmPK6RKK">
        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="zvTmPK6RKK" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('transection');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">
                    <div class="text-right">
                        <!-- <div><strong>Balance :</strong> $520</div> -->
                        <div><strong><?php echo display('diposit')?> :</strong> $<?php echo @$deposit;?></div>
                        <div><strong><?php echo display('earn')?> :</strong> $<?php echo @$earn;?></div>
                        <div><strong><?php echo display('reciver')?> :</strong> $<?php echo @$reciver;?></div>
                        <div><strong><?php echo display('investment')?> :</strong> $<?php echo @$investment;?></div>
                        <div><strong><?php echo display('withdraw')?> :</strong> $<?php echo @$withdraw;?></div>
                        <div><strong><?php echo display('transfer')?> :</strong> $<?php echo @$transfar;?></div>                        
                        <div><strong>-----------------------</strong></div>   
                        <div><strong><?php echo display('balance')?> : </strong> <?php echo $balance;?></div>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered datatable2">
                            <thead>
                                <tr>
                                    <th><?php echo display('date');?></th>
                                    <th><?php echo display('transection_category');?></th>
                                    <th><?php echo display('balance');?></th>
                                    <th><?php echo display('comment');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($transection!=NULL){ 
                                    foreach ($transection as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo $value->transection_date_timestamp;?></td>
                                    <td><?php echo $value->transection_category;?></td>
                                    <td><?php echo $value->amount;?></td>
                                    <td><?php echo $value->comments;?></td>
                                </tr>
                                <?php } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>