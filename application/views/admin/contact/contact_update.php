<?php
$message = $this->session->flashdata("message");
if ($message):
    echo $message;
endif;
?>
<div class="col-md-7">
    <form id="LoginValidation" action="<?php echo base_url("admin/contact/contact_update") ?>" method="POST">
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2; ?></h4>
            </div>
            <div class="card-body ">

                <div class="form-group">
                    <label for="Kategori">Kategori</label>
                    <div class="col-6">
                        <select class="selectpicker" data-style="btn select-with-transition" name="category"
                                data-size="5">
                            <option disabled selected>Seçiniz</option>
                            <option value="Genel" <?php echo select($row->category, "Genel"); ?>>Genel</option>
                            <option value="Bilgi" <?php echo select($row->category, "Bilgi"); ?>>Bilgi</option>
                            <option value="Şikayet" <?php echo select($row->category, "Şikayet"); ?>>Şikayet</option>
                            <option value="Öneri" <?php echo select($row->category, "Öneri"); ?>>Öneri</option>


                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="bmd-label-floating "> Başlık *</label>
                    <input type="text" readonly value="<?php echo $row->subject ?>" class="form-control" id="subject"
                           maxlength="250" autofocus name="subject">
                </div>


                <div class="form-group">
                    <label for="email" class="bmd-label-floating "> Eposta </label>
                    <input type="email" readonly value="<?php echo $row->email ?>" class="form-control" id="email">
                </div>

                <div class="form-group">
                    <label for="phone" class="bmd-label-floating "> Tel </label>
                    <input type="text" readonly value="<?php echo $row->phone ?>" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="note" class="bmd-label-floating "> Detay</label>
                    <textarea cols="80" readonly id="editor1" class="ckeditor" name="description">
                        <?php echo $row->description ?>
	            </textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="bmd-label-floating "> Bizim Notumuz</label>
                    <textarea cols="80" id="editor2" class="ckeditor" name="notes">
                        <?php echo $row->notes ?>
	            </textarea>
                </div>


                <div class="form-group">
                    <label for="ip_adress" class="bmd-label-floating "> Ip adres </label>
                    <input type="text" value="<?php echo $row->ip_adress ?>" readonly class="form-control"
                           id="ip_adress">
                </div>

                <div class="form-group">
                    <label for="browser" class="bmd-label-floating "> Browser </label>
                    <input type="text" value="<?php echo $row->browser ?>" readonly class="form-control" id="browser">
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="isActive" <?php checkBox($row->isActive); ?>
                               type="checkbox">
                        Durum
                        <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                    </label>
                </div>


            </div>


            <div class="card-footer text-right">

                <label class="form-check-label">
                    <a href="<?php echo base_url("admin/contact") ?>" class="btn btn-rose">Listeye Dön</a>

                </label>

                <button type="submit" class="btn btn-warning">Güncelle</button>
            </div>


        </div>

        <input type="hidden" name="contact_id" value="<?php echo $row->id; ?>">
    </form>

    <hr>


</div>

<div class="col-md-5">
    <form id="LoginValidation" action="<?php echo base_url("admin/contact/email") ?>" method="POST">
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title">Mesaj Gönder</h4>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="note" class="bmd-label-floating "> Geri Bildirim(Mesaj)</label>
                    <textarea cols="80" id="editor3" class="ckeditor" name="feedback">
                        <?php echo $row->feedback ?>
	            </textarea>
                </div>

                <div class="card-footer text-right">
                    <div class="form-check mr-auto">

                    </div>
                    <button type="submit" class="btn btn-warning">Gönder</button>
                </div>
            </div>
        </div>
</div>
<input type="hidden" name="messageid" value="<?php echo $row->id ; ?>">
</form>
</div>