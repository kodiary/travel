<ul class="breadcrumb">
<li>
<a href="<?php echo $this->request->webroot;?>">Home</a>
</li>
<li class="active"><?php echo "Our Team";?></li>
</ul>
<h2 class="common"><?php echo "Our Team";?></h2>
<div class="common">
<?php foreach($model as $m){?>
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo $this->request->webroot."img/team/".$m->image;?>" height="200px" style="padding: 5px; border: 1px solid #ccc;"/>
        </div>
        <div class="col-md-8"><h3>
            <?php echo $m->title;?></h3>
            <span class="blue"><?php echo $m->designation;?></span>
            <?php echo $m->description;?>
        </div>
        
        <div class="clearfix"></div>
    </div>
    <hr />
<?php
} ?>
  
</div>
