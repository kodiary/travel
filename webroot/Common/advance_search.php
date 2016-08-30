<?php use Cake\ORM\TableRegistry;
if(isset($key))
$_GET['keyword'] = $key;
else
$_GET['keyword'] = ' ';
?>
     <h2 class="related">Advance Search</h2>
     <form method="get" action="<?php echo $this->request->webroot;?>search" style="background: #FFF;padding:10px;">
         <div class="form-group">
         <label class="col-md-3 padding-left-0"><strong>Keyword</strong></label><div class="col-md-9"><input type="text" class="form-control" name="keyword" value="<?php echo $_GET['keyword'];?>" style="height: 23px;padding: 0 5px" /></div>
         <div class="clearfix"></div>
         </div>   
         <div class="form-group">
             <select name="country" class="form-control">
                 <option value="">SELECT COUNTRY</option>
                 <?php 
                 $country = TableRegistry::get('TblCountries')->find()->where(['(id IN (SELECT country_id FROM packages WHERE country_id>0) OR id IN (SELECT country_id FROM tours WHERE country_id>0))'])->all();
                 foreach($country as $co)
                 {
                    ?>
                    <option value="<?php echo $co->id;?>"><?php echo $co->countryName;?></option>
                    <?php
                 }
                 ?>
             </select>
         </div>
         <div class="form-group">
             <label class="col-md-2 padding-left-0"><strong>Type</strong></label>
             <div class="col-md-10">
                <input type="checkbox" name="Packages" value="1" onchange="if($(this).is(':checked'))$('.p_hide').show();else{$('.p_hide').hide();}" /> Packages &nbsp; &nbsp; <input type="checkbox" name="Tours" value="1" onchange="if($(this).is(':checked'))$('.t_hide').show();else{$('.t_hide').hide();}" /> Tours
             </div>
             <div class="clearfix"></div>
         </div>
         <div class="form-group p_hide" style="display: none;">
            <select name="pcat" class="form-control">
                 <option value="">PACKAGE CATEGORY</option>
                 <?php 
                 $pcats = TableRegistry::get('PackageCategory')->find()->all();
                 foreach($pcats as $co)
                 {
                    ?>
                    <option value="<?php echo $co->id;?>"><?php echo $co->title;?></option>
                    <?php
                 }
                 ?>
             </select>
         </div>
         <div class="form-group t_hide" style="display: none;">
            <select name="tcat" class="form-control">
                 <option value="">TOUR CATEGORY</option>
                 <?php 
                 $tcats = TableRegistry::get('TourCategory')->find()->all();
                 foreach($tcats as $co)
                 {
                    ?>
                    <option value="<?php echo $co->id;?>"><?php echo $co->title;?></option>
                    <?php
                 }
                 ?>
             </select>
         </div>
         <div class="form-group" style="">
            <select name="days" class="form-control">
                 <option value="">PACKAGE/TOUR DAYS</option>
                 <option value="7">1 - 7 days</option>
                 <option value="14">8 - 14 days</option>
                 <option value="21">15 - 21 days</option>
                 <option value="100">21 days +</option>                 
             </select>
         </div>
         <div class="form-group">
         <input type="submit" value="Search" class="btn btn-info" />
         </div>
     </form>  
 <hr />  