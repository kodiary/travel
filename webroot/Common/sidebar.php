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
              
              
          </div>