
<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">
            <div class="panel-body"  id="printableArea">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo base_url(!empty($settings->logo)?$settings->logo:"assets/images/icons/logo.png"); ?>" class="img-responsive" alt="">
                        <br>
                        <address>
                            <strong><?= $settings->title ?></strong><br>
                            <?php echo $settings->description;?><br>
                            
                        </address>
                        
                    </div>
                    <div class="col-sm-6 text-right">
                        <h1 class="m-t-0">Credit No : <?php echo $this->uri->segment(5)?></h1>
                        <div><?php echo date('d-M-Y');?></div>
                        <address>
                            <strong><?php echo @$credit_info->f_name.' '.@$credit_info->l_name;?></strong><br>
                            <?php echo @$credit_info->email;?><br>
                            <?php echo @$credit_info->phone;?><br>
                            <abbr title="Phone"><?php echo display('account')?> :</abbr> <?php echo @$credit_info->user_id;?>
                        </address>
                    </div>
                </div> <hr>
                <div class="table-responsive m-b-20">
                    <table class="table table-border table-bordered ">
                        <thead>
                            <tr>
                                <th><?php echo display('user_id')?></th>
                                <th><?php echo display('amount')?></th>
                                <th><?php echo display('date')?></th>
                                <th><?php echo display('comments')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div><strong><?php echo @$credit_info->user_id;?></strong></div>
                                <td>$<?php echo @$credit_info->deposit_amount;?></td>
                                <td><?php echo @$credit_info->deposit_date;?></td>
                                <td><?php echo @$credit_info->comments;?></td>
                            </tr>
                           
                        </tbody>
                    </table>
                    <?php 
                        if (!@$credit_info->user_id) {
                            echo "<h1 style='color:red; text-align:center;'>User Not Found !!!</h1>";
                        }  
                    ?>                 
                </div>
            </div>

            <div class="panel-footer text-right">
               <button type="button" class="btn btn-info" onclick="printContent('printableArea')"><span class="fa fa-print"></span></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //print a div
    function printContent(el){
        var restorepage  = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        location.reload();
    }
</script>