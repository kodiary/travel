<?php
use Cake\ORM\TableRegistry;
?>
<?php
          $cond_p = '';
          $cond_t = '';
          if(isset($pcat) && count($pcat))
          {
            if(isset($pcat) && count($pcat))
            {
                foreach($pcat as $pc)
                {
                    if($cond_p == '')
                    $cond_p = 'cat_id = '.$pc;
                    else
                    $cond_p = $cond_p.' OR '. 'cat_id = '.$pc;
                }
            }
            
            
          }
          if($cond_p)
          {
            //$sql = "SELECT video_id FROM tags WHERE ".$cond;
            if(isset($pslug) && $cond_p)
            {
                $cond_p = '('.$cond_p.') AND slug <> "'.$pslug.'"';
            }
            
            if($cond_p){
            $pack_side = TableRegistry::get('Packages')->find()->where(['is_tour = 0 AND ('.$cond_p.')'])->order('rand()')->limit(4)->all();
            
            $tour_side = TableRegistry::get('Packages')->find()->where(['is_tour = 1 AND ('.$cond_p.')'])->order('rand()')->limit(4)->all();}
          }
          
          ?>
<div class="sidebar col-md-3 col-sm-4">
 <?php include(APP.'../webroot/Common/advance_search.php');?>       
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
                if(isset($pack_side) && count($pack_side))
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
                        <a href="<?php echo $this->request->webroot?>package/<?php echo $ps->slug;?>"><?php echo $ps->title;?></a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                if(isset($tour_side) && count($tour_side))
                {
                    ?>
                    <h2 class="related margin-top-15">Related Tours</h2>
                    <?php
                    foreach($tour_side as $ps)
                    {
                        ?>
                        <div class="side_group">
                        <div class="image_side" style="height: 130px;position:relative;overflow:hidden;">
                         <img style="max-width: 100%;position: absolute;top:-44px;" src="
                        <?php 
                        echo $this->request->webroot.'img/package/final/'.$ps->image;
                        ?>
                        " />
                        </div>
                       <a href="<?php echo $this->request->webroot?>package/<?php echo $ps->slug;?>"><?php echo $ps->title;?></a>
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
              <h2 class="related margin-top-15">Enquire This Package</h2>
              <div class="enquire">
              <form method="post" class="enuire_package" >
                <input type="hidden" name="p_id" value="<?php if(isset($pack))echo $pack->title;?>"/>
                <input type="hidden" name="cap" value=""/>
                <input type="hidden" name="url" value="<?php if (isset($pack))echo $this->request->webroot."package/".$pack->slug;?>"/>
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Full Name</label>
                    <div class="col-md-12 padding-left-0"><input type="text" class="form-control" name="name" required="required" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Email</label>
                    <div class="col-md-12 padding-left-0"><input type="email" class="form-control" name="email" required="required" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Phone</label>
                    <div class="col-md-12 padding-left-0"><input type="text" class="form-control" name="phone" required="required" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12 padding-left-0">Message</label>
                    <div class="col-md-12 padding-left-0"><textarea name="message" class="form-control" required="required"></textarea></div>
                    <div class="clearfix"></div>
                  </div>
                 
                    
                  <div class="form-group">
                  <input type="submit" class="btn btn-info" value="Submit"/>
                  </div>
              </form>
              <hr />
                  <div class="forn-group">
                    <div class="col-md-1 padding-left-0">
                        <span style="color: red;">NOTE</span>:
                    </div>
                    <div class="col-md-11">
                        <span>you can use this form to customize your package!</span>
                    </div>
                    <div class="clearfix"></div>
                </div> 
              </div>
              <?php }?>
          </div>
          
<script>
$(function(){
    $('.enuire_package').submit(function(event){
        event.preventDefault();
        var type = '';
        <?php
        if($this->request->action=='contactus')
        {?>
            type = 'contactus';
        <?php
        }?>
        $.ajax({
            type    :'post',
            url     :'<?php echo $this->request->webroot;?>package/enquire?type='+type,
            data    : $(this).serialize(),
            success : function(msg){
                if(msg == 'OK')
                {
                    $('.enquire').html('Thankyou!');
                    
                }
                    
            }
        })
    })
})

</script>