<?php
$message = $this->session->flashdata("message");
if ($message):
    echo $message;
endif;
?>
<div class="col-md-5">
    <form id="LoginValidation" action="<?php echo base_url("admin/user_cat/user_cat_update") ?>" method="POST">
        <div class="card ">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2; ?></h4>
            </div>
            <div class="card-body ">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating "> Grup Adı *</label>
                        <input type="text" value="<?php echo $row->name; ?>" class="form-control" id="name"
                               autofocus required="true" name="name">
                    </div>
                </div>


                <div class="card-footer text-right">

                    <label class="form-check-label">
                        <a href="<?php echo base_url("admin/user_cat") ?>" class="btn btn-rose">
                            <i class="material-icons">
                                keyboard_return
                            </i>
                            Listeye Dön</a>

                    </label>

                    <button type="submit" class="btn btn-warning">
                        <i class="material-icons">
                            check
                        </i>Güncelle
                    </button>


                </div>
            </div>
            <input type="hidden" name="user_cat_id" value="<?php echo $row->id; ?>">
    </form>
</div></div>

<div class="col-md-7">
    <div class="card">
        <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
                <i class="material-icons">
                    security
                </i>
            </div>
            <h4 class="card-title">Kullanıcı Yetkileri</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="">
                    <th class="text-center">Sayfa</th>
                    <th class="text-center">Okuma</th>
                    <th class="text-center">Yazma</th>
                    <th class="text-center">Güncelleme</th>
                    <th class="text-center">Silme</th>
                    </thead>
                    <tbody>

                    <?php
                    $this->load->helper("thema_helper");
                    foreach ($privileges as $privilege) {?>
                    <tr>
                        <td class="text-center"><strong><?php echo $privilege->controller_name?></strong></td>
                        <td class="text-center"><?php echo $privilege->can_read== 0? flexibleButtonForList("red", "check_box_outline_blank"): flexibleButtonForList("green", "check"); ?></td>
                        <td class="text-center"><?php echo $privilege->can_create== 0? flexibleButtonForList("red", "check_box_outline_blank"): flexibleButtonForList("green", "check"); ?></td>
                        <td class="text-center"><?php echo $privilege->can_update== 0? flexibleButtonForList("red", "check_box_outline_blank"): flexibleButtonForList("green", "check"); ?></td>
                        <td class="text-center"><?php echo $privilege->can_delete== 0? flexibleButtonForList("red", "check_box_outline_blank"): flexibleButtonForList("green", "check"); ?></td>
                    </tr>
                    <?php }; ?>

                    </tbody>
                </table>

                <button data-toggle="modal" class="btn btn-info pull-right" data-target="#myModal">
                    <i class="material-icons">
                        add
                    </i>Ekle / Güncelle
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Classic Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sayfa İsmi Ekle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form action="#">
            <div class="modal-body">

                <div class="form-group bmd-form-group is-filled">
                    <label for="pagename">Sayfa Adı</label>
                    <select name="pagename" id="pagename" required class="selectpicker" data-style="btn select-with-transition">
                        <option value="">Seçiniz</option>
                        <?php foreach ($controllernames as $controllername) {?>
                        <option value="<?php echo $controllername; ?>"><?php echo $controllername; ?></option>
                        <?php };?>

                    </select>
                    <input type="hidden" name="access_auth_id" id="access_auth_id" value="">
                </div>



                <div class="col-sm-12">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" id="read" type="checkbox" value="">
                            Okuma
                            <span class="form-check-sign">
                                                      <span class="check"></span>
                                                  </span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" id="create" type="checkbox" value="">
                            Yazma
                            <span class="form-check-sign">
                                                      <span class="check"></span>
                                                  </span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" id="update" type="checkbox" value="">
                            Güncelleme
                            <span class="form-check-sign">
                                                      <span class="check"></span>
                                                  </span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" id="delete" type="checkbox" value="">
                            Silme
                            <span class="form-check-sign">
                                                      <span class="check"></span>
                                                  </span>
                        </label>
                    </div>
                </div>





            </div>
            <div class="modal-footer">
                <input type="hidden" name="group_id" id="group_id" value="<?php echo $row->id; ?>">
                <button type="button" id="savebutton" class="btn btn-link">Ekle</button>
                <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Kapat</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!--  End Modal -->