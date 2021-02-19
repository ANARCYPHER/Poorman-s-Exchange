<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                </div>
            </div>
            <div class="panel-body">

                
                
  
                    <div class="row">
                        <?php 
                            echo form_open_multipart("backend/dashboard/setting/update_sender") ?>
                        <div class="col-md-6">
                         <fieldset>
                            <legend> Email Notification Settings </legend>
                             <div class="checkbox">
                                <input id="checkbox1" type="checkbox" value="1" <?php echo ($email->deposit!=NULL?'checked':'')?> name="deposit">
                                <label for="checkbox1">Deposit</label>
                            </div>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox2" type="checkbox" value="1" <?php echo ($email->transfer!=NULL?'checked':'')?> name="transfer">
                                <label for="checkbox2">Transfer</label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox3" type="checkbox" value="1" <?php echo ($email->payout!=NULL?'checked':'')?>  name="payout">
                                <label for="checkbox3">Payout</label>
                            </div>
                            <div class="checkbox checkbox-info">
                                <input id="checkbox4" type="checkbox" value="1" <?php echo ($email->commission!=NULL?'checked':'')?> name="commission">
                                <label for="checkbox4">Commissin</label>
                            </div>
                            <div class="checkbox checkbox-warning">
                                <input id="checkbox5" type="checkbox" value="1" <?php echo ($email->team_bonnus!=NULL?'checked':'')?>  name="team_bonnus">
                                <label for="checkbox5">Team Bonnus</label>
                            </div>
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox6" type="checkbox" value="1" <?php echo ($email->withdraw!=NULL?'checked':'')?>  name="withdraw">
                                <label for="checkbox6">Withdraw</label>
                            </div>
                            <input type="hidden" name="email" value="email">
                            
                        </fieldset>
                    <div>
                        <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                    </div>

                    </div>
                    <?php echo form_close() ?>
                    <?php 
                echo form_open_multipart("backend/dashboard/setting/update_sender") ?>
                    <div class="col-md-6">
                         <fieldset>
                            <legend> SMS Sending  </legend>
                             <div class="checkbox">
                                <input id="checkbox7" type="checkbox" value="1" <?php echo ($sms->deposit!=NULL?'checked':'')?> name="deposit">
                                <label for="checkbox7">Deposit</label>
                            </div>
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox8" type="checkbox" value="1" <?php echo ($sms->transfer!=NULL?'checked':'')?> name="transfer">
                                <label for="checkbox8">Transfer</label>
                            </div>
                            <div class="checkbox checkbox-success">
                                <input id="checkbox9" type="checkbox" value="1" <?php echo ($sms->payout!=NULL?'checked':'')?> name="payout">
                                <label for="checkbox9">Payout</label>
                            </div>
                            <div class="checkbox checkbox-info">
                                <input id="checkbox10" type="checkbox" value="1" <?php echo ($sms->commission!=NULL?'checked':'')?> name="commission">
                                <label for="checkbox10">Commissin</label>
                            </div>
                            <div class="checkbox checkbox-warning">
                                <input id="checkbox11" type="checkbox" value="1" <?php echo ($sms->team_bonnus!=NULL?'checked':'')?> name="team_bonnus">
                                <label for="checkbox11">Team Bonnus</label>
                            </div>
                            <div class="checkbox checkbox-danger">
                                <input id="checkbox12" type="checkbox" value="1" <?php echo ($sms->withdraw!=NULL?'checked':'')?> name="withdraw">
                                <label for="checkbox12">Withdraw</label>
                            </div>
                            <input type="hidden" name="sms" value="sms">

                           
                        </fieldset>
                    <div>
                        <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>
                    </div>

                    </div>

                    <?php echo form_close() ?>

                    </div> 

                    

           

            </div>
        </div>
    </div>
</div>




 