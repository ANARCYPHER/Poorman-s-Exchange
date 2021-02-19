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
                            <th><?php echo display('package_name') ?></th>
                            <th><?php echo display('package_deatils') ?></th>
                            <th><?php echo display('package_amount') ?></th>
                            <th><?php echo display('daily_roi') ?></th>
                            <th><?php echo display('weekly_roi') ?></th>
                            <th><?php echo display('monthly_roi') ?></th>
                            <th><?php echo display('yearly_roi') ?></th>
                            <th><?php echo display('total_percent') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($package)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($package as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $value->package_name; ?></td>
                            <td><?php echo $value->package_deatils; ?></td>
                            <td><?php echo $value->package_amount; ?></td>
                            <td><?php echo $value->daily_roi; ?></td>
                            <td><?php echo $value->weekly_roi; ?></td>
                            <td><?php echo $value->monthly_roi; ?></td>
                            <td><?php echo $value->yearly_roi; ?></td>
                            <td><?php echo $value->total_percent; ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/package/package/form/$value->package_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="<?php echo base_url("backend/package/package/delete/$value->package_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 