<div class="col-md-12">
    <a href="<?php echo base_url('admin/content/content_add') ?>" class="btn btn-primary btn-sm">
        <i class="fa fa-plus-circle"></i>
        İçerik Ekle
    </a>
    <a href="<?php echo base_url('admin/content/excel') ?>" class="btn btn-success btn-sm pull-right">
        <i class="fa fa-file-excel-o"></i>
         Excel Çıktı Al
    </a>
    <form action="<?php echo base_url(); ?>admin/content/excelUpload" name="frm" method="post" enctype="multipart/form-data">
        <button type="submit" class="btn btn-info pull-right">Excel Ekle</button>
        <input type="file" name="excel" placeholder="Excel Yükle" class="btn btn-round btn-success btn-file pull-right">

    </form>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">İçerikler</h4>
        </div>
        <div class="card-body">
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
                <?php if(count($getAll)>0){?>
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>

                    <tr>
                        <th class="col-xs-1">No</th>
                        <th>Başlık</th>
                        <th>Slug</th>
                        <th>Kayıt Tarihi</th>
                        <th>Kategori</th>
                        <th class="text-right">Durum</th>
                        <th class="disabled-sorting text-right">İşlemler</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    $this->load->helper("thema_helper");
                    foreach ($getAll as $row): ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo mb_substr($row->title,0,100); ?></td>
                        <td><?php echo $row->slug; ?></td>
                        <td><?php echo date("d.m.y",strtotime($row->save_date)); ?></td>
                        <td><?php echo $row->c_title; ?></td>
                        <td class="text-right">
                            <?php echo switchIsactiveButton($row->id,$row->isActive,"admin/content/isActiveSetter"); ?>
                        </td>

                        <td class="text-right">
                            <?php echo editButtonForList("admin/content/content_edit/$row->id"); ?>
                            <?php echo deleteButtonForList("admin/content/content_delete/$row->id"); ?>
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
        </div><!-- end content-->
    </div><!--  end card  -->
</div> <!-- end col-md-12 -->
</div>








