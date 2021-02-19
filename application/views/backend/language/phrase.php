
<div class="panel panel-bd lobidrag">
 
    <div class="panel-heading">
        <div class="btn-group">  
            <a class="btn btn-primary" href="<?php echo base_url("backend/dashboard/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
        </div> 
    </div>


    <div class="panel-body">
      <table class="table table-striped">
        <thead>
            <tr>
                <td colspan="2">
                    <?= form_open('backend/dashboard/language/addPhrase', ' class="form-inline" ') ?> 
                        <div class="form-group">
                            <label class="sr-only" for="addphrase"> Phrase Name</label>
                            <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Save</button>
                    <?= form_close(); ?>
                </td>
            </tr>
            <tr>
                <th><i class="fa fa-th-list"></i></th>
                <th>Phrase</th> 
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($phrases)) {?>
                <?php $sl = 1 ?>
                <?php foreach ($phrases as $value) {?>
                <tr>
                    <td><?= $sl++ ?></td>
                    <td><?= $value->phrase ?></td>
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr><td colspan="2"><?php echo (!empty($links)?$links:null) ?></td></tr>
        </tfoot>
      </table>
    </div>
 

</div>

