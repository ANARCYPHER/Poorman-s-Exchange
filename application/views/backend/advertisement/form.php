<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border_preview">
                <?php echo form_open_multipart("backend/cms/advertisement/form/$advertisement->id") ?>
                <?php echo form_hidden('id', $advertisement->id) ?> 
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label"><?php echo display('name') ?></label>
                        <div class="col-sm-8">
                            <input name="name" value="<?php echo htmlspecialchars($advertisement->name); ?>" class="form-control" type="text" id="name" placeholder="<?php echo display('name') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="page" class="col-sm-4 col-form-label"><?php echo display('page') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <select class="form-control basic-single" name="page">
                                <option value=""><?php echo display('page') ?></option>
                                <?php foreach ($parent_cat as $key => $value) { ?>
                                    <option value="<?php echo $value->cat_id; ?>" <?php echo ($advertisement->page==$value->cat_id)?'Selected':'' ?>><?php echo $value->cat_name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="add_type" class="col-sm-4 col-form-label"><?php echo display('add_type') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <select class="form-control basic-single" name="add_type" id="add_type">
                                <option value=""><?php echo display('add_type') ?></option>
                                <option value="image" <?php echo $advertisement->image?'Selected':NULL ?>>Image</option>
                                <option value="code" <?php echo $advertisement->script?'Selected':NULL ?>>Embed code</option>
                            </select>
                        </div>
                    </div>

                    <span id="add_content_load">

                        <?php  if ($advertisement->id && !empty($advertisement->image)) { ?>

                        <div class='form-group row'>
                            <label for='image' class='col-sm-4 col-form-label'><?php echo display("image") ?></label>
                            <div class='col-sm-8'>
                                <input name='image' class='form-control image' type='file' id='image'>
                                <input type='hidden' name='image_old' value='<?php echo $advertisement->image ?>'><?php if(!empty($advertisement->image)){ ?>
                                <img src='<?php echo base_url($advertisement->image) ?>' width='450'><?php } ?>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label for='url' class='col-sm-4 col-form-label'><?php echo display('url') ?></label>
                            <div class='col-sm-8'>
                                <input name='url' value='<?php echo $advertisement->url ?>' class='form-control' placeholder='<?php echo display('url') ?>' type='text' id='url'>
                            </div>
                        </div>
                        <?php } ?>
                        <?php  if ($advertisement->id && !empty($advertisement->script)) { ?>
                        <div class='form-group row'>
                            <label for='script' class='col-sm-4 col-form-label'><?php echo display('embed_code') ?><i class='text-danger'>*</i></label>
                            <div class='col-sm-8'>
                                <textarea  name='script' class='form-control' placeholder='<?php echo display('embed_code') ?>' type='text' id='script'><?php echo htmlspecialchars($advertisement->script) ?></textarea>
                            </div>
                        </div>
                        <?php } ?>


                    </span>                    

                    <div class="form-group row">
                        <label for="serial_position" class="col-sm-4 col-form-label"><?php echo display('position_serial') ?><i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                            <input name="serial_position" value="<?php echo $advertisement->serial_position ?>" class="form-control" placeholder="<?php echo display('position_serial') ?>" type="text" id="serial_position">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <?php echo form_radio('status', '1', (($advertisement->status==1 || $advertisement->status==null)?true:false)); ?><?php echo display('active') ?>
                             </label>
                            <label class="radio-inline">
                                <?php echo form_radio('status', '0', (($advertisement->status=="0")?true:false) ); ?><?php echo display('inactive') ?>
                             </label> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary  w-md m-b-5"><?php echo display("cancel") ?></a>
                            <button type="submit" class="btn btn-success  w-md m-b-5"><?php echo $advertisement->id?display("update"):display("create") ?></button>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Type -->
<script type="text/javascript">
    $(function(){

        $("#add_type").on("change", function(event) {
            event.preventDefault();
            var add_type = $("#add_type").val()|| 0;

            if (add_type==='image') {
                $( "#add_content_load").html("<div class='form-group row'><label for='image' class='col-sm-4 col-form-label'><?php echo display("image") ?></label><div class='col-sm-8'><input name='image' class='form-control image' type='file' id='image'><input type='hidden' name='image_old' value='<?php echo $advertisement->image ?>'><?php if(!empty($advertisement->image)){ ?><img src='<?php echo base_url($advertisement->image) ?>' width='450'><?php } ?></div></div><div class='form-group row'><label for='url' class='col-sm-4 col-form-label'><?php echo display('url') ?></label><div class='col-sm-8'><input name='url' value='<?php echo $advertisement->url ?>' class='form-control' placeholder='<?php echo display('url') ?>' type='text' id='url'></div></div>");
            }
            else if (add_type==='code') {
                $( "#add_content_load").html("<div class='form-group row'><label for='script' class='col-sm-4 col-form-label'><?php echo display('embed_code') ?><i class='text-danger'>*</i></label><div class='col-sm-8'><textarea  name='script' class='form-control' placeholder='<?php echo display('embed_code') ?>' type='text' id='script'><?php echo htmlspecialchars($advertisement->script) ?></textarea></div></div>");
            }
            else{
                $( "#add_content_load").html("");
            }


        });

    }); 
</script>
 