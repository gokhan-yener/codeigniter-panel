<div class="col-md-6">

    <div class="card">
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Kullanıcı Grupları</h4>
        </div>
        <div class="card-body">
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
                <?php if(count($getRows)>0){?>
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>

                    <tr>
                        <th>Grup Adı</th>
                        <th class="disabled-sorting text-right">İşlemler</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    $this->load->helper("thema_helper");
                    foreach ($getRows as $row): ?>
                    <tr>
                        <td><?php echo $row->name; ?></td>


                        <td class="text-right">
                            <?php echo editButtonForList("admin/user_cat/user_cat_edit/$row->id"); ?>
                            <?php echo deleteButtonForList("admin/user_cat/user_cat_delete/$row->id"); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

                <?php } else { ?>
                    <div class="alert alert-rose alert-with-icon" data-notify="container">
                        <i class="material-icons" data-notify="icon">notifications</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span data-notify="message">
                            Henüz kayıt mevcut değil
                        </span>
                    </div>
                <?php } ?>
            </div>
        </div><!-- end users_cat-->
    </div><!--  end card  -->
</div> <!-- end col-md-12 -->

<div class="col-md-6">
 <div class="col-xs-12"></div>
    <?php
    $message =$this->session->flashdata("message");
    if($message):
        echo $message;
    endif;
    ?>

            <form id="LoginValidation" name="frm" action="<?php echo base_url("admin/user_cat/user_cat_save")?>" method="POST" >
                <div class="card ">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">add</i>
                        </div>
                        <h4 class="card-title">Kullanıcı Grubu Ekle</h4>
                    </div>
                    <div class="card-body ">

                        <div class="form-group">
                            <label for="name" class="bmd-label-floating "> Grup Adı *</label>
                            <input type="text" value=""  class="form-control" id="name" autofocus required name="name">
                        </div>


                    </div>
                    <div class="card-footer text-right">

                        <label class="form-check-label">
                            <a href="<?php echo base_url("admin/users_cat")?>" class="btn btn-rose">
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







