<?php
$message =$this->session->flashdata("message");
if($message):
    echo $message;
endif;
?>
<div class="col-md-8">
    <form id="LoginValidation" action="<?php echo base_url("admin/user/user_save")?>" method="POST" >
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?php echo $category2;?></h4>
            </div>
            <div class="card-body ">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating "> Adı *</label>
                            <input type="text" value=""  class="form-control" id="name" autofocus required name="first_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="surname" class="bmd-label-floating "> Soyadı  </label>
                            <input type="text"  value="" name="last_name"  class="form-control" id="surname" maxlength="250" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="bmd-label-floating "> Kullanıcı Adı  </label>
                            <input type="text" name="identity"  value=""  class="form-control" id="identity" maxlength="250" required >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="bmd-label-floating "> Eposta  </label>
                            <input type="text"  value="" name="email"  class="form-control" id="email" maxlength="250" required >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="bmd-label-floating "> Şifre </label>
                            <input type="password" name="password"  class="form-control" id="pass1" maxlength="20" required >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="bmd-label-floating "> Şifre (Tekrar) </label>
                            <input type="password" name="password_confirm"    class="form-control" id="password_confirm" maxlength="20" required >
                        </div>
                    </div>
                </div>




                <div class="form-group">
                   <label for="mobil_phone" class="bmd-label-floating "> Cep Tel </label>
                    <input type="text"  value="" name="phone" class="form-control" id="mobile_phone"  maxlength="10" >
                </div>


                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="active" type="checkbox" checked >
                        Durum
                        <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                    </label>
                </div>

            </div>
            <div class="card-footer text-right">

                <label class="form-check-label">
                    <a href="<?php echo base_url("admin/user")?>" class="btn btn-rose">
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