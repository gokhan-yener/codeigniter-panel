<div class="col-md-12">
    <a href="<?php echo base_url('admin/user/user_add') ?>" class="btn btn-primary btn-sm">
        <i class="fa fa-plus-circle"></i>
        Kullanıcı Ekle
    </a>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">Kullanıcılar</h4>
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
                        <th>Adı Soyadı</th>
                        <th>Kullanıcı Adı</th>
                        <th>Eposta</th>
                        <th>Grup</th>
                        <th>Son Giriş</th>
                        <th class="text-right">Durum</th>
                        <th class="disabled-sorting text-right">İşlemler</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    $this->load->helper("thema_helper");
                    foreach ($getRows as $row): ?>
                    <tr>
                        <td><?php echo $row->first_name ." ". $row->last_name; ?></td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo timeDate($row->last_login,TRUE); ?></td>
                        <td class="text-right">
                            <?php echo switchIsactiveButton($row->id,$row->active,"admin/user/isActiveSetter"); ?>
                        </td>

                        <td class="text-right">
                            <?php echo editButtonForList("admin/user/user_edit/$row->id"); ?>
                            <?php echo deleteButtonForList("admin/user/user_delete/$row->id"); ?>
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
        </div><!-- end user-->
    </div><!--  end card  -->
</div> <!-- end col-md-12 -->
</div>








