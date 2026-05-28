<?php
$user = isset($session_user) ? $session_user : array('role' => '', 'nama' => '');
$role = $user['role'];
$current_uri = uri_string();
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT Maju Jaya</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= (strpos($current_uri, 'dashboard') !== FALSE || $current_uri === '') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <?php if ($role === 'admin') : ?>
    <!-- ADMIN MENU -->
    <div class="sidebar-heading">Manajemen Data</div>

    <li class="nav-item <?= (strpos($current_uri, 'product') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('product') ?>">
            <i class="fas fa-fw fa-box"></i>
            <span>Data Produk</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos($current_uri, 'customer') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('customer') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pelanggan</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Sales Order</div>

    <li class="nav-item <?= (strpos($current_uri, 'order') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('order') ?>">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Semua Order</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Laporan</div>

    <li class="nav-item <?= (strpos($current_uri, 'report') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport" class="collapse <?= (strpos($current_uri, 'report') !== FALSE) ? 'show' : '' ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('report') ?>">Per Sales</a>
                <a class="collapse-item" href="<?= base_url('report/byProduct') ?>">Per Produk</a>
                <a class="collapse-item" href="<?= base_url('report/byPeriod') ?>">Per Periode</a>
            </div>
        </div>
    </li>

    <?php elseif ($role === 'sales') : ?>
    <!-- SALES MENU -->
    <div class="sidebar-heading">Sales Order</div>

    <li class="nav-item <?= (strpos($current_uri, 'order/create') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('order/create') ?>">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Buat Order Baru</span>
        </a>
    </li>

    <li class="nav-item <?= ($current_uri === 'order' || (strpos($current_uri, 'order') !== FALSE && strpos($current_uri, 'create') === FALSE)) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('order') ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Order Saya</span>
        </a>
    </li>

    <?php elseif ($role === 'manager') : ?>
    <!-- MANAGER MENU -->
    <div class="sidebar-heading">Laporan</div>

    <li class="nav-item <?= (strpos($current_uri, 'report') !== FALSE) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport" class="collapse <?= (strpos($current_uri, 'report') !== FALSE) ? 'show' : '' ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('report') ?>">Per Sales</a>
                <a class="collapse-item" href="<?= base_url('report/byProduct') ?>">Per Produk</a>
                <a class="collapse-item" href="<?= base_url('report/byPeriod') ?>">Per Periode</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?= htmlspecialchars($user['nama']) ?>
                    <span class="badge badge-pill badge-<?= $role === 'admin' ? 'danger' : ($role === 'manager' ? 'warning' : 'info') ?> ml-1">
                        <?= strtoupper($role) ?>
                    </span>
                </span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/undraw_profile.svg') ?>"
                     style="width:32px;height:32px;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
</nav>
<!-- End of Topbar -->

<!-- Main Content -->
<div class="container-fluid">

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>