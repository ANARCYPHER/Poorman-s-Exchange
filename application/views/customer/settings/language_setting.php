<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        

        <div class="panel panel-bd lobidrag">
                
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('language_setting');?></h4>
                    </div>
                </div>

                <?php echo form_open('customer/settings/update_language')?>
                <div class="panel-body">
                    

                     <div class="form-group col-lg-6">
                        <label><?php echo display('language') ?></label>
                        
                        <select name="language" class="form-control">
                            <?php 
                                foreach($languageList as $key => $val){
                                    echo '<option '.($lang->language==$key?'selected':'').' value="'.$key.'">'.$val.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update');?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div> <!-- /.row -->

                           


