<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <br>
            <?php if ($social_app->agent!=='reCAPTCHA') { ?>
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Valid OAuth redirect URIs/Authorized redirect URIs</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="copyed" value="<?php echo base_url(($social_app->agent=='Facebook')?'user_authentication/fblogin':'user_authentication/glogin'); ?>" readonly>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" onclick="myFunction()">Copy</button>
                        </span>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("backend/cms/social_app/form/$social_app->id") ?>
                <?php echo form_hidden('id', $social_app->id) ?>
                    <?php if ($social_app->agent!=='reCAPTCHA') { ?>
                    <div class="form-group row">
                        <label for="app_id" class="col-sm-4 col-form-label"><?php echo display('app_id') ?></label>
                        <div class="col-sm-8">
                            <input name="app_id" value="<?php echo $social_app->app_id ?>" class="form-control" type="text" id="app_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="app_secret" class="col-sm-4 col-form-label"><?php echo display('app_secret') ?></label>
                        <div class="col-sm-8">
                            <input name="app_secret" value="<?php echo $social_app->app_secret ?>" class="form-control" type="text" id="app_secret">
                        </div>
                    </div> 
                    <?php } ?>
                    <?php if ($social_app->agent=='Google') { ?>
                    <div class="form-group row">
                        <label for="api_key" class="col-sm-4 col-form-label"><?php echo display('api_key') ?></label>
                        <div class="col-sm-8">
                            <input name="api_key" value="<?php echo $social_app->api_key ?>" class="form-control" type="text" id="api_key">
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($social_app->agent=='reCAPTCHA') { ?>
                    <div class="form-group row">
                        <label for="api_key" class="col-sm-4 col-form-label">Site key</label>
                        <div class="col-sm-8">
                            <input name="api_key" value="<?php echo $social_app->api_key ?>" class="form-control" type="text" id="api_key">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="app_secret" class="col-sm-4 col-form-label">Secret key</label>
                        <div class="col-sm-8">
                            <input name="app_secret" value="<?php echo $social_app->app_secret ?>" class="form-control" type="text" id="app_secret">
                        </div>
                    </div> 
                    <?php } ?>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($social_app->status==1 || $social_app->status==null)?true:false)); ?><?php echo display('active') ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($social_app->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $social_app->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function myFunction() {
  var copyText = document.getElementById("copyed");
  copyText.select();
  document.execCommand("Copy");
}
</script>

 