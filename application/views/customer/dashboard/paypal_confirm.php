<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('deposit'); ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="border_preview">
                        <table class="table table-bordered">
                            <tr>
                                <th><?php echo display("user_id") ?></th>
                                <td class="text-right"><?php echo $user_id; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo display("usd_amount") ?></th>
                                <td class="text-right">$<?php echo $deposit_amount ?></td>
                            </tr>
                        </table>

                        <a class="btn btn-success w-md m-b-5 text-right" href="<?php echo $approval_url ?>">Payment Process</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 