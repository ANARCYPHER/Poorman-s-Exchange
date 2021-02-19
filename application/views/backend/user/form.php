<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart("backend/user/user/form/$user->uid") ?>
                <?php echo form_hidden('uid', $user->uid) ?>
                <?php echo form_hidden('user_id', $user->user_id) ?>
                <?php $user_id = $this->db->select('user_id')->where('sponsor_id', 0)->get('user_registration')->row(); ?>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label><?php echo display("username") ?> *</label>
                            <input type="text" value="<?php echo $user->username ?>" class="form-control" name="username" placeholder="<?php echo display("username") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("sponsor_id") ?> *</label>
                            <input type="text" value="<?php echo $user->sponsor_id!=''?$user->sponsor_id:$user_id->user_id ?>" class="form-control" <?php echo $user->uid?'readonly':'' ?> name="sponsor_id" placeholder="<?php echo display("sponsor_name") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("firstname") ?> *</label>
                            <input type="text" value="<?php echo $user->f_name ?>" class="form-control" name="f_name" placeholder="<?php echo display("firstname") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("lastname") ?> *</label>
                            <input type="text" value="<?php echo $user->l_name ?>" class="form-control" name="l_name" placeholder="<?php echo display("lastname") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("email") ?> *</label>
                            <input type="text" value="<?php echo $user->email ?>" class="form-control" name="email" placeholder="<?php echo display("email") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("mobile") ?> *</label>
                            <input type="text" value="<?php echo $user->phone ?>" id="mobile" class="form-control" name="mobile" placeholder="<?php echo display("mobile") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("password") ?> *</label>
                            <input type="password" value="" class="form-control" name="password" placeholder="<?php echo display("password") ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label><?php echo display("conf_password") ?> *</label>
                            <input type="password" value="" class="form-control" name="conf_password" placeholder="<?php echo display("conf_password") ?>">
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="status" class="col-sm-3 col-form-label">Status *</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '1', (($user->status==1 || $user->status==null)?true:false)); ?><?php echo display('active') ?>
                                </label>
                                <label class="radio-inline">
                                    <?php echo form_radio('status', '0', (($user->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                                </label> 
                            </div>
                        </div>

                    </div> 
                    <div>
                        <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary"><?php echo display("cancel") ?></a>
                        <button type="submit" class="btn btn-success"><?php echo $user->uid?display("update"):display("register") ?></button>
                    </div>

                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

 