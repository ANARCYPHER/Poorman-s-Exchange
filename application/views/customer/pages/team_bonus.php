<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-title" style="max-width: calc(100% - 180px);">
                    <h4><?php echo display('team_bonus');?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('date');?></th>
                                <th><?php echo display('level');?></th>
                                <th><?php echo display('team_bonus');?></th>
                                <th><?php echo display('action');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($team_bonus){
                                foreach ($team_bonus as $key => $value) {
                            ?>
                            
                            <tr>
                                <td><?php echo $value->achive_date;?></td>
                                <td><?php echo $value->level_name;?></td>
                                <td><?php echo $value->team_bonous;?></td>
                                <td><a href="#" class="btn btn-success btn-xs"><?php echo display('view');?></a></td>
                            </tr>

                            <?php  } }?>
                            
                        </tbody>
                    </table>
                    <?php echo $links; ?>
                </div>
            </div>
        </div>
    </div>
</div>