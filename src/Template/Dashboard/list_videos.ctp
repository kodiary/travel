<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph x_panel">
            <div class="row x_title">
                <div class="col-md-10">
                    <h3>
                        Video Manager <span class="small">List Videos</span>                
                    </h3>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo $this->request->webroot;?>dashboard/editVideos/0" class="btn btn-success btn-lg">Add New</a>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered">
                <tr><td><strong>SN</strong></td><td><strong>Youtube</strong></td><td><strong>Actions</strong></td></tr>
                <?php
                $i=0;
                foreach($model as $m)
                {
                    $i++;
                    
                    ?>
                    <tr><td><?php echo $i;?></td><td><?php echo $m->youtube;?></td><td><a href="<?php echo $this->request->webroot;?>dashboard/editVideos/<?php echo $m->id;?>" class="btn btn-primary">Edit</a> <a href="<?php echo $this->request->webroot;?>dashboard/deletevideos/<?php echo $m->id;?>" class="btn btn-danger">Delete</a></td></tr>
                    
                    <?php
                }
                ?>
                </table>
            </div>
        </div>
    </div>
</div>