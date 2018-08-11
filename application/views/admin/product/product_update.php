<?php
$message =$this->session->flashdata("message");
if($message):
    echo $message;
endif; ?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/product/product_update")?>" enctype="multipart/form-data" method="POST" >
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2;?></h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="title" class="bmd-label-floating "> Ürün Adı *</label>
                    <input type="text" value="<?php echo $row->title?>" class="form-control" id="exampleEmails" maxlength="250" autofocus required="true" name="title">

                </div>

                <div class="form-group">
                    <label for="slug" class="bmd-label-floating "> Slug </label>
                    <input type="text" disabled  value="<?php echo $row->slug?>" class="form-control" id="slug" maxlength="250" >
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Kod Adı *</label>
                    <input type="text" class="form-control" id="exampleEmails" value="<?php echo $row->code?>" required="true" name="code">
                    <input type="hidden" value="<?php echo $row->code?>" name="codeOrj">
                </div>

                <div class="form-group">
                    <label for="detail" class="bmd-label-floating "> İçerik *</label>
                    <textarea   name="detail" id="editor1" class="ckeditor"  ><?php echo $row->detail?>
	            </textarea>
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Miktar *</label>
                    <input type="text" class="form-control" value="<?php echo $row->quantity?>" id="exampleEmails" required="true" name="quantity">
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Liste Fiyatı *</label>
                    <input type="text" class="form-control" value="<?php echo $row->list_price?>" id="exampleEmails" required="true" name="list_price">
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Satış Fiyatı *</label>
                    <input type="text" class="form-control"  value="<?php echo $row->sale_price?>" id="exampleEmails" required="true" name="sale_price">
                </div>



                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group ">
                            <div class="col-md-6">
                                <select class="selectpicker " name="category_id" data-size="10" data-style="btn select-with-transition" title="Single Select">
                                    <option disabled selected>Kategori</option>
                                    <?php foreach($categories as $cat){?>
                                        <option value="<?php echo $cat->id;?>" <?php echo $cat->id==$row->category_id ? "selected='selected'":NULL; ?>><?php echo $cat->title;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-6">
                                <select class="selectpicker" name="supplier_id" data-size="5" data-style="btn select-with-transition" title="Single Select">
                                    <option disabled selected>Tedarikçi</option>
                                    <?php foreach ($suppliers as $sup){?>
                                        <option value="<?php echo $sup->id;?>" <?php echo $sup->id==$row->supplier_id ? "selected='selected'":NULL; ?>><?php echo $sup->title;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-12 col-sm-12 text-center">
                    <h4 class="title">Ürün Resmi</h4>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">

                            <?php if(strlen($row->img_id) >0 && file_exists("./uploads/products/".$row->img_id) && file_exists("./uploads/products/thumb/".$row->img_id)){ ?>

                                <a href="<?php echo base_url();?>uploads/products/<?php echo $row->img_id; ?>" class="magnific">
                                    <img src="<?php echo base_url();?>uploads/products/thumb/<?php echo $row->img_id; ?>" class="magnific" alt="...">
                                </a>
                            <?php }else{ ?>
                                <img src="<?php echo base_url();?>assets/admin/img/placeholder.jpg" alt="...">
                                <?php } ?>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                                <span class="btn btn-round btn-warning btn-file">
                                    <span class="fileinput-new">Resim ekle</span>
                                    <span class="fileinput-exists">Değiştir</span>
                                    <input type="file"  name="img_id"></span>
                                    <input type="hidden" value="<?php echo $row->img_id; ?>" name="img_name"></span>
                            <br>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                <i class="fa fa-times"></i> Sil</a>
                        </div>
                    </div>
                </div>


                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="isActive" <?php checkBox($row->isActive);?> type="checkbox" value="1" >
                        Durum
                        <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                    </label>
                </div>

            </div>
            <div class="card-footer text-right">

                <label class="form-check-label">
                    <a href="<?php echo base_url("admin/product")?>" class="btn btn-rose">
                        <i class="material-icons">
                            keyboard_return
                        </i>
                        Listeye Dön</a>

                </label>

                <button type="submit" class="btn btn-warning">
                    <i class="material-icons">
                        check
                    </i>Güncelle</button>
            </div>
        </div>
        <input type="hidden" name="product_id" value="<?php echo $row->id; ?>" >
    </form>
</div>
