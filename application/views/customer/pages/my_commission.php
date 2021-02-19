<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('my_commission');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('date');?></th>
                                <th><?php echo display('name');?></th>
                                <th><?php echo display('package_name');?></th>
                                <th><?php echo display('amount');?></th>
                                <th><?php echo display('action');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($my_commission){
                                foreach ($my_commission as $key => $value) {
                            ?>
                            
                            <tr>
                                <td><?php echo $value->date;?></td>
                                <td><?php echo $value->f_name.' '.$value->l_name;?></td>
                                <td><?php echo $value->package_name;?></td>
                                <td>$<?php echo $value->amount;?></td>
                                <td><a href="<?php echo base_url()?>customer/commission/commission_receipt/<?php echo $value->earning_id;?>" class="btn btn-success btn-xs">View</a></td>
                            </tr>

                            <?php  } }?>
                            
                        </tbody>
                    </table>
                    <?php echo $links; ?>
                </div>
            </div>
        </div>
    </div>
</div>