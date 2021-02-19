<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="img-responsive" alt="">
                        <br>
                        <address>
                            <strong><?= $settings->title ?></strong><br>
                            <?php echo $settings->description;?><br>
                            
                        </address>
                        
                    </div>
                    <div class="col-sm-6 text-right">
                        <h1 class="m-t-0">Purchase Order No : </h1>
                        <div><?php echo date('d-M-Y');?></div>
                        <address>
                            <strong><?php echo $my_info->f_name.' '.$my_info->l_name;?></strong><br>
                            <?php echo $my_info->email;?><br>
                            <?php echo $my_info->phone;?><br>
                            <abbr title="Phone">Account :</abbr> <?php echo $my_info->user_id;?>
                        </address>
                    </div>
                </div> <hr>
                <div class="table-responsive m-b-20">
                    <table class="table table-border table-bordered ">
                        <thead>
                            <tr>
                                <th><?php echo display('package_name')?></th>
                                <th><?php echo display('details')?></th>
                                <th><?php echo display('amount')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $package->package_name;?></td>
                                <td><div><strong><?php echo $package->package_deatils;?></strong></div>
                                <td>$<?php echo $package->package_amount;?></td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="panel-footer text-right">
                <a href="<?php echo base_url('customer/package/buy/').$package->package_id;?>" class="btn btn-success"> Confirm</a>
                <a href="<?php echo base_url('customer/home')?>" class="btn btn-danger"> <?php echo display('cancel');?></a>
            </div>
        </div>
    </div>
</div>