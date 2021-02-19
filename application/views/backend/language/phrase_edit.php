
<div class="panel panel-bd lobidrag">
 
    <div class="panel-heading">
        <div class="btn-group"> 
            <a class="btn btn-success" href="<?php echo base_url("backend/dashboard/language/phrase") ?>"> <i class="fa fa-plus"></i> Add Phrase</a>
            <a class="btn btn-primary" href="<?php echo base_url("backend/dashboard/language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
        </div> 
    </div>


    <div class="panel-body">
        <?= form_open('backend/dashboard/language/addlebel') ?>
        <table class="table table-striped">
            <thead> 
                <tr>
                    <td colspan="3"> 
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </td>
                </tr>
                <tr>
                    <th><i class="fa fa-th-list"></i></th>
                    <th>Phrase</th>
                    <th>Label</th> 
                </tr>
            </thead>

            <tbody>
                <?= form_hidden('language', $language) ?>
                <?php if (!empty($phrases)) {?>
                    <?php $sl = 1 ?>
                    <?php foreach ($phrases as $value) {?>
                    <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                    
                        <td><?= $sl++ ?></td>
                        <td><input type="text" name="phrase[]" value="<?= $value->phrase ?>" class="form-control" readonly></td>
                        <td><input type="text" name="lang[]" value="<?= $value->$language ?>" class="form-control"></td> 
                    </tr>
                    <?php } ?>
                <?php } ?> 
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"> 
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </td>
                    <td colspan="2">
                        <?php echo (!empty($links)?$links:null) ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?= form_close() ?>
    </div>
</div>