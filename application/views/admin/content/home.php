<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/inc/header'); ?>
<body class="users">
<div class="wrapper">
    <div class="sidebar" data-color="rose" data-background-color="white"
         data-image="<?php echo base_url(); ?>assets/admin/default/img/sidebar-1.jpg">

        <?php $this->load->view('admin/inc/sidebar'); ?>

    </div>

    <div class="main-panel">
        <!-- Navbar -->


        <?php $this->load->view('admin/inc/nav', $breadcrumb); ?>
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

<?php $this->load->view('admin/content/page_script'); ?>



