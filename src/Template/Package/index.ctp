<?php $url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<ul class="breadcrumb">
<li>
<a href="<?php echo $this->request->webroot;?>">Home</a>
</li>
<li>
<a href="<?php echo $this->request->webroot;?><?php echo $cat->slug;?>"><?php echo $cat->title;?></a>
</li>
<li class="active"><?php echo $pack->title;?></li>
</ul>
            <h2 class="common"><?php echo $pack->title;?></h2>
            <hr />
            <div id="introduction">
                 <!-- BEGIN SLIDER -->
                    <div class="page-slider margin-bottom-35">
                      <!-- LayerSlider start -->
                      <div id="layerslider" style="width: 100%; height: 494px; margin: 0 auto;">
                        
                        <?php
                        //$sliders = TableRegistry::get('Sliders')->find()->order(['id'=>'asc'])->all();
                        foreach($model_img as $s)
                        {
                            ?>
                            <div class="ls-slide ls-slide1 ls-slide2" data-ls="offsetxin: right; slidedelay: 7000; transition2d: 24,25,27,28;" style="direction: ltr!important;">
                
                          <img src="<?php echo $this->request->webroot;?>img/package/resized/<?php echo $s->image;?>" class="ls-bg" alt="Slide background">
                
                          <div class="ls-l ls-title" style="top: 50px; left: 35%; white-space: nowrap;" data-ls="
                            fade: true; 
                            fadeout: true; 
                            durationin: 750; 
                            durationout: 750; 
                            easingin: easeOutQuint; 
                            rotatein: 90; 
                            rotateout: -90; 
                            scalein: .5; 
                            scaleout: .5; 
                            showuntil: 4000;
                          "><?php //echo str_replace(array('<p>','</p>'),array('',''),$s->title);?></div>
                
                          <div class="ls-l ls-mini-text" style="top: 300px; left: 35%; white-space: nowrap;" data-ls="
                          fade: true; 
                          fadeout: true; 
                          durationout: 750; 
                          easingin: easeOutQuint; 
                          delayin: 300; 
                          showuntil: 4000;
                          "><?php //echo $s->caption;?>
                          </div>
                           <!--<a href="#" class="ls-l ls-more" style="top: 400px;height:25px; left: 35%; display: inline-block; white-space: nowrap;background:#000;opacity:0.6;" data-ls="
                          fade: true; 
                          fadeout: true; 
                          durationin: 750; 
                          durationout: 750; 
                          easingin: easeOutQuint; 
                          easingout: easeInOutQuint; 
                          delayin: 0; 
                          delayout: 0; 
                          rotatein: 90; 
                          rotateout: -90; 
                          scalein: .5; 
                          scaleout: .5; 
                          showuntil: 4000;">See More Details
                          </a>-->
                        </div>
                            <?php
                        }
                        ?>
                        
                      </div>
                      <!-- LayerSlider end -->
                    </div>
                <div class="clearfix"></div>
                <hr />
                
                <div class="common">
                  <?php echo $pack->description; ?>
                  
                </div>
            </div>
            <?php
            if($ite && count($ite))
            {
                ?>
                <p>&nbsp;</p>
                <a class="collapsible" data-toggle="collapse" href="#itinerary" aria-expanded="false" aria-controls="itinerary">Itinerary <span class="fa fa-angle-left"></span></a>
                <div class="common" id="itinerary">
                
                <table class="table table-bordered">
                <?php 
                foreach($ite as $i)
                {
                    ?>
                    <tr><td style="width: 20%;"><?php echo 'Day '.$i->day;?></td><td style="width: 20%;"><strong><?php echo $i->title;?></strong></td><td><?php echo $i->description;?></td></tr>
                    <?php
                }
                ?>
                </table>
                </div>
                <?php
            }
            if($pack->cost_detail)
            {
                ?>
                <hr />
                <a class="collapsible" data-toggle="collapse" href="#cost_detail" aria-expanded="false" aria-controls="cost_detail">Cost Detail <span class="fa fa-angle-left"></span></a>
                <div class="common collapse" id="cost_detail">
                
                <?php echo $pack->cost_detail;?>
                </div>
                <?php
            }
            if($pack->route_map || $pack->grade || $pack->start_point || $pack->end_point || $pack->best_time)
            {
                ?>
                <hr />
                <a class="collapsible" data-toggle="collapse" href="#route" aria-expanded="false" aria-controls="route">Route <span class="fa fa-angle-left"></span></a>
                <div class="common collapse" id="route">
                <?php
                if($pack->route_map){
                $col = 'col-md-6';
                ?>
                <div class="<?php echo $col;?>">
                    <img src="<?php echo $this->request->webroot;?>img/package/final/<?php echo $pack->route_map?>" style="max-width: 100%;" />
                </div>
                <?php
                }
                else
                $col = 'col-md-12';
                ?>
                <div class="<?php echo $col?>">
                <h2>Route Analysis</h2>
                <hr />
                    <p>
                        <?php if($pack->grade){?><strong><span class="fa fa-line-chart"></span> Grade:</strong> <?php echo $pack->grade;}?>
                    </p>
                    <p>
                        <?php if($pack->start_point){?><strong><span class="fa fa-car"></span> Start Point/End Point:</strong> <?php echo $pack->start_point.'/'.$pack->end_point;}?>
                    </p>
                        <?php if($pack->best_time){?><strong><span class="fa fa-clock-o"></span> Best Time:</strong> <?php echo $pack->best_time;}?>
                    </p>
                </div>
                </div>
                <?php
            }
            ?>
            <div class="clearfix"></div>
            <hr />
            <h1>Place your comment below</h1>
            <div class="fb-comments common" data-href="<?php echo $url;?>" data-numposts="5" style="width:100%;"></div>
           
            
            