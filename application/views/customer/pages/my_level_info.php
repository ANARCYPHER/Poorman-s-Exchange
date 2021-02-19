<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('my_level_info');?></h4>
                </div>
            </div>
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            
                            <thead>
                                <tr>
                                    <th><?php echo display('sl_no')?></th>
                                    <th><?php echo display('level')?></th>
                                    <th><?php echo display('bonus')?></th>
                                    <th><?php echo display('date')?></th>
                                    <th><?php echo display('status')?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if($level_info!=NULL){ 
                                    $i=1;
                                    foreach ($level_info as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $value->level_id;?></td>
                                    <td><?php echo $value->bonus;?></td>
                                    <td><?php echo $value->achive_date;?></td>
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