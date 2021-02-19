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
                            <th><?php echo display('sl_no')?></th>
                            <th><?php echo display('name')?></th>
                            <th><?php echo display('link')?></th>
                            <th><?php echo display('icon')?></th>
                            <th><?php echo display('status')?></th>
                            <th><?php echo display('action')?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($social_link)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($social_link as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $value->name; ?></td>
                            <td><?php echo $value->link; ?></td>
                            <td><h1><i class="fa fa-<?php echo $value->icon; ?>"></i></h1></td>
                            <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/cms/social_link/form/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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