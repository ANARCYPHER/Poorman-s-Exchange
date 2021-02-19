<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lobipanel-parent-sortable ui-sortable" data-lobipanel-child-inner-id="2jd65zBuH9">
        <div class="panel panel-bd lobidrag lobipanel lobipanel-sortable" data-inner-id="2jd65zBuH9" data-index="0">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('deposit_list');?></h4>
                </div>
            </div>
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered datatable2">
                            
                            <thead>
                                <tr>
                                    <th><?php echo display('deposit_amount')?></th>
                                    <th><?php echo display('deposit_method')?></th>
                                    <th><?php echo display('fees')?></th>
                                    <th><?php echo display('comments')?></th>
                                    <th><?php echo display('date')?></th>
                                    <th><?php echo display('status')?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if($deposit!=NULL){ 
                                    foreach ($deposit as $key => $value) {  
                                ?>
                                <tr>
                                    <td>$<?php echo $value->deposit_amount;?></td>
                                    <td><?php echo $value->deposit_method;?></td>
                                    <td>$<?php echo $value->fees;?></td>
                                    <td><?php
                                            if (is_string($value->comments) && is_array(json_decode($value->comments, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false) {
                                               $mobiledata = json_decode($value->comments, true);
                                               echo '<b>'.display("om_name").':</b> '.$mobiledata['om_name'].'<br>';
                                               echo '<b>'.display("om_mobile_no").':</b> '.$mobiledata['om_mobile'].'<br>';
                                               echo '<b>'.display("transaction_no").':</b> '.$mobiledata['transaction_no'].'<br>';
                                               echo '<b>'.display("idcard_no").':</b> '.$mobiledata['idcard_no'];
                                            } else {
                                               echo $value->comments;
                                            }

                                     ?></td>
                                    <td><?php $date=date_create($value->deposit_date);
                                            echo date_format($date,"jS F Y");?></td>
                                    <td><span class="glyphicon glyphicon-<?php echo ($value->status?'ok':'remove');?>"></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <?php echo $links; ?>
                    </div>
            </div>
        </div>
    </div>
</div>