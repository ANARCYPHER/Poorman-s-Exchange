<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('backend/dashboard/setting/index','class="form-inner"') ?>
                            <?php echo form_hidden('setting_id',$setting->setting_id) ?>

                            <div class="form-group row">
                                <label for="title" class="col-xs-3 col-form-label"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo $setting->title ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                                <div class="col-xs-9">
                                    <input name="description" type="text" class="form-control" id="description" placeholder="<?php echo display('address') ?>"  value="<?php echo $setting->description ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                                <div class="col-xs-9">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $setting->email ?>">
                                </div>
                            </div>
 
                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                                <div class="col-xs-9">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo $setting->phone ?>" >
                                </div>
                            </div>


                            <!-- if setting favicon is already uploaded -->
                            <?php if(!empty($setting->favicon)) {  ?>
                            <div class="form-group row">
                                <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('favicon') ?> </label>
                                <div class="col-xs-9">
                                    <input type="file" name="favicon" id="favicon">
                                    <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                                </div>
                            </div>


                            <!-- if setting logo is already uploaded -->
                            <?php if(!empty($setting->logo)) {  ?>
                            <div class="form-group row">
                                <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="logo" class="col-xs-3 col-form-label"><?php echo display('dashboard_logo') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="logo" id="logo">
                                    <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                                </div>
                            </div>


                            <!-- if setting Web logo is already uploaded -->
                            <?php if(!empty($setting->logo_web)) {  ?>
                            <div class="form-group row">
                                <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($setting->logo_web) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="logo_web" class="col-xs-3 col-form-label"><?php echo display('logo_web') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="logo_web" id="logo_web">
                                    <input type="hidden" name="old_web_logo" value="<?php echo $setting->logo_web ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('language') ?></label>
                                <div class="col-xs-9">
                                    <?= form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="time_zone" class="col-xs-3 col-form-label"><?php echo display('time_zone') ?>  <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <select id="time_zone" name="time_zone" class="form-control">
                                        <option value=""><?php echo display('select_option') ?></option>
                                        <?php foreach (timezone_identifiers_list() as $value) { ?>
                                            <option value="<?php echo $value ?>" <?php echo (($setting->time_zone==$value)?'selected':null) ?>><?php echo $value ?></option>";
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="left_to_right" class="col-xs-3 col-form-label"><?php echo display('admin_align') ?></label>
                                <div class="col-xs-9">
                                    <?= form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="office_time" class="col-xs-3 col-form-label"><?php echo display('office_time') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="office_time" class="form-control"  placeholder="<?php echo display('office_time') ?>" maxlength="255" rows="7"><?php echo $setting->office_time ?></textarea>
                                </div>
                            </div>  

                            <div class="form-group row">
                                <label for="latitude" class="col-xs-3 col-form-label"><?php echo display('latitudelongitude') ?></label>
                                <div class="col-xs-9">
                                    <input name="latitude" type="text" class="form-control" id="latitude" placeholder="<?php echo display('latitudelongitude') ?>"  value="<?php echo $setting->latitude ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('footer_text') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="7"><?php echo $setting->footer_text ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>

                        <div class="" style="margin: 0px 0px 10px 0px; background: #997300;padding: 10px;color: #fff;border: 3px dashed #1c506c;">
                            <h2>For Payout</h2>
                            <p>curl --request GET <?php echo base_url();?>customer/auto_commission/payout/ 
                            <br> You can use above link for cron job. Copy and paste at cron job Command box</p>
                            <h2>For Crypto Currency</h2>
                            <p>curl --request GET <?php echo base_url();?>backend/currency/Currency_cronjob/updateCurency/
                            <br> You can use above link for cron job. Copy and paste at cron job Command box</p>
                        </div>

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
