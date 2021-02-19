<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd ">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('my_generation')?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="border_preview">

                    <?php
                        if(@$level_one['num']!=''){
                    ?>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#label1" data-toggle="tab"><?php echo display('generation_one');?></a></li>
                    <?php
                        if(@$level_two['num']!=''){
                    ?>
                        <li><a href="#label2" data-toggle="tab"><?php echo display('generation_two');?></a></li>
                    <?php
                       } if(@$level_three['num']!=''){
                    ?>   
                        <li><a href="#label3" data-toggle="tab"><?php echo display('generation_three');?></a></li>
                    <?php
                        } if(@$level_four['num']!='') {
                    ?>
                        <li><a href="#label4" data-toggle="tab"><?php echo display('generation_four');?></a></li>
                    <?php
                        } if(@$level_five['num']!=''){
                    ?>
                        <li><a href="#label5" data-toggle="tab"><?php echo display('generation_five');?></a></li>
                    <?php
                        }
                    ?>
                    </ul>
                    <!-- Tab panels -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="label1">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('user_id')?></th>
                                                <th><?php echo display('username')?></th>
                                                <th><?php echo display('name')?></th>
                                                <th><?php echo display('order_id')?></th>
                                                <th><?php echo display('amount')?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($level_one['num']))
                                                for ($i=1; $i<=$level_one['num'] ; $i++) {
                                                    foreach ($level_one['amount_'.$i] as $key => $value1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $level_one['user_id_'.$i]; ?></td>
                                                <td><?php echo $level_one['username_'.$i]; ?></td>
                                                <td><?php echo $level_one['name_'.$i]; ?></td>
                                                <td><?php echo $value1->order_id; ?></td>
                                                <td><?php echo $value1->amount; ?></td>
                                            </tr>
                                            <?php } } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="label2">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('user_id')?></th>
                                                <th><?php echo display('username')?></th>
                                                <th><?php echo display('name')?></th>
                                                <th><?php echo display('order_id')?></th>
                                                <th><?php echo display('amount')?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($level_two['num']))
                                                for ($i=1; $i<=$level_two['num']; $i++) { 
                                                    foreach ($level_two['amount_'.$i] as $key => $value2) {
                                            ?>
                                            <tr>
                                                <td><?php echo $level_two['user_id_'.$i]; ?></td>
                                                <td><?php echo $level_two['username_'.$i]; ?></td>
                                                <td><?php echo $level_two['name_'.$i]; ?></td>
                                                <td><?php echo $value2->order_id; ?></td>
                                                <td><?php echo $value2->amount; ?></td>
                                            </tr>
                                            <?php } } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="label3">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('user_id')?></th>
                                                <th><?php echo display('username')?></th>
                                                <th><?php echo display('name')?></th>
                                                <th><?php echo display('order_id')?></th>
                                                <th><?php echo display('amount')?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($level_three['num']))
                                                for ($i=1; $i<=$level_three['num']; $i++) {
                                                    foreach ($level_three['amount_'.$i] as $key => $value3) {
                                            ?>
                                            <tr>
                                                <td><?php echo $level_three['user_id_'.$i]; ?></td>
                                                <td><?php echo $level_three['username_'.$i]; ?></td>
                                                <td><?php echo $level_three['name_'.$i]; ?></td>
                                                <td><?php echo $value3->order_id; ?></td>
                                                <td><?php echo $value3->amount; ?></td>
                                            </tr>
                                            <?php } } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="label4">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('user_id')?></th>
                                                <th><?php echo display('username')?></th>
                                                <th><?php echo display('name')?></th>
                                                <th><?php echo display('order_id')?></th>
                                                <th><?php echo display('amount')?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($level_four['num']))
                                                for ($i=1; $i<=$level_four['num']; $i++) { 
                                                    foreach ($level_four['amount_'.$i] as $key => $value4) {
                                            ?>
                                            <tr>
                                                <td><?php echo $level_four['user_id_'.$i]; ?></td>
                                                <td><?php echo $level_four['username_'.$i]; ?></td>
                                                <td><?php echo $level_four['name_'.$i]; ?></td>
                                                <td><?php echo $value4->order_id; ?></td>
                                                <td><?php echo $value4->amount; ?></td>
                                            </tr>
                                            <?php } } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="label5">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('user_id')?></th>
                                                <th><?php echo display('username')?></th>
                                                <th><?php echo display('name')?></th>
                                                <th><?php echo display('order_id')?></th>
                                                <th><?php echo display('amount')?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($level_five['num']))
                                                for ($i=1; $i<=@$level_five['num']; $i++) { 
                                                    foreach ($level_five['amount_'.$i] as $key => $value5) {
                                            ?>
                                            <tr>
                                                <td><?php echo $level_five['user_id_'.$i]; ?></td>
                                                <td><?php echo $level_five['username_'.$i]; ?></td>
                                                <td><?php echo $level_five['name_'.$i]; ?></td>
                                                <td><?php echo $value5->order_id; ?></td>
                                                <td><?php echo $value5->amount; ?></td>
                                            </tr>
                                            <?php } } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } else {?>
                        <div class="alert alert-danger"><?php echo display('generation_empty_message');?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>      