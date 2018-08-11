<?php
$message =$this->session->flashdata("message");
if($message):
    echo $message;
endif;
?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/product/product_save")?>" method="POST" enctype="multipart/form-data">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2;?></h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Ürün Adı *</label>
                    <input type="text" class="form-control" id="exampleEmails" autofocus required="true" name="title">
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Kod Adı *</label>
                    <input type="text" class="form-control" id="exampleEmails" required="true" name="code">
                </div>


                <div class="form-group">
                    <label for="detail" class="bmd-label-floating "> Detay </label>
                    <textarea cols="80" id="editor1" class="ckeditor" name="detail"   >
	            </textarea>
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Miktar *</label>
                    <input type="text" class="form-control" id="exampleEmails" required="true" name="quantity">
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Liste Fiyatı *</label>
                    <input type="text" class="form-control" id="exampleEmails" required="true" name="list_price">
                </div>

                <div class="form-group">
                    <label for="exampleEmails" class="bmd-label-floating "> Satış Fiyatı *</label>
                    <input type="text" class="form-control" id="exampleEmails" required="true" name="sale_price">
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group ">
                            <div class="col-md-6">
                                <select class="selectpicker " name="category_id" data-size="10" data-style="btn select-with-transition" title="Single Select">
                                    <option disabled selected>Kategori</option>
                                    <?php foreach($categories as $row){?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
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
                                    <?php foreach ($suppliers as $row){?>
                                        <option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
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
                            <img src="<?php echo base_url();?>assets/admin/img/placeholder.jpg" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                                <span class="btn btn-round btn-success btn-file">
                                    <span class="fileinput-new">Resim ekle</span>
                                    <span class="fileinput-exists">Değiştir</span>
                                    <input type="file" name="img_id"></span>
                            <br>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                <i class="fa fa-times"></i> Sil</a>
                        </div>
                    </div>
                </div>


                <div class="form-check">

                    <label class="form-check-label">
                        <input class="form-check-input" name="isActive" type="checkbox" checked value="1">
                        Durum
                        <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                    </label>
                </div>

                <div class="category form-category">* Zorunlu alan</div>
            </div>
            <div class="card-footer text-right">

                <label class="form-check-label">
                    <a href="<?php echo base_url("admin/product")?>" class="btn btn-rose">
                        <i class="material-icons">
                            keyboard_return
                        </i>
                        Listeye Dön</a>

                </label>

                <button type="submit" class="btn btn-success">
                    <i class="material-icons">
                        check
                    </i>Kaydet</button>
            </div>
        </div>
    </form>
</div>
