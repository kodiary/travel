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
            <div class="col-md-12 largeImage padding-left-0 common">
                <img src="<?php echo $this->request->webroot;?>img/package/resized/<?php echo $pack->image;?>" />
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class="common">
              <?php echo $pack->description; ?>
              
            </div>
            <?php
            if($ite && count($ite))
            {
                ?>
                <p>&nbsp;</p>
                <div class="common">
                <h2>Itinerary</h2>
                <table class="table table-bordered">
                <?php 
                foreach($ite as $i)
                {
                    ?>
                    <tr><td style="width: 20%;"><strong><?php echo $i->title;?></strong></td><td><?php echo $i->description;?></td></tr>
                    <?php
                }
                ?>
                </table>
                </div>
                <?php
            }
            ?>
           
            
            