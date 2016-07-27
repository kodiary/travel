
            <h2 class="common">Welcome</h2>
            <div class="common">
              <?php if(isset($about)){echo substr($about->description,0,650).'...'; }?>
              <br /><br />
              <a href="<?php echo $this->request->webroot;?>pages/view/about-us" class="btn btn-info">Read More</a>
              
            </div>
            <hr />
            <h2>Packages</h2>
            <div class="">
            <?php 
            use Cake\ORM\TableRegistry;
                foreach($packages as $p)
                {
                    $ite = TableRegistry::get('Iteniery');
                    $days = $ite->find()->where(['pid' => $p->id])->count();

                    ?>
                    <div class="col-md-4 padding-left-0 margin-left-0">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            <img src="<?php echo $this->request->webroot;?>img/package/final/<?php echo $p->image;?>" class="img-responsive" alt="<?php echo $p->title;?>">
                          </div>
                          <h3><a href="<?php echo $this->request->webroot;?>package/<?php echo $p->slug;?>"><?php echo substr($p->title,0,50);if(strlen($p->title > 50))echo '...';?></a></h3>
                          <div class="pi-price common"><?php echo $days;?> day<?php echo ($days>1)?"s":'';?></div>
                          <a href="<?php echo $this->request->webroot;?>package/<?php echo $p->slug;?>" class="btn btn-default add2cart">View Detail</a>
                          <div class="sticker sticker-new"></div>
                        </div>
                    </div>
                    <?php
                }
            ?>
              
            </div>