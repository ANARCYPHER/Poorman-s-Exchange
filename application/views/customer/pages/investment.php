<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd lobidrag ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('investment');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            
                            <thead>
                                <tr>
                                    <th><?php echo display('package_amount');?></th>
                                    <th><?php echo display('package_name');?></th>
                                    <th><?php echo display('package_deatils');?></th>
                                    <th><?php echo display('weekly_roi');?></th>
                                    <th><?php echo display('date');?></th>
                                 </tr>
                            </thead>

                            <tbody>
                                <?php if($invest!=NULL){ 
                                    foreach ($invest as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo $value->amount;?></td>
                                    <td><?php echo $value->package_name;?></td>
                                    <td><?php echo $value->package_deatils;?></td>
                                    <td>$<?php echo $value->weekly_roi;?></td>
                                    <td><?php echo $value->invest_date;?></td>
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