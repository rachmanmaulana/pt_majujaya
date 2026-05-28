<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= isset($title) ? $title . ' — PT Maju Jaya' : 'PT Maju Jaya Sales Order System' ?></title>

    <!-- Font Awesome (local) -->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <!-- SB Admin 2 CSS (local) -->
    <link href="<?= base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
    <!-- DataTables CSS -->
    <style>
      table.dataTable thead th {
    background-color: #393e41;
    color: #fff;
}
.badge-draft      { background-color: #d3d0cb; color: #393e41; }
.badge-dikirim    { background-color: #36b9cc; color: #fff; }
.badge-selesai    { background-color: #44bba4; color: #fff; }
.badge-dibatalkan { background-color: #e74a3b; color: #fff; }
.sidebar .nav-item .nav-link { font-size: 0.85rem; }
    </style>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php /* sidebar di-include terpisah */ ?>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>