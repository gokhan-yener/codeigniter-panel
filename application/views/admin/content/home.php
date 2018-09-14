<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$folder = "admin/inc";
?>
<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder.'/header'); ?>
<link rel="stylesheet" href="<?php echo base_url("assets/admin/_common/dropzone.css"); ?>">
<body class="users">
<div class="wrapper">
    <div class="sidebar" data-color="rose" data-background-color="white"
         data-image="<?php echo base_url(); ?>assets/admin/default/img/sidebar-1.jpg">

        <?php $this->load->view($folder.'/sidebar'); ?>

    </div>

    <div class="main-panel">
        <!-- Navbar -->


        <?php $this->load->view($folder.'/nav', $breadcrumb); ?>
        <!-- End Navbar -->


        <div class="content" style="">
            <div class="container-fluid">


                <div class="row">

                    <?php $this->load->view($content); ?>


                </div>

            </div>
        </div>


        <?php $this->load->view($folder.'/footer'); ?>

    </div>

</div>
</body>
</html>

<?php $this->load->view($folder.'/script'); ?>

<?php $this->load->view($folder.'/script_common'); ?>

<?php $this->load->view('admin/content/page_script'); ?>



