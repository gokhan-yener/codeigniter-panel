<?php $pagename=$this->uri->segment(2);?>
<div class="logo">
        <a href="#" class="simple-text logo-mini">
           GY
        </a>

        <a href="#" class="simple-text logo-normal">
             Yöetim Paneli
        </a>

    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?php echo base_url();?>assets/admin/default/img/default-avatar.png" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>
                       <?php echo $this->ion_auth->get_user_name(); ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <span class="sidebar-mini"> MP </span>
                              <span class="sidebar-normal"> Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <span class="sidebar-mini"> EP </span>
                              <span class="sidebar-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                              <span class="sidebar-mini"> S </span>
                              <span class="sidebar-normal"> Settings </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">

            <li class="nav-item <?php  echo $pagename=='' ? 'active' : '';?>">
                <a class="nav-link" href="<?php echo base_url();?>admin/home">
                    <i class="material-icons">dashboard</i>
                    <p> Anasayfa <?php //echo $pagename;?> </p>
                </a>
            </li>



            <li class="nav-item <?php echo menu_active($pagename,array("user", "user_add"));?>">
                <a class="nav-link" data-toggle="collapse" href="#users">
                    <i class="material-icons">image</i>
                    <p> Kullanıcılar
                        <b class="caret"></b>
                    </p>
                </a>

                <div  class="collapse <?php echo menu_show($pagename,array("user", "user_add","user_cat"));?>" id="users">
                    <ul class="nav">
                        <li class="nav-item <?php echo menu_active($pagename,array("user"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/user">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal"> Kullanıcılar </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo menu_active($pagename,array("user_add"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/user/user_add">
                                <span class="sidebar-mini"> KE </span>
                                <span class="sidebar-normal"> Kullanıcı Ekle </span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item <?php echo menu_active($pagename,array("user_cat"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/user_cat">
                                <span class="sidebar-mini"> KG </span>
                                <span class="sidebar-normal"> Kullanıcı Grup </span>
                            </a>
                        </li>

                        <li class="nav-item <?php echo menu_active($pagename,array("authentication"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/authentication">
                                <span class="sidebar-mini"> KG </span>
                                <span class="sidebar-normal"> Yetkisiz giriş örneği(authentication) </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="nav-item <?php echo menu_active($pagename,array("contact", "contact_add"));?>">
                <a class="nav-link" data-toggle="collapse" href="#contact">
                    <i class="material-icons">message</i>
                    <p> Mesajlar
                        <b class="caret"></b>
                    </p>
                </a>

                <div  class="collapse <?php echo menu_show($pagename,array("contact", "contact_add"));?>" id="contact">
                    <ul class="nav">
                        <li class="nav-item <?php echo menu_active($pagename,array("contact"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/contact">
                                <span class="sidebar-mini"> M </span>
                                <span class="sidebar-normal"> Mesajlar </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo menu_active($pagename,array("contact_add"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/contact/contact_add">
                                <span class="sidebar-mini"> ME </span>
                                <span class="sidebar-normal"> Mesaj Ekle </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="nav-item <?php echo menu_active($pagename,array("content", "add"));?>">
                <a class="nav-link" data-toggle="collapse" href="#content">
                    <i class="material-icons">
                        text_format
                    </i>
                    <p> İçerik(Haber/Ders)
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?php echo menu_show($pagename,array("content", "content_add"));?>" id="content">
                    <ul class="nav">
                        <li class="nav-item <?php echo menu_active($pagename,array("content"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/content">
                                <span class="sidebar-mini"> İ </span>
                                <span class="sidebar-normal"> İçerik </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo menu_active($pagename,array("content_add"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/content/content_add">
                                <span class="sidebar-mini"> İE </span>
                                <span class="sidebar-normal">İçerik Ekle </span>
                            </a>
                        </li>



                    </ul>
                </div>
            </li>

            <li class="nav-item <?php echo menu_active($pagename,array("product", "product_add"));?>">
                <a class="nav-link" data-toggle="collapse" href="#product">
                    <i class="material-icons">add_shopping_cart</i>
                    <p> Ürünler
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?php echo menu_show($pagename,array("product", "product_add"));?>" id="product">
                    <ul class="nav">
                        <li class="nav-item <?php echo menu_active($pagename,array("product"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/product">
                                <span class="sidebar-mini"> Ü </span>
                                <span class="sidebar-normal"> Ürünler </span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo menu_active($pagename,array("product_add"));?>">
                            <a class="nav-link" href="<?php echo base_url();?>admin/product/product_add">
                                <span class="sidebar-mini"> ÜE </span>
                                <span class="sidebar-normal"> Ürün Ekle </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>




<!--
            <li class="nav-item <?php /*echo menu_active($pagename,array("supplier", "supplier_add"));*/?>">
                <a class="nav-link" data-toggle="collapse" href="#supplier">
                    <i class="material-icons">person</i>
                    <p> Tedarikçiler
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?php /*echo menu_show($pagename,array("supplier", "supplier_add"));*/?>" id="supplier">
                    <ul class="nav">
                        <li class="nav-item <?php /*echo menu_active($pagename,array("supplier"));*/?>">
                            <a class="nav-link" href="<?php /*echo base_url();*/?>admin/supplier">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal"> Tedarikçiler </span>
                            </a>
                        </li>
                        <li class="nav-item <?php /*echo menu_active($pagename,array("supplier_add"));*/?>">
                            <a class="nav-link" href="<?php /*echo base_url();*/?>admin/supplier/supplier_add">
                                <span class="sidebar-mini"> TE </span>
                                <span class="sidebar-normal"> Tedarikçi Ekle </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>






            <li class="nav-item <?php /*echo menu_active($pagename,array("category", "category_add"));*/?>">
                <a class="nav-link" data-toggle="collapse" href="#category">
                    <i class="material-icons">image</i>
                    <p> Kategoriler
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?php /*echo menu_show($pagename,array("category", "category_add"));*/?>" id="category">
                    <ul class="nav">
                        <li class="nav-item <?php /*echo menu_active($pagename,array("category"));*/?>">
                            <a class="nav-link" href="<?php /*echo base_url();*/?>admin/category">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal"> Kategoriler </span>
                            </a>
                        </li>
                        <li class="nav-item <?php /*echo menu_active($pagename,array("category_add"));*/?>">
                            <a class="nav-link" href="<?php /*echo base_url();*/?>admin/category/category_add">
                                <span class="sidebar-mini"> KE </span>
                                <span class="sidebar-normal"> Kategori Ekle </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


-->

      <!--      <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples" aria-expanded="true">
                    <i class="material-icons">apps</i>
                    <p> Components 
                       <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse " id="componentsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="buttons.html">
                              <span class="sidebar-mini"> B </span>
                              <span class="sidebar-normal"> Buttons </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="grid.html">
                              <span class="sidebar-mini"> GS </span>
                              <span class="sidebar-normal"> Grid System </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="panels.html">
                              <span class="sidebar-mini"> P </span>
                              <span class="sidebar-normal"> Panels </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="sweet-alert.html">
                              <span class="sidebar-mini"> SA </span>
                              <span class="sidebar-normal"> Sweet Alert </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="notifications.html">
                              <span class="sidebar-mini"> N </span>
                              <span class="sidebar-normal"> Notifications </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="icons.html">
                              <span class="sidebar-mini"> I </span>
                              <span class="sidebar-normal"> Icons </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="typography.html">
                              <span class="sidebar-mini"> T </span>
                              <span class="sidebar-normal"> Typography </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                    <i class="material-icons">content_paste</i>
                    <p> Forms 
                       <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="../forms/regular.html">
                              <span class="sidebar-mini"> RF </span>
                              <span class="sidebar-normal"> Regular Forms </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../forms/extended.html">
                              <span class="sidebar-mini"> EF </span>
                              <span class="sidebar-normal"> Extended Forms </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../forms/validation.html">
                              <span class="sidebar-mini"> VF </span>
                              <span class="sidebar-normal"> Validation Forms </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../forms/wizard.html">
                              <span class="sidebar-mini"> W </span>
                              <span class="sidebar-normal"> Wizard </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                    <i class="material-icons">grid_on</i>
                    <p> Tables 
                       <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="../tables/regular.html">
                                <span class="sidebar-mini"> RT </span>
                                <span class="sidebar-normal"> Regular Tables </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../tables/extended.html">
                              <span class="sidebar-mini"> ET </span>
                              <span class="sidebar-normal"> Extended Tables </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../tables/datatables.net.html">
                              <span class="sidebar-mini"> DT </span>
                              <span class="sidebar-normal"> DataTables.net </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
-->
     


            
        </ul>
    </div>
