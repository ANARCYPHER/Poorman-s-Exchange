<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open_multipart("customer/profile/update") ?>
                <?php echo form_hidden('uid', $profile->uid) ?>
  
                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label><?php echo display("username") ?> *</label>
                            <input type="text" value="<?php echo $profile->username ?>" class="form-control" name="username" placeholder="<?php echo display("username") ?>" disabled>
                        </div>

                        <div class="form-group col-lg-6">
                            <label><?php echo display("sponsor_id") ?> *</label>
                            <input type="text" value="<?php echo $profile->sponsor_id ?>" class="form-control" name="sponsor_id" placeholder="<?php echo display("sponsor_name") ?>" disabled>
                        </div>

                        <div class="form-group col-lg-6">
                            <label><?php echo display("firstname") ?> *</label>
                            <input type="text" value="<?php echo $profile->f_name ?>" class="form-control" name="f_name" placeholder="<?php echo display("firstname") ?>">
                        </div>

                        <div class="form-group col-lg-6">
                            <label><?php echo display("lastname") ?> *</label>
                            <input type="text" value="<?php echo $profile->l_name ?>" class="form-control" name="l_name" placeholder="<?php echo display("lastname") ?>">
                        </div>

                        <div class="form-group col-lg-6">
                            <label><?php echo display("email") ?> *</label>
                            <input type="text" value="<?php echo $profile->email ?>" class="form-control" name="email" placeholder="<?php echo display("email") ?>">
                        </div>

                        <div class="form-group col-lg-6">
                            <label><?php echo display("mobile") ?> *</label>
                            <input type="text" value="<?php echo $profile->phone ?>" id="mobile" class="form-control" name="mobile" placeholder="<?php echo display("mobile") ?>">
                        </div>

                        <div class="form-group col-lg-6">
                                <label><?php echo display('language') ?></label>
                                
                                <select name="language" class="form-control">
                                    <?php 
                                        foreach($languageList as $key => $val){
                                            echo '<option '.($profile->language==$key?'selected':'').' value="'.$key.'">'.$val.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        
                    </div> 

                    <div>
                        <button type="submit" class="btn btn-success"><?php echo display("update") ?></button>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

 