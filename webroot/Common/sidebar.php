<?php
use Cake\ORM\TableRegistry;
?>
<div class="sidebar col-md-3 col-sm-4">
            
              <?php 
              $pgcats = TableRegistry::get('PageCategory')->find()->order(['id'=>'desc'])->all();
              foreach($pgcats as $pgc)
              {
               ?>
               <ul class="list-group margin-bottom-25 sidebar-menu">
                    <li class="list-heading"><?php echo $pgc->title?></li>
                    <?php 
                        $pg = TableRegistry::get('Pages')->find()->where(['cat_id'=>$pgc->id])->order(['id'=>'desc'])->all();
                        foreach($pg as $pages)
                        {
                            ?>
                            <li class="list-group-item clearfix"><a href="<?php echo $this->request->webroot;?>pages/view/<?php echo $pages->slug;?>"><i class="fa fa-angle-left"></i> <?php echo $pages->title;?></a></li>
                            <?php
                        }
                    ?>
               </ul>
               <hr />
               <?php 
              }
              ?> 
              <?php
              if($this->request->params['controller'] == 'Package')
              {
               
              ?>
              <h2>Enquire Package</h2>
              <form>
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Full Name</label>
                    <div class="col-md-12 padding-left-0"><input type="text" class="form-control" name="name" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Email</label>
                    <div class="col-md-12 padding-left-0"><input type="text" class="form-control" name="email" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Phone</label>
                    <div class="col-md-12 padding-left-0"><input type="text" class="form-control" name="Phone" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Message</label>
                    <div class="col-md-12 padding-left-0"><textarea name="message" class="form-control"></textarea></div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Submit" />
                  </div>
              </form>
              
              <?php }?>
          </div>