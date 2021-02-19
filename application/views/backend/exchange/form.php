<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('transection_info') ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group row">
                        <label for="transection_type" class="col-sm-4 col-form-label"><?php echo display('transection_type') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->transection_type ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('coin_name') ?></label>
                        <div class="col-sm-8">
                            <?php foreach ($currency as $key => $value) { ?>
                                <?php echo ($exchange->coin_id==$value->cid)?$value->name:'' ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="coin_amount" class="col-sm-4 col-form-label"><?php echo display('coin_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->coin_amount ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="usd_amount" class="col-sm-4 col-form-label"><?php echo display('usd_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->usd_amount ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="local_amount" class="col-sm-4 col-form-label"><?php echo display('local_amount') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->local_amount ?>
                        </div>
                    </div>
                    <?php if ($exchange->payment_method=='phone') { ?>                    
                    <div class='form-group row'>
                        <label for='om_name' class='col-sm-4 col-form-label'><?php echo display("om_name") ?></label>
                        <div class='col-sm-8'>
                            <?php echo $exchange->om_name ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='om_mobile' class='col-sm-4 col-form-label'><?php echo display("om_mobile_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo $exchange->om_mobile ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='transaction_no' class='col-sm-4 col-form-label'><?php echo display("transaction_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo $exchange->transaction_no ?>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='idcard_no' class='col-sm-4 col-form-label'><?php echo display("idcard_no") ?></label>
                        <div class='col-sm-8'>
                            <?php echo $exchange->idcard_no ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($exchange->document_status==1) { ?>
                    <div class="form-group row">
                        <label for="document" class="col-sm-4 col-form-label"><?php echo display('upload_docunemts') ?></label>
                        <div class="col-sm-8">
                            <a class="btn btn-success w-md m-b-5" download="<?php echo $userinfo->user_id ?>" href="<?php echo base_url($this->db->select('doc_url')->from('ext_document')->where('ext_exchange_id',$exchange->ext_exchange_id)->get()->row()->doc_url); ?>">Download File</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
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
                        <label for="username" class="col-sm-4 col-form-label"><?php echo display('username') ?></label>
                        <div class="col-sm-8">
                            <?php echo $userinfo->f_name." ".$userinfo->l_name; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-4 col-form-label"><?php echo display('user_id') ?></label>
                        <div class="col-sm-8">
                            <?php echo $userinfo->user_id ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label"><?php echo display('email') ?></label>
                        <div class="col-sm-8">
                            <?php echo $userinfo->email ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label"><?php echo display('mobile') ?></label>
                        <div class="col-sm-8">
                            <?php echo $userinfo->phone ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reg_ip" class="col-sm-4 col-form-label"><?php echo display('registered_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo $userinfo->reg_ip ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="request_ip" class="col-sm-4 col-form-label"><?php echo display('requested_ip') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->request_ip ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
/* The container */
.i-check {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.i-check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* When the checkbox is checked, add a blue background */
.i-check input:checked ~ .checkmark {
    background-color: #37a000;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.i-check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.i-check .checkmark:after {
    left: 9px;
    top: 5px;
    width: 8px;
    height: 14px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo display('transaction_status') ?></h2>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if($exchange->status==0) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-5 col-form-label"><?php echo display('exchange') ?></label>
                        <div class="col-sm-7">
                            <h1>Canceled </h1><span> canceled by- <?php echo $exchange->receive_by ?></span>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-4 col-form-label"><?php echo display('payment_method') ?></label>
                        <div class="col-sm-8">
                            <?php echo $exchange->payment_method ?>
                        </div>
                    </div>
                    <?php if($exchange->receive_status==1) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('receive_status') ?></label>
                        <div class="col-sm-8">
                            <h1><?php echo display('receive_complete') ?></h1><span> Received by-<?php echo $exchange->receive_by ?></span>
                        </div>
                    </div>
                    <?php if($exchange->payment_status==1) { ?>
                    <div class="form-group row">
                        <label for="cid" class="col-sm-4 col-form-label"><?php echo display('payment_status') ?></label>
                        <div class="col-sm-8">
                            <h1><?php echo display('payment_complete') ?></h1><span> Payment by-<?php echo $exchange->payment_by ?></span>
                        </div>
                    </div>
                    <?php } else{ ?>
                    <div class="form-group row">
                        <label for="payment_status" class="col-sm-4 col-form-label"><?php echo display('payment_status') ?></label>
                        <div class="col-sm-8 payment_complete">
                            <?php echo form_hidden('ext_exchange_id', $exchange->ext_exchange_id) ?>
                            <div class="i-check">
                                <label for="payment_status">
                                    <input tabindex="5" type="checkbox" id="payment_status" name="payment_status" value="pay">Check
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                    <?php } else{ ?>
                    <div class="form-group row">
                        <label for="receving_status" class="col-sm-4 col-form-label"><?php echo display('receive_status') ?></label>
                        <div class="col-sm-8 receving_complete">
                            <?php echo form_hidden('ext_exchange_id', $exchange->ext_exchange_id) ?>
                            <div class="i-check">
                                <label for="receving_status">
                                    <input tabindex="5" type="checkbox" id="receving_status" name="receving_status" value="res">Check
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8 status">
                            <?php echo form_hidden('ext_exchange_id', $exchange->ext_exchange_id) ?>
                            <div class="i-check">
                                <label for="status">
                                    <input tabindex="5" type="checkbox" id="status" name="status" value="cancel">Cancel
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                                       
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajax Payable -->
<script type="text/javascript">
    $(function(){
      $("#receving_status").on("click", function(event) {
            //event.preventDefault();
            if ($('#receving_status').is(':checked')){
                window.setTimeout(function(){
                    $( ".receving_complete .i-check").html("<label for='receving_status_confirm'><input tabindex='5' type='checkbox' id='receving_status_confirm' name='receving_status_confirm' value='resconf'>Confirm <i class='fa fa-spinner fa-spin' style='font-size:24px'></i><span class='checkmark'></span></label>");

                    $("#receving_status_confirm").on("click", function(event) {
                        if ($('#receving_status_confirm').is(':checked')){

                            var receving_status = $("#receving_status").val();
                            var receving_status_confirm = $("#receving_status_confirm").val();
                            var ext_exchange_id = "<?php echo $exchange->ext_exchange_id; ?>";
                            var inputdata = "receving_status="+receving_status+"&receving_status_confirm="+receving_status_confirm+"&ext_exchange_id="+ext_exchange_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                            $.ajax({
                                url: "<?php echo base_url('backend/exchange/exchange/receiveConfirm'); ?>",
                                type: "post",
                                data: inputdata,
                                success: function(data) {
                                    $( ".receving_complete .i-check").html(data);
                                    location.reload();
                                },
                                error: function(){
                                   $( ".receving_complete").html("<h1>Error</h1>");
                                   location.reload();
                                }
                            });
                        }

                    });

                }, 500);
            }
        });
   });
    $(function(){
      $("#payment_status").on("click", function(event) {
            //event.preventDefault();
            if ($('#payment_status').is(':checked')){
               window.setTimeout(function(){
                    $( ".payment_complete .i-check").html("<label for='payment_status_confirm'><input tabindex='5' type='checkbox' id='payment_status_confirm' name='payment_status_confirm' value='resconf'>Confirm <i class='fa fa-spinner fa-spin' style='font-size:24px'></i><span class='checkmark'></span></label>");

                    $("#payment_status_confirm").on("click", function(event) {
                        if ($('#payment_status_confirm').is(':checked')){

                            var payment_status = $("#payment_status").val();
                            var payment_status_confirm = $("#payment_status_confirm").val();
                            var ext_exchange_id = "<?php echo $exchange->ext_exchange_id; ?>";
                            var inputdata = "payment_status="+payment_status+"&payment_status_confirm="+payment_status_confirm+"&ext_exchange_id="+ext_exchange_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                            $.ajax({
                                url: "<?php echo base_url('backend/exchange/exchange/receiveConfirm'); ?>",
                                type: "post",
                                data: inputdata,
                                success: function(data) {
                                    $( ".payment_complete .i-check").html(data);
                                    location.reload();
                                },
                                error: function(){
                                   $( ".payment_complete").html("<h1>Error</h1>");
                                   location.reload();
                                }
                            });
                        }

                    });

                }, 500);
            }
        });
   }); 
    $(function(){
      $("#status").on("click", function(event) {
            //event.preventDefault();
            if ($('#status').is(':checked')){
               window.setTimeout(function(){
                    var status = $("#status").val();
                    var ext_exchange_id = "<?php echo $exchange->ext_exchange_id; ?>";
                    var inputdata = "status="+status+"&ext_exchange_id="+ext_exchange_id+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                    $.ajax({
                        url: "<?php echo base_url('backend/exchange/exchange/receiveConfirm'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(data) {
                            $( ".payment_complete .i-check").html(data);
                            location.reload();
                        },
                        error: function(){
                           $( ".payment_complete").html("<h1>Error</h1>");
                           location.reload();
                        }
                    });

                }, 500);
            }
        });
   }); 
</script>



 