<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph x_panel">
            <div class="row x_title">
                <div class="col-md-10">
                    <h3>
                        Page Manager <span class="small">Add/Edit Page</span>                
                    </h3>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo $this->request->webroot;?>dashboard/editPage/0" class="btn btn-success btn-lg">Add New</a>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php
                if(isset($model)){
                $cid = $model->cat_id;
                $title = $model->title;
                $desc = $model->description;
                }
                else{
                $cid = 0;
                $title = '';
                $desc = '';
                }
                
                $category = $cat->find()->all();
                ?>
                
                <div class="form-group">
                    <label class="col-md-3">Page Category</label>
                    <div class="col-md-6">
                        <select name="cat_id" class="form-control">
                            <option value="">Choose Category</option>
                            <?php
                            foreach($category as $c)
                            {
                                ?>
                                <option value="<?php echo $c->id?>" <?php if($c->id == $cid){?>selected="selected"<?php }?>><?php echo $c->title;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                 <div class="form-group">
                    <label class="col-md-3">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="<?php echo $title;?>" />
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Description</label>
                    <div class="col-md-6">
                        <textarea name="description"></textarea>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-3"> </label>
                    <div class="col-md-6">
                        <input type="submit" value="Submit" class="btn btn-primary btn-lg" />                    
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                    
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace( 'description' );
    
</script>
<style>
.cke_1_contents{height:350px!important;}
</style>