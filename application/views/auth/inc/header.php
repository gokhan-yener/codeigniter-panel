<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/admin/default/img/apple-icon.png">
    <link rel="icon" href="<?php echo base_url(); ?>assets/admin/default/img/favicon.png">

    <!--  Social tags      -->
    <meta name="keywords" content="">

    <meta name="description" content="">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>


    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/admin/default/css/material-dashboard.min790f.css?v=2.0.1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/default/css/custom.css">

</head>
<title>CMS-login</title>
<body class="off-canvas-sidebar login-page">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary navbar-transparent navbar-absolute" color-on-scroll="500">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo"><?php echo isset($site_name) ? $site_name . ' - ' : NULL; ?>Kullanıcı
                Girişi</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="material-icons">dashboard</i>
                        Anasayfa
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo base_url("auth/create_user"); ?>" class="nav-link">
                        <i class="material-icons">person_add</i>
                        Kayıt Ol
                    </a>
                </li>
                <li class="nav-item  active ">
                    <a href="<?php echo base_url("auth/login"); ?>" class="nav-link">
                        <i class="material-icons">fingerprint</i>
                        Kullanıcı Girişi
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->


<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black"
         style="background-image: url('<?php echo base_url() ?>assets/admin/default/img/login.jpg'); background-size: cover; background-position: top center;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->

        <div class="container">
            <div class="col-md-4 col-sm-6 ml-auto mr-auto">