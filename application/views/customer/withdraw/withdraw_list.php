<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('withdraw_list');?></h4>
                </div>
            </div>

            <div class="panel-body">
                <div class="border_preview">
                    <div class="table-responsive">
                        <table class="datatable2 table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo display('name');?></th>
                                    <th><?php echo display('mobile');?></th>
                                    <th><?php echo display('amount');?></th>
                                    <th><?php echo display('wallet_id');?></th>
                                    <th><?php echo display('payment_method');?></th>
                                    <th><?php echo display('date');?></th>
                                    <th><?php echo display('status');?></th>
                                    <th><?php echo display('action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($withdraw!=NULL){ 
                                    $user_id = $this->session->userdata('user_id');
                                    foreach ($withdraw as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $this->session->userdata('fullname');?></td>
                                    <td><?php echo $this->session->userdata('phone');?></td>
                                    
                                        <td><?php echo $value->amount;?></td>
                                        <td><?php echo $value->walletid;?></td>
                                        <td><?php echo $value->method;?></td>
                                        <td><?php echo $value->request_date;?></td>
                                    <td>
                                        <?php 
                                        if($value->status==1){
                                            echo ('<b class="text-warning">Panding</b>');
                                        }else if($value->status==2){
                                            echo ('<b class="text-success">Success</b>');
                                        }else{
                                            echo ('<b class="text-danger">Cancel</b>');
                                        }
                                        ?>
                                            
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="<?php echo base_url(); ?>customer/withdraw/withdraw_details/<?php echo $value->withdraw_id;?>"><?php echo display('details')?></a>
                                    </td>
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
</div>