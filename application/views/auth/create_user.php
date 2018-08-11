<?php $this->load->view("auth/inc/header"); ?>

<?php
// $message = $this->session->flashdata("message");
if ($message):
    echo $message;
endif;
?>
<form class="form" method="POST" action="<?php echo base_url("auth/create_user"); ?>">

    <div class="card card-login card-hidden">

        <div class="card-header card-header-rose text-center">
            <h4 class="card-title">Panel Girişi</h4>
            <div class="social-line">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                    <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-just-icon btn-link btn-white">
                    <i class="fa fa-google-plus"></i>
                </a>
            </div>
        </div>

        <div class="card-body ">
            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">face</i>
                    </span>
                    </div>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Adı...">
                    </div>
            </span>

            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">face</i>
                    </span>
                    </div>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Soyadı...">
                    </div>
            </span>
            <?php  if($identity_column!=='email') { ?>
            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">face</i>
                    </span>
                    </div><?php  echo form_error('identity');?>
                        <input type="text" name="identity" id="identity" class="form-control" placeholder="Kullanıcı adı...">
                    </div>
            </span>
          <?php  } ?>

            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">alternate_email</i>
                    </span>
                    </div>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Eposta...">
                    </div>
            </span>

            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">phone</i>
                    </span>
                    </div>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefon...">
                    </div>
            </span>

            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                    </span>
                    </div>
                        <input type="password" name="password" required class="form-control" placeholder="Şifre...">
                    </div>
             </span>

            <span class="bmd-form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                    </span>
                    </div>
                        <input type="password" name="password_confirm" required class="form-control" placeholder="Şifre Tekrar...">
                    </div>
             </span>


        </div>

        <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-rose btn-link btn-lg">Kayıt Ol</button>


        </div>

    </div>


</form>


<?php $this->load->view("auth/inc/footer"); ?>

