<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph x_panel">
            <div class="row x_title">
                <div class="col-md-10">
                    <h3>
                        Package Manager <span class="small">Add/Edit Package</span>                
                    </h3>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo $this->request->webroot;?>dashboard/editPackage/0" class="btn btn-success btn-lg">Add New</a>
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php
                if(isset($model)){
                $cid = $model->cat_id;
                $title = $model->title;
                $desc = $model->description;
                }
                else{
                $cid = 0;
                $title = '';
                $desc = '';
                }
                
                $category = $cat->find()->all();
                ?>
                <form action="<?php echo $this->request->webroot;?>dashboard/savePackage/<?php if(isset($model->id))echo $model->id;else echo "0";?>" method="post">
                <div class="form-group">
                    <label class="col-md-3">Package Category</label>
                    <div class="col-md-6">
                        <select name="cat_id" class="form-control">
                            <option value="">Choose Category</option>
                            <?php
                            foreach($category as $c)
                            {
                                ?>
                                <option value="<?php echo $c->id?>" <?php if($c->id == $cid){?>selected="selected"<?php }?>><?php echo $c->title;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                 <div class="form-group">
                    <label class="col-md-3">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="<?php echo $title;?>" />
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Image</label>
                    <div class="col-md-9"> 
                        <div class="imagebody img-preview preview-lg" id="preview">
                        
                        </div>
                        <div class="imageaction">
                            <a href="javascript:void(0)" class="btn btn-info" id="upload">Browse</a>
                            <br />
                            <a href="javascript:void(0)" class="btn btn-default">Crop</a>
                            
                        </div>
                        <div class="clearfix"></div>
                        <div class="cropbody img-container" style="display: none;float: left;width:800px">
                        
                        </div>
                        <div class="clearfix"></div>
                        <div class="docs-data">
                      <div class="input-group">
                        <label class="input-group-addon" for="dataX">X</label>
                        <input class="form-control" id="dataX" type="text" placeholder="x">
                        <span class="input-group-addon">px</span>
                      </div>
                      <div class="input-group">
                        <label class="input-group-addon" for="dataY">Y</label>
                        <input class="form-control" id="dataY" type="text" placeholder="y">
                        <span class="input-group-addon">px</span>
                      </div>
                      <div class="input-group">
                        <label class="input-group-addon" for="dataWidth">Width</label>
                        <input class="form-control" id="dataWidth" type="text" placeholder="width">
                        <span class="input-group-addon">px</span>
                      </div>
                      <div class="input-group">
                        <label class="input-group-addon" for="dataHeight">Height</label>
                        <input class="form-control" id="dataHeight" type="text" placeholder="height">
                        <span class="input-group-addon">px</span>
                      </div>
                      <div class="input-group">
                        <label class="input-group-addon" for="dataRotate">Rotate</label>
                        <input class="form-control" id="dataRotate" type="text" placeholder="rotate">
                        <span class="input-group-addon">deg</span>
                      </div>
                    </div>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Description</label>
                    <div class="col-md-6"> 
                        <textarea name="description"><?php echo $desc;?></textarea>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-3"> </label>
                    <div class="col-md-6">
                        <input type="submit" value="Submit" class="btn btn-primary btn-lg" />                    
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>
                    
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace( 'description' );
    $(function(){
        fileUpload('upload')
    })
    function fileUpload(ID) {
        
        var upload = new AjaxUpload("#" + ID, {
            action: "<?php echo $this->request->webroot;?>dashboard/fileUpload",
            enctype: 'multipart/form-data',
            name: 'myfile',
            onSubmit: function (file, ext) {

            },
            onComplete: function (file, response) {
                if (response != 'error') {
                    $('.imagebody').html('<img src="<?php echo $this->request->webroot;?>img/package/resized/'+response+'" style="width:300px;height:300px;" />');
                    $('.cropbody').show();
                    $('.cropbody').append('<img id="cropbox1" src="<?php echo $this->request->webroot;?>img/package/resized/'+response+'" style="width:700px;" class="tocrop" />');
                    
                    
                    
                    
                    
                    'use strict';

                      var console = window.console || { log: function () {} },
                          $alert = $('.docs-alert'),
                          $message = $alert.find('.message'),
                          showMessage = function (message, type) {
                            $message.text(message);
                    
                            if (type) {
                              $message.addClass(type);
                            }
                    
                            $alert.fadeIn();
                    
                            setTimeout(function () {
                              $alert.fadeOut();
                            }, 3000);
                          };
                    
                      // Demo
                      // -------------------------------------------------------------------------
                    
                      (function () {
                        var $image = $('.img-container > img'),
                            $dataX = $('#dataX'),
                            $dataY = $('#dataY'),
                            $dataHeight = $('#dataHeight'),
                            $dataWidth = $('#dataWidth'),
                            $dataRotate = $('#dataRotate'),
                            options = {
                              aspectRatio: 1,
                              autoCropArea: 1,
                              zoomable: false,
                              minCropBoxWidth: 250,
                              preview: '.img-preview',
                              crop: function (data) {
                                $dataX.val(Math.round(data.x));
                                $dataY.val(Math.round(data.y));
                                $dataHeight.val(Math.round(data.height));
                                $dataWidth.val(Math.round(data.width));
                                $dataRotate.val(Math.round(data.rotate));
                              }
                            };
                    
                        $image.on({
                          'build.cropper': function (e) {
                            console.log(e.type);
                          },
                          'built.cropper': function (e) {
                            console.log(e.type);
                          }
                        }).cropper(options);
                    
                    
                        // Methods
                        $(document.body).on('click', '[data-method]', function () {
                          var data = $(this).data(),
                              $target,
                              result;
                    
                          if (data.method) {
                            data = $.extend({}, data); // Clone a new one
                    
                            if (typeof data.target !== 'undefined') {
                              $target = $(data.target);
                    
                              if (typeof data.option === 'undefined') {
                                try {
                                  data.option = JSON.parse($target.val());
                                } catch (e) {
                                  console.log(e.message);
                                }
                              }
                            }
                    
                            result = $image.cropper(data.method, data.option);
                    
                            if (data.method === 'getDataURL') {
                              $('#getDataURLModal').modal().find('.modal-body').html('<img src="' + result + '">');
                            }
                    
                            if ($.isPlainObject(result) && $target) {
                              try {
                                $target.val(JSON.stringify(result));
                              } catch (e) {
                                console.log(e.message);
                              }
                            }
                    
                          }
                        }).on('keydown', function (e) {
                    
                          switch (e.which) {
                            case 37:
                              e.preventDefault();
                              $image.cropper('move', -1, 0);
                              break;
                    
                            case 38:
                              e.preventDefault();
                              $image.cropper('move', 0, -1);
                              break;
                    
                            case 39:
                              e.preventDefault();
                              $image.cropper('move', 1, 0);
                              break;
                    
                            case 40:
                              e.preventDefault();
                              $image.cropper('move', 0, 1);
                              break;
                          }
                    
                        });
                    
                    
                        // Import image
                        var $inputImage = $('#inputImage'),
                            URL = window.URL || window.webkitURL,
                            blobURL;
                    
                        if (URL) {
                          $inputImage.change(function () {
                            var files = this.files,
                                file;
                    
                            if (files && files.length) {
                              file = files[0];
                    
                              if (/^image\/\w+$/.test(file.type)) {
                                blobURL = URL.createObjectURL(file);
                                $image.one('built.cropper', function () {
                                  URL.revokeObjectURL(blobURL); // Revoke when load complete
                                }).cropper('reset', true).cropper('replace', blobURL);
                                $inputImage.val('');
                              } else {
                                showMessage('Please choose an image file.');
                              }
                            }
                          });
                        } else {
                          $inputImage.parent().remove();
                        }
                    
                    
                        // Options
                        $('.docs-options :checkbox').on('change', function () {
                          var $this = $(this);
                    
                          options[$this.val()] = $this.prop('checked');
                          $image.cropper('destroy').cropper(options);
                        });
                    
                    
                        // Tooltips
                        $('[data-toggle="tooltip"]').tooltip();
                    
                      }());
                    
                    
                    
                    
                    
                } else {
                    alert('Invalid file type.');
                }
            }

        });
    }
    
</script>