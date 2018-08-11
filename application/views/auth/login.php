<?php $this->load->view("auth/inc/header"); ?>

<?php
// $message = $this->session->flashdata("message");
if ($message):
    echo $message;
endif;
?>
<form class="form" method="POST" action="<?php echo base_url("auth/login"); ?>">

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
                    <input type="text" name="identity" id="identity" class="form-control"
                    placeholder="Eposta/Kullanıcı Adı...">
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


            <div class="input-group ml-4 mt-4">
                <div class="form-check">

                    <label class="form-check-label">
                        <input class="form-check-input btn-xs" name="remember" type="checkbox" value="1">
                        Beni Hatırla
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>

        </div>

        <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-rose btn-link btn-lg">Giriş</button>


        </div>
        <div class="card-footer justify-content-center">
            <a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>

        </div>
    </div>


</form>


<?php $this->load->view("auth/inc/footer"); ?>
