<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
 
                <div class="">
                    <table class="datatable2 table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('image') ?></th>
                                <th><?php echo display('fullname') ?></th>
                                <th><?php echo display('email') ?></th>
                                <th><?php echo display('about') ?></th>
                                <th><?php echo display('last_login') ?></th>
                                <th><?php echo display('last_logout') ?></th>
                                <th><?php echo display('ip_address') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admin)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($admin as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><img src="<?php echo base_url(!empty($value->image)?$value->image:'assets/images/icons/user.png'); ?>" alt="Image" height="64" ></td>
                                <td><?php echo $value->fullname; ?></td>
                                <td><?php echo $value->email; ?></td>
                                <td><?php echo character_limiter($value->about, 20); ?></td>
                                <td><?php echo $value->last_login; ?></td>
                                <td><?php echo $value->last_logout; ?></td>
                                <td><?php echo $value->ip_address; ?></td>
                                <td><?php echo (($value->status==1)?display('active'):display('inactive')); ?></td>
                                <td>
                                    <?php if ($value->is_admin == 1) { ?>
                                    <button class="btn btn-info btn-sm" title="<?php echo display('admin') ?>"><?php echo display('admin') ?></button>
                                    <?php } else { ?> 
                                    <button class="btn btn-info btn-sm" title="<?php echo display('sub_admin') ?>"><?php echo display('sub_admin') ?></button> <br><br>
                                    <a href="<?php echo base_url("backend/dashboard/admin/form/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="<?php echo base_url("backend/dashboard/admin/delete/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

 