
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('transection');?></h4>
                </div>
            </div>
            <div class="panel-body">
                        
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th><?php echo display('type');?></th>
                            <th><?php echo display('amount');?></th>
                            <th><?php echo display('fees');?></th>
                            <th><?php echo display('total');?></th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <th><?php echo display('diposit')?></th>
                                <td>$<?php echo (@$deposit?@$deposit:'0.00');?></td>
                                <td>$<?php echo (@$d_fees?@$d_fees:'0.00');?></td>
                                <td>$<?php echo $m_diposit = @$deposit-@$d_fees;?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('reciver')?></th>
                                <td>$<?php echo (@$reciver?@$reciver:'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                               <td>$<?php echo (@$reciver?@$reciver:'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('my_payout');?></th>
                                <td>$<?php echo (@$my_payout?@$my_payout:'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                               <td>$<?php echo (@$my_payout?@$my_payout:'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('commission');?></th>
                                <td>$<?php echo (@$commission?@$commission:'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$commission?@$commission:'0.00');?></td>
                            </tr>

                            <tr>
                                <th>Bonus</th>
                                <td>$<?php echo (@$bonuss?@$bonuss:'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$bonuss?@$bonuss:'0.00');?></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-success text-center"><?php echo display('total');?> =</td>
                                <td>$<?php  $plus = @$m_diposit+@$reciver+@$my_payout+@$commission+@$bonuss;
                                     echo (@$plus?@$plus:'0.00');
                                ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th><?php echo display('type');?></th>
                                    <th><?php echo display('amount');?></th>
                                    <th><?php echo display('fees');?></th>
                                    <th><?php echo display('total');?></th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <th><?php echo display('investment')?></th>
                                <td>$<?php echo (@$investment?@$investment:'0.00');?></td>
                                <td>$<?php echo '0.00';?></td>
                                <td>$<?php echo (@$investment?@$investment:'0.00');?></td>
                            </tr>

                            <tr>
                                <th><?php echo display('withdraw')?></th>
                                <td>$<?php echo (@$withdraw?@$withdraw:'0.00');?></td>
                                <td>$<?php echo (@$w_fees?@$w_fees:'0.00');?></td>

                                <td>$<?php echo $m_withdraw = @$withdraw-@$w_fees;?></td>
                            </tr>
                            <tr>
                                <th><?php echo display('transfer');?></th>
                                <td>$<?php echo (@$transfar?@$transfar:'0.00');?></td>
                                <td>$<?php echo (@$t_fees?@$t_fees:'0.00');?></td>
                                
                                <td>$<?php 
                                 @$m_transfer = @$transfar-@$t_fees;
                                 echo (@$m_transfer?@$m_transfer:'0.00');
                                ?></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-danger text-center">TOTAL = </td>
                                <td>$<?php $minus = @$investment+@$m_withdraw+@$m_transfer;
                                echo (@$minus?@$minus:'0.00');
                                ?></td>
                            </tr>

                            <tr >
                                <th colspan="4" class="text-success text-center"><?php echo display('your_total_balance_is');?> = $<?php echo @$plus-@$minus;?></th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="panel panel-bd ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('transection');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered datatable2">
                            <thead>
                                <tr>
                                    <th><?php echo display('date');?></th>
                                    <th><?php echo display('transection_category');?></th>
                                    <th><?php echo display('balance');?></th>
                                    <th><?php echo display('comment');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($transection!=NULL){ 
                                    foreach ($transection as $key => $value) {  
                                ?>
                                <tr>
                                    <td><?php echo $value->transection_date_timestamp;?></td>
                                    <td><?php echo $value->transection_category;?></td>
                                    <td><?php echo $value->amount;?></td>
                                    <td><?php echo $value->comments;?></td>
                                </tr>
                                <?php } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>