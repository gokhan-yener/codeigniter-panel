<div class="col-md-12">
    <a href="<?php echo base_url('admin/product/product_add') ?>" class="btn btn-primary btn-sm">
        <i class="fa fa-plus-circle"></i>
        Ürün Ekle
    </a>
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
                        <th>No</th>
                        <th class="disabled-sorting text-left">Resim(varsa)</th>
                        <th>Başlık</th>
                        <th>Kodu</th>
                        <th>Miktar</th>
                        <th>Liste Fiyatı</th>
                        <th>Satış Fiyatı</th>
                        <th>Tedarikçi</th>
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
                        <td class="col-md-2">

                            <?php
                            if(strlen($row->img_id)>0 && file_exists("./uploads/products/thumb/$row->img_id")) {?>
                            <a href="<?php echo base_url(); ?>uploads/products/<?php echo $row->img_id; ?>" class="magnific"><?php
                                echo '<img class="thumbnail" src="' . base_url() . "uploads/products/thumb/" . $row->img_id . '" width="50" alt="' . $row->title . '"></a>';
                            }else{?>
                                <img src="<?php echo base_url();?>assets/images/noimage.jpg" alt="...">
                            <?php }; ?>

                        </td>
                        <td><?php echo mb_substr($row->title,0,75); ?></td>
                        <td><?php echo $row->code; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td><?php echo $row->list_price; ?></td>
                        <td><?php echo $row->sale_price; ?></td>
                        <td><?php echo $row->supplier_title; ?></td>
                        <td><?php echo $row->category_title; ?></td>
                        <td class="text-right">
                          <?php echo switchIsactiveButton($row->id,$row->isActive,"admin/product/isActiveSetter"); ?>
                        </td>
                        <td class="text-right">
                            <?php echo editButtonForList("admin/product/product_edit/$row->id"); ?>
                            <?php echo deleteButtonForList("admin/product/product_delete/$row->id"); ?>
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
        </div><!-- end product-->
    </div><!--  end card  -->
</div> <!-- end col-md-12 -->
</div>








