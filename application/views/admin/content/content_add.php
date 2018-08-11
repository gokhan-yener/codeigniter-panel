<?php
$message =$this->session->flashdata("message");
if($message):
    echo $message;
endif;
?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/content/content_save")?>" method="POST" ">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2;?></h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="title" class="bmd-label-floating "> Başlık *</label>
                    <input type="text" class="form-control" id="exampleEmails" maxlength="250" autofocus required="true" name="title">
                </div>


                <div class="form-group">
                    <label for="detail" class="bmd-label-floating "> İçerik *</label>
                    <textarea id="editor1" class="ckeditor" name="detail" required="true"  >
	            </textarea>
                </div>


                <div class="form-group">
                    <div class="col-6">
                        <select class="selectpicker" name="category_id"  data-style="btn select-with-transition" title="Single Select">
                            <option disabled selected>Kategori</option>
                            <option value="1" >Matematik</option>
                          <?php foreach($categories as $row){?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
                            <?php }?>
                        </select>
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

            </div>


            <div class="card-footer text-right">

                <label class="form-check-label">
                    <a href="<?php echo base_url("admin/content")?>" class="btn btn-rose">
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