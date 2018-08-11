<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header card-header-text card-header-info">
            <div class="card-text">
                <h4 class="card-title">Menü</h4>
            </div>
        </div>
        <div class="card-body table-responsive">
            Hoşgeldiniz

            <?php
             $this->session->set_userdata('some_name',"123");
             echo $this->session->userdata("some_name");
            //$this->session->unset_userdata('some_name');
            echo $this->session->has_userdata('some_name');
            echo $this->session->userdata("some_name");
            ?>
        </div>
    </div>

</div>