<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">
            <div class="panel-body"  id="printableArea">
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
                        <h1 class="m-t-0">Purchase Order No : <?php echo $this->uri->segment(5)?></h1>
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
               <button type="button" class="btn btn-info" onclick="printContent('printableArea')"><span class="fa fa-print"></span></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //print a div
    function printContent(el){
        var restorepage  = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        location.reload();
    }
</script>