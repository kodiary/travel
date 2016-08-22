<?php
use Cake\ORM\TableRegistry;
?>
<?php
          $cond_p = '';
          $cond_t = '';
          if((isset($pcat) && count($pcat)) || (isset($tcat) && count($tcat)))
          {
            if(isset($pcat) && count($pcat))
            {
                foreach($pcat as $pc)
                {
                    if($cond_p == '')
                    $cond_p = 'id = '.$pc;
                    else
                    $cond_p = $cond_p.' OR '. 'id = '.$pc;
                }
            }
            
            if(isset($tcat) && count($tcat))
            {
                foreach($tcat as $tc)
                {
                    if($cond_t == '')
                    $cond_t = 'id = '.$tc;
                    else
                    $cond_t = $cond_t.' OR '. 'id = '.$tc;
                }
            }
          }
          if($cond_p || $cond_t)
          {
            //$sql = "SELECT video_id FROM tags WHERE ".$cond;
            if($cond_p)
            $pack_side = TableRegistry::get('Packages')->find()->where([$cond_p])->order('rand()')->limit(4)->all();
            if($cond_t)
            $tour_side = TableRegistry::get('Tours')->find()->where([$cond_t])->order('rand()')->limit(4)->all();
          }
          
          ?>
<div class="sidebar col-md-3 col-sm-4">
            
              <?php 
              if(!isset($pack_side) && !isset($tour_side))
              {
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
              }
              else
              {
                if(isset($pack_side))
                {
                    ?>
                    <h2 class="related">Related Packages</h2>
                    <?php
                    foreach($pack_side as $ps)
                    {
                        ?>
                        <div class="side_group">
                         <div class="image_side" style="height: 175px;position:relative;overflow:hidden;">
                        <img style="max-width: 100%;position: absolute;top:-44px;" src="
                        <?php 
                        echo $this->request->webroot.'img/package/final/'.$ps->image;
                        ?>
                        " />
                        
                        </div>
                        <a href="<?php echo $this->request->webroot?>package/<?php $ps->slug;?>"><?php echo $ps->title;?></a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                if(isset($tour_side))
                {
                    ?>
                    <h2 class="related">Related Tours</h2>
                    <?php
                    foreach($tour_side as $ps)
                    {
                        ?>
                        <div class="side_group">
                        <div class="image_side" style="height: 130px;position:relative;overflow:hidden;">
                         <img style="max-width: 100%;position: absolute;top:-44px;" src="
                        <?php 
                        echo $this->request->webroot.'img/package/tour/'.$ps->image;
                        ?>
                        " />
                        </div>
                       <a href="<?php echo $this->request->webroot?>package/<?php $ps->slug;?>"><?php echo $ps->title;?></a>
                        </div>
                        <hr />
                        <?php
                    }
                    ?>
                    <?php
                }
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
                  <input type="submit" class="btn btn-info" value="Submit" onclick="return false;" />
                  </div>
              </form>
              
              <?php }?>
          </div>