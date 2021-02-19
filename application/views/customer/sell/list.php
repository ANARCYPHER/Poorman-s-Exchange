<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("customer/sell/form") ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display("sell") ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('coin_name') ?></th>
                            <th><?php echo display('coin_amount') ?></th>
                            <th><?php echo display('rate_coin') ?></th>
                            <th><?php echo display('usd_amount') ?></th>
                            <th><?php echo display('local_amount') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($sell)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($sell as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $this->db->select("coin_name")->from('ext_exchange_wallet')->where('coin_id', $value->coin_id)->get()->row()->coin_name; ?></td>
                            <td><?php echo $value->coin_amount; ?></td>
                            <td><?php echo $value->rate_coin; ?></td>
                            <td><?php echo $value->usd_amount; ?></td>
                            <td><?php echo $value->local_amount; ?></td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php echo $links; ?>
            </div> 
        </div>
    </div>
</div>

 