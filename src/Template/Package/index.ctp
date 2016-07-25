<ul class="breadcrumb">
<li>
<a href="<?php echo $this->request->webroot;?>">Home</a>
</li>
<li>
<a href="<?php echo $this->request->webroot;?>packageCategory/<?php echo $cat->slug;?>"><?php echo $cat->title;?></a>
</li>
<li class="active"><?php echo $pack->title;?></li>
</ul>
            <h2 class="common"><?php echo $pack->title;?></h2>
            <div id="introduction">
                <div class="col-md-12 largeImage padding-left-0 common">
                    <img src="<?php echo $this->request->webroot;?>img/package/resized/<?php echo $pack->image;?>" />
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
                <div class="common collapse" id="itinerary">
                
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
           
            
            