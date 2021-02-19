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
                            <th><?php echo display('currency_name') ?></th>
                            <th><?php echo display('currency_iso_code') ?></th>
                            <th><?php echo display('usd_exchange_rate') ?></th>
                            <th><?php echo display('currency_symbol') ?></th>
                            <th><?php echo display('symbol_position') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($local_currency)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($local_currency as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $value->currency_name; ?></td>
                            <td><?php echo $value->currency_iso_code; ?></td>
                            <td><?php echo $value->usd_exchange_rate; ?></td>
                            <td><?php echo $value->currency_symbol; ?></td>
                            <td><?php echo $value->currency_position; ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/local_currency/local_currency/form/$value->currency_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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

 