<?php
$cat_title1  = isset($lang) && $lang =="french"?$cat_info->cat_title1_fr:$cat_info->cat_title1_en;
$cat_title2  = isset($lang) && $lang =="french"?$cat_info->cat_title2_fr:$cat_info->cat_title2_en;
?>
        <div class="page_header" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1><?php echo $cat_title1; ?></h1>
                                <p><?php echo $cat_title2; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->
        <div class="buySell_content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <!-- alert message -->
                        <?php if ($this->session->flashdata('message') != null) {  ?>
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('message'); ?>
                        </div> 
                        <?php } ?>                                
                        <?php if ($this->session->flashdata('exception') != null) {  ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $this->session->flashdata('exception'); ?>
                        </div>
                        <?php } ?>                                
                        <?php if (validation_errors()) {  ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo validation_errors(); ?>
                        </div>
                        <?php } ?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-content">
                            <?php echo form_open_multipart("sells",'id="sellform"  class="form-horizontal" name="sellform"'); ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo display("cryptocurrency") ?></label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" data-width="100%" name="cid" id="cid">
                                            <option value=""><?php echo display("select_cryptocurrency") ?></option>
                                            <?php foreach ($currency as $key => $value) {  ?>
                                                 <option value="<?php echo $value->coin_id; ?>"><?php echo $value->coin_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo display("sell_amount") ?></label>
                                    <div class="col-sm-8">
                                        <input name="sell_amount" type="text" class="form-control input-solid sell_amount" id="sell_amount" autocomplete="off" disabled>
                                    </div>
                                </div>
                                <span class="sell_payable">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <h3 class="form-title"><?php echo display("rate") ?>:</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo display("currency") ?></th>
                                                        <th><?php echo display("payable") ?></th>
                                                        <th><?php echo display("rate") ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>USD</td>
                                                        <td>$</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $selectedlocalcurrency->currency_name; ?></td>
                                                        <td><?php echo $selectedlocalcurrency->currency_symbol; ?></td>
                                                        <td>0</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Your <i></i> <?php echo display("wallet_data") ?></label>
                                    <div class="col-sm-8">
                                        <input name="wallet_id" class="form-control" type="text" id="wallet_id" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Company <i></i> <?php echo display("wallet_data") ?></label>
                                    <div class="col-sm-8">
                                        <input name="cwallet_id" class="form-control" type="text" id="cwallet_id" disabled autocomplete="off">
                                    </div>
                                </div>
                                </span>
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <h3 class="form-title"><?php echo display("how_do_you_receive_money") ?>:</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label"><?php echo display("withdraw_method") ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-solid" name="payment_method" id="payment_method">
                                            <option value=""><?php echo display("select_withdraw_method") ?></option>
                                            <?php foreach ($payment_gateway as $key => $value) {  ?>
                                            <option value="<?php echo $value->identity; ?>"><?php echo $value->agent; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <span class="payment_info">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label comments_level"><?php echo display("account_info") ?></label>
                                        <div class="col-sm-8">
                                            <textarea name="comments" class="form-control input-solid" placeholder="" type="text" id="comments"></textarea>
                                        </div>
                                    </div>
                                </span>
                                <div class="form-group ">
                                    <label for="document" class="col-sm-4 control-label"><?php echo display('upload_docunemts'); ?></label>
                                    <div class="col-sm-8">
                                         <input name="document" class="form-control input-solid" type="file" id="document">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-default mr-10"><?php echo display("sell") ?></button>
                                        <button type="submit" class="btn btn-orange"><?php echo display("cancel") ?></button>
                                    </div>
                                </div>
                            <?php echo form_close() ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.End of buy & sell content -->