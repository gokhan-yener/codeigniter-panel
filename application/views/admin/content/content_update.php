<?php
$message =$this->session->flashdata("message");
if($message):
    echo $message;
endif;
?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/content/content_update")?>" method="POST" >
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2;?></h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="title" class="bmd-label-floating "> Başlık *</label>
                    <input type="text" value="<?php echo $row->title?>" class="form-control" id="exampleEmails" maxlength="250" autofocus required="true" name="title">
                    <input type="hidden" value="<?php echo $row->title?>" name="titleOrjinal">
                </div>

                <div class="form-group">
                    <label for="slug" class="bmd-label-floating "> Slug </label>
                    <input type="text" disabled  value="<?php echo $row->slug?>" class="form-control" id="slug" maxlength="250" >
                </div>

                <div class="form-group">
                    <label for="detail" class="bmd-label-floating "> İçerik *</label>
                    <textarea id="editor1" class="ckeditor"  name="detail"  ><?php echo $row->detail?>
	            </textarea>
                </div>


                <div class="form-group">
                    <div class="col-6">
                        <select class="selectpicker" name="category_id"   data-style="btn select-with-transition" title="Single Select">
                            <option disabled selected>Kategori</option>

                            <?php foreach($categories as $category){?>
                                <option value="<?php echo $category->id;?>" <?php echo $category->id==$row->category_id ? "selected='selected'":NULL;?>><?php echo $category->title;?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="isActive" <?php checkBox($row->isActive);?> type="checkbox" >
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

                <button type="submit" class="btn btn-warning">
                    <i class="material-icons">
                        check
                    </i>Güncelle</button>
            </div>
        </div>
        <input type="hidden" name="content_id" value="<?php echo $row->id; ?>" >
    </form>
</div>