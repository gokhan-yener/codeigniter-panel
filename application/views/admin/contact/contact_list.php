<div class="col-lg-4 col-md-12">
    <div class="card">
        <div class="card-header card-header-text card-header-info">
            <div class="card-text">
                <h4 class="card-title">Menü</h4>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">

                <tbody>
                <tr>
                    <td><a href="<?php echo base_url(); ?>admin/contact">Tüm Mesajlar </a>/ <a href="<?php echo base_url(); ?>admin/contact/unread">Okunmayanlar</a></td>
                    <td><span class="badge badge-rose text-right"><?php echo $inbox->inbox; ?> / <?php echo $unRead->unread; ?></span></td>
                </tr>
                <tr>
                    <td><a href="<?php echo base_url(); ?>admin/contact/sendEmail">Gönderilenler</a></td>
                    <td><span class="badge badge-danger text-right"><?php echo $sentCount->mail; ?></span></td>
                </tr>
                <tr>
                    <td><a href="<?php echo base_url(); ?>admin/contact/trash">Çöp Kutusu</a></td>
                    <td><span class="badge badge-primary text-right"><?php echo $trash->trash; ?></span></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-8 col-md-12">
    <div class="card">
        <div class="card-header card-header-text card-header-rose">
            <div class="card-text">
                <h4 class="card-title">Mesajlar</h4>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-rose">
                <th>#</th>
                <th>Kategori</th>
                <th>Konu</th>
                <th>Tarih</th>
                <th class="text-right">Okundu mu ?</th>
                <th>İşlemler</th>
                </thead>
                <tbody>
                <?php
                $this->load->helper("thema_helper");
                foreach ($rows as $row) { ?>
                    <tr>
                        <td>1</td>
                        <td><?php echo $row->category; ?></td>
                        <td><?php echo $row->subject; ?></td>
                        <td><?php echo dateTr($row->save_date); ?></td>
                        <td class="text-center">
                            <?php if ((int)$row->is_read == 0) { ?>
                             <i class="material-icons" style="color: red;">
                                    drafts
                                </i><?php } else { ?>
                                <i class="material-icons" style="color: forestgreen;">
                                    mail
                                </i>
                            <?php } ?></td>
                        <td>

                            <?php echo editButtonForList("admin/contact/contact_edit/$row->id"); ?>
                            <?php echo deleteButtonForList("admin/contact/contact_delete/$row->id"); ?>

                        </td>
                    </tr>
                <?php }; ?>

                </tbody>
            </table>
            <strong>Gösterilen Kayıt Sayısı: <?php echo $recordCount; ?></strong>
        </div>
    </div>
</div>

