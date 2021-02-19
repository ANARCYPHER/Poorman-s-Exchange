<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('user_info') ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('user_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->user_id ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('username') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->username ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('sponsor_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->sponsor_id ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('language') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->language ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('firstname') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->f_name ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('lastname') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->l_name ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('email') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->email ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('mobile') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->phone ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('registered_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo $user->reg_ip ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <?php echo ($user->status==1)?display('active'):display('inactive'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label">Registered Date</label>
                        <div class="col-sm-8">
                            <?php 
                                $date=date_create($user->created);
                                echo date_format($date,"jS F Y");  
                            ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>














    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Deposit<?php //echo display('user_info') ?></h2>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('deposit_amount') ?></th> 
                                <th><?php echo display('deposit_method') ?></th> 
                                <th><?php echo display('date') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($deposit)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($deposit as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->deposit_amount; ?></td>
                                <td><?php echo $value->deposit_method; ?></td>
                                <td><?php 
                                        $date=date_create($value->deposit_date);
                                        echo date_format($date,"jS F Y"); ?></td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Investment<?php //echo display('user_info') ?></h2>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('sponsor_id') ?></th> 
                                <th><?php echo display('amount') ?></th> 
                                <th><?php echo display('date') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($investment)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($investment as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->sponsor_id; ?></td>
                                <td><?php echo $value->amount; ?></td>
                                <td>
                                    <?php 
                                        $date=date_create($value->invest_date);
                                        echo date_format($date,"jS F Y"); 
                                    ?>
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


 