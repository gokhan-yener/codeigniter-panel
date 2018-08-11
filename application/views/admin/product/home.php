<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<?php $this->load->view('admin/inc/header');?>
<link rel="stylesheet" href="<?php echo base_url("assets/"); ?>admin/_common/magnific-popup.css">

<body class="users">
<div class="wrapper">
    <div class="sidebar" data-color="rose" data-background-color="white"
         data-image="<?php echo base_url(); ?>assets/admin/default/img/sidebar-1.jpg">
        <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

            Tip 2: you can also add an image using data-image tag
        -->

        <?php $this->load->view('admin/inc/sidebar'); ?>

    </div>

    <div class="main-panel">
        <!-- Navbar -->


        <?php $this->load->view('admin/inc/nav',$breadcrumb); ?>
        <!-- End Navbar -->


        <div class="content" style="">
            <div class="container-fluid">


                <div class="row">

                    <?php $this->load->view($content); ?>


                </div>

            </div>
        </div>


        <?php $this->load->view('admin/inc/footer'); ?>

    </div>

</div>
</body>
</html>

<?php $this->load->view('admin/inc/script'); ?>
<?php $this->load->view('admin/inc/script_common'); ?>
<?php $this->load->view('admin/product/page_script'); ?>



