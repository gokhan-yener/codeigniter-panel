<?php
$message = $this->session->flashdata("message");
if ($message):
    echo $message;
endif;
?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/user/user_update") ?>" method="POST">
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2; ?></h4>
            </div>
            <div class="card-body ">



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating "> Adı *</label>
                            <input type="text" value="<?php echo $row->first_name; ?>" class="form-control" id="name"
                                   autofocus required="true" name="first_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surname" class="bmd-label-floating "> Soyadı </label>
                            <input type="text" name="last_name" value="<?php echo $row->last_name ?>" class="form-control" id="last_name"
                                   maxlength="250">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="bmd-label-floating "> Kullanıcı Adı </label>
                            <input type="text" name="identity" readonly value="<?php echo $row->username ?>" class="form-control" id="identity"
                                   maxlength="250">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="bmd-label-floating "> Eposta </label>
                            <input type="text" name="email" readonly value="<?php echo $row->email ?>" required class="form-control"
                                   id="email" maxlength="250">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="bmd-label-floating "> Şifre </label>
                            <input type="password" name="password" class="form-control" id="password" maxlength="20">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="bmd-label-floating "> Şifre (Tekrar) </label>
                            <input type="password" name="password_confirm" class="form-control" id="password_confirm" maxlength="20">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="mobil_phone" class="bmd-label-floating "> Cep Tel </label>
                    <input type="text" name="phone" value="<?php echo $row->phone ?>" class="form-control" id="phone"
                           >
                </div>


                <div class="form-group">
                    <label for="last_login_date" class="bmd-label-floating "> Son Giriş </label>
                    <input type="text" value="<?php echo timeDate($row->last_login,TRUE) ?>" class="form-control"
                           id="last_login_date" readonly>
                </div>


<div class="row">
                <?php if ($this->ion_auth->is_admin()): ?>

                <h3><?php echo lang('edit_user_groups_heading');?></h3>
                <?php foreach ($groups as $group):?>

                    <?php
                    $gID=$group->id;
                    $checked = null;
                    $item = null;
                    foreach($currentGroups as $grp) {
                        if ($gID == $grp->id) {
                            $checked= ' checked="checked"';
                            break;
                        }
                    }
                    ?>
                    <div class="col-2">
                    <div class="form-check m-l-20">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="groups[]" value="<?php echo $group->id;?>"<?php echo $checked;?>>
                            <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?>
                            <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                        </label>
                    </div>
                    </div>

                    <?php endforeach?>

                    <?php endif ?>
</div>

                    <hr>

                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="active" <?php checkBox($row->active); ?>
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
                    <a href="<?php echo base_url("admin/user") ?>" class="btn btn-rose">
                        <i class="material-icons">
                            keyboard_return
                        </i>
                        Listeye Dön</a>

                </label>



                <button type="submit" class="btn btn-warning pull-right">
                    <i class="material-icons">
                        check
                    </i>Güncelle
                </button>


            </div>
        </div>
        <?php echo form_hidden($csrf); ?>

        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
    </form>
</div>