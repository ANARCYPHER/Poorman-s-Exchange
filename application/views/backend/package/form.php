<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                <div class="border_preview">
                <?php echo form_open_multipart("backend/package/package/form/$package->package_id") ?>
                <?php echo form_hidden('package_id', $package->package_id) ?> 

                    <div class="form-group row">
                        <label for="package_name" class="col-sm-4 col-form-label"><?php echo display('package_name') ?> *</label>
                        <div class="col-sm-8">
                            <input name="package_name" value="<?php echo $package->package_name ?>" class="form-control" placeholder="<?php echo display('package_name') ?>" type="text" id="package_name" data-toggle="tooltip" title="<?php echo display('tooltip_package_name') ?> ">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="period" class="col-sm-4 col-form-label"><?php echo display('period') ?> *</label>
                        <div class="col-sm-8">
                            <input name="period" value="<?php echo $package->period ?>" class="form-control" placeholder="<?php echo display('period') ?>" type="text" id="period" data-toggle="tooltip" title="<?php echo display('tooltip_package_period') ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="package_deatils" class="col-sm-4 col-form-label"><?php echo display('package_deatils') ?> </label>
                        <div class="col-sm-8">
                            <textarea name="package_deatils" class="form-control" placeholder="<?php echo display('package_deatils') ?>" type="text" id="package_deatils" data-toggle="tooltip" title="<?php echo display('tooltip_package_details') ?>"><?php echo $package->package_deatils ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="package_amount" class="col-sm-4 col-form-label"><?php echo display('package_amount') ?> *</label>
                        <div class="col-sm-8">
                            <input name="package_amount" value="<?php echo $package->package_amount ?>" class="form-control" placeholder="<?php echo display('package_amount') ?>" type="text" id="package_amount" data-toggle="tooltip" title="<?php echo display('tooltip_package_amount') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="daily_roi" class="col-sm-4 col-form-label"><?php echo display('daily_roi') ?> *</label>
                        <div class="col-sm-8">
                            <input name="daily_roi" value="<?php echo $package->daily_roi ?>" class="form-control" placeholder="<?php echo display('daily_roi') ?>" type="text" id="daily_roi" data-toggle="tooltip" title="<?php echo display('tooltip_package_daily_roi') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="weekly_roi" class="col-sm-4 col-form-label"><?php echo display('weekly_roi') ?> *</label>
                        <div class="col-sm-8">
                            <input name="weekly_roi" value="<?php echo $package->weekly_roi ?>" class="form-control" placeholder="<?php echo display('weekly_roi') ?>" type="text" id="weekly_roi" data-toggle="tooltip" title="<?php echo display('tooltip_package_weekly_roi') ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monthly_roi" class="col-sm-4 col-form-label"><?php echo display('monthly_roi') ?> *</label>
                        <div class="col-sm-8">
                            <input name="monthly_roi" value="<?php echo $package->monthly_roi ?>" class="form-control" placeholder="<?php echo display('monthly_roi') ?>" type="text" id="monthly_roi" data-toggle="tooltip" title="<?php echo display('tooltip_package_monthly_roi') ?> " readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="yearly_roi" class="col-sm-4 col-form-label"><?php echo display('yearly_roi') ?> *</label>
                        <div class="col-sm-8">
                            <input name="yearly_roi" value="<?php echo $package->yearly_roi ?>" class="form-control" placeholder="<?php echo display('yearly_roi') ?>" type="text" id="yearly_roi" data-toggle="tooltip" title="<?php echo display('tooltip_package_yearly_roi') ?> " readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_percent" class="col-sm-4 col-form-label"><?php echo display('total_percent') ?> %*</label>
                        <div class="col-sm-8">
                            <input name="total_percent" value="<?php echo $package->total_percent ?>" class="form-control" placeholder="<?php echo display('total_percent') ?>" type="text" id="total_percent" data-toggle="tooltip" title="<?php echo display('tooltip_package_total_percent_roi') ?> " readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?> *</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($package->status==1 || $package->status==null)?true:false)); ?><?php echo display('active') ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($package->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                             </label> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $package->package_id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajax Payable -->
<script type="text/javascript">
    $(function(){
        var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
        if (weekly_roi>0) {
            $( "#weekly_roi" ).prop( "disabled", false);
        }

        $("#package_amount").on("keyup", function(event) {
            event.preventDefault();
            var package_amount  = parseFloat($("#package_amount").val())|| 0;

            if (package_amount>0) {

                $( "#weekly_roi" ).prop( "disabled", false);

                var package_amount  = parseFloat($("#package_amount").val())|| 0;
                var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
                var monthly_roi     = parseFloat($("#monthly_roi").val())|| 0;
                var yearly_roi      = parseFloat($("#yearly_roi").val())|| 0;
                var total_percent   = parseFloat($("#total_percent").val())|| 0;

                if (weekly_roi>0) {
                    if (package_amount) {
                        monthly_roi     = (365/12)/7*weekly_roi;
                        yearly_roi      = monthly_roi*12;
                        total_percent   = (100*yearly_roi)/package_amount;

                        $("#monthly_roi").val(Math.round(monthly_roi));
                        $("#yearly_roi").val(Math.round(yearly_roi));
                        $("#total_percent").val(Math.round(total_percent));

                    }else{
                        alert("Please Enter Package amount!");
                        return false;

                    }
                }else{
                    $("#daily_roi").val(0);
                    $("#weekly_roi").val(0);
                    $("#monthly_roi").val(0);
                    $("#yearly_roi").val(0);
                    $("#total_percent").val(0);
                }

            }
            else{
                $( "#weekly_roi" ).prop( "disabled", true);
                
            }

        });

    }); 

    $(function(){
        $("#weekly_roi").on("keyup", function(event) {
            event.preventDefault();
            var package_amount  = parseFloat($("#package_amount").val())|| 0;
            var weekly_roi      = parseFloat($("#weekly_roi").val())|| 0;
            var monthly_roi     = parseFloat($("#monthly_roi").val())|| 0;
            var yearly_roi      = parseFloat($("#yearly_roi").val())|| 0;
            var total_percent   = parseFloat($("#total_percent").val())|| 0;


            if (package_amount) {
                monthly_roi     = (365/12)/7*weekly_roi;
                yearly_roi      = monthly_roi*12;
                total_percent   = (100*yearly_roi)/package_amount;

                $("#monthly_roi").val(Math.round(monthly_roi));
                $("#yearly_roi").val(Math.round(yearly_roi));
                $("#total_percent").val(Math.round(total_percent));

            }else{
                alert("Please Enter Package amount!");
                return false;

            }

        });

    }); 
</script>



 