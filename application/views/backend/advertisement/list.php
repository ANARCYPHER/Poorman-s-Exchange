<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("backend/cms/advertisement/form") ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display('add_advertisement') ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('image') ?></th>
                            <th><?php echo display('embed_code') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($advertisement)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($advertisement as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $value->name; ?></td>
                            <td><a href="<?php echo $value->url; ?>">
                                <?php if (!empty($value->image)) { ?>
                                    <img src="<?php echo base_url($value->image); ?>" width="350" />
                                <?php } ?>
                                </a>
                            </td>
                            <td><?php echo $value->script; ?></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/cms/advertisement/form/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="<?php echo base_url("backend/cms/advertisement/delete/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

 