<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?php echo (!empty($title)?$title:null) ?></h2>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <a class="btn btn-success w-md m-b-5 pull-right" href="<?php echo base_url("backend/cms/".$this->uri->segment(3)."/form") ?>"><i class="fa fa-plus" aria-hidden="true"></i> <?php echo display($this->uri->segment(3)); ?></a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable2 table table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('headline_en') ?></th>
                            <th><?php echo display('category') ?></th>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>    
                    <tbody>
                        <?php if (!empty($article)) ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($article as $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td> 
                            <td><?php echo $value->headline_en; ?></td>
                            <td><?php echo $this->db->select("cat_name_en, cat_name_fr")->from('web_category')->where('cat_id', $value->cat_id)->get()->row()->cat_name_en; ?></td>
                            <td><?php echo $value->position_serial; ?></td>
                            <td>
                                <a href="<?php echo base_url("backend/cms/".$this->uri->segment(3)."/form/$value->article_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="<?php echo base_url("backend/cms/".$this->uri->segment(3)."/delete/$value->article_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php echo $links; ?>
            </div> 
        </div>
    </div>
</div>

 