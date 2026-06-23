<?php
$user = isset($session_user) ? $session_user : array('role' => '', 'nama' => '');
$role = $user['role'];
$current_uri = uri_string();
?>

<style>
/* ===== SIDEBAR ===== */
.sidebar {
    background: #0f172a !important;
    width: 14rem !important;
    min-height: 100vh;
}
.sidebar-brand {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
    padding: 1.25rem 1rem !important;
    height: auto !important;
    text-decoration: none;
}
.sidebar-brand-icon {
    background: rgba(255,255,255,0.15);
    border-radius: 0.5rem;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.sidebar-brand-icon i { font-size: 1rem; color: #fff !important; }
.sidebar-brand-text {
    font-size: 0.95rem !important;
    font-weight: 700 !important;
    color: #fff !important;
    letter-spacing: -0.01em;
}
.sidebar-brand-sub {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.6);
    display: block;
    font-weight: 400;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.sidebar-divider {
    border-color: rgba(255,255,255,0.07) !important;
    margin: 0.5rem 1rem !important;
}
.sidebar-heading {
    font-size: 0.65rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.1em !important;
    text-transform: uppercase !important;
    color: #475569 !important;
    padding: 0.75rem 1rem 0.25rem !important;
}
.sidebar .nav-item .nav-link {
    font-size: 0.82rem !important;
    font-weight: 500 !important;
    color: #94a3b8 !important;
    padding: 0.6rem 1rem !important;
    border-radius: 0.5rem !important;
    margin: 0.1rem 0.5rem !important;
    transition: background 0.15s ease, color 0.15s ease !important;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.sidebar .nav-item .nav-link i {
    width: 18px;
    text-align: center;
    font-size: 0.8rem;
    color: #64748b !important;
    flex-shrink: 0;
}
.sidebar .nav-item .nav-link:hover {
    background: rgba(255,255,255,0.06) !important;
    color: #e2e8f0 !important;
}
.sidebar .nav-item .nav-link:hover i { color: #94a3b8 !important; }
.sidebar .nav-item.active .nav-link {
    background: rgba(37,99,235,0.2) !important;
    color: #93c5fd !important;
}
.sidebar .nav-item.active .nav-link i { color: #60a5fa !important; }
/* Collapse sub-menu */
.collapse-inner {
    background: rgba(255,255,255,0.03) !important;
    border-radius: 0.5rem !important;
    margin: 0 0.5rem 0.25rem !important;
    padding: 0.25rem !important;
}
.collapse-item {
    font-size: 0.8rem !important;
    font-weight: 400 !important;
    color: #64748b !important;
    padding: 0.4rem 0.75rem !important;
    border-radius: 0.375rem !important;
    transition: all 0.15s ease !important;
}
.collapse-item:hover { background: rgba(255,255,255,0.06) !important; color: #94a3b8 !important; }
.collapse-item.active { color: #93c5fd !important; font-weight: 500 !important; }
/* Sidebar toggle button */
#sidebarToggle {
    background: rgba(255,255,255,0.07) !important;
    border-radius: 50% !important;
    width: 28px;
    height: 28px;
}

/* ===== TOPBAR / NAVBAR ===== */
.topbar {
    background: #ffffff !important;
    border-bottom: 1px solid #e2e8f0 !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
    height: 56px !important;
    padding: 0 1.25rem !important;
}
.topbar .navbar-nav .nav-link {
    color: #64748b !important;
    font-size: 0.875rem;
}
.topbar .topbar-divider {
    border-color: #e2e8f0 !important;
    margin: 0 0.75rem !important;
}
.topbar-user-name {
    font-size: 0.82rem;
    font-weight: 600;
    color: #1e293b;
}
.topbar-user-role {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0.15em 0.5em;
    border-radius: 9999px;
}
.role-admin   { background: #fee2e2; color: #991b1b; }
.role-manager { background: #fef3c7; color: #92400e; }
.role-sales   { background: #dbeafe; color: #1e40af; }

/* ===== CONTENT AREA ===== */
#content-wrapper { background: #f1f5f9 !important; }
#content { padding: 0 !important; }
.container-fluid { padding: 1.5rem 1.5rem !important; }

/* ===== FOOTER ===== */
.sticky-footer {
    background: #f8fafc !important;
    border-top: 1px solid #e2e8f0 !important;
    padding: 0.85rem 0 !important;
}
.sticky-footer span { font-size: 0.78rem; color: #94a3b8; }

/* ===== DROPDOWN ===== */
.dropdown-menu {
    border: 1px solid #e2e8f0 !important;
    border-radius: 0.625rem !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    padding: 0.4rem !important;
    font-size: 0.85rem !important;
}
.dropdown-item {
    border-radius: 0.375rem !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.82rem !important;
    color: #374151 !important;
}
.dropdown-item:hover { background: #f1f5f9 !important; color: #111827 !important; }

/* ===== MODAL ===== */
.modal-content { border: none !important; border-radius: 0.75rem !important; }
.modal-header { border-bottom: 1px solid #e2e8f0 !important; padding: 1rem 1.25rem !important; }
.modal-footer { border-top: 1px solid #e2e8f0 !important; padding: 0.75rem 1.25rem !important; }
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            PT Maju Jaya
            <span class="sidebar-brand-sub">Sales Order System</span>
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= (strpos($current_uri, 'dashboard') !== FALSE || $current_uri === '') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-home"></i>
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
                <a class="collapse-item <?= $current_uri === 'report' ? 'active' : '' ?>" href="<?= base_url('report') ?>">Per Sales</a>
                <a class="collapse-item <?= strpos($current_uri, 'byProduct') !== FALSE ? 'active' : '' ?>" href="<?= base_url('report/byProduct') ?>">Per Produk</a>
                <a class="collapse-item <?= strpos($current_uri, 'byPeriod') !== FALSE ? 'active' : '' ?>" href="<?= base_url('report/byPeriod') ?>">Per Periode</a>
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
        <i class="fa fa-bars text-gray-500"></i>
    </button>

    <ul class="navbar-nav ml-auto align-items-center">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-none d-lg-flex flex-column align-items-end mr-2" style="line-height:1.2">
                    <span class="topbar-user-name"><?= htmlspecialchars($user['nama']) ?></span>
                    <span class="topbar-user-role role-<?= $role ?>"><?= strtoupper($role) ?></span>
                </div>
                <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#0ea5e9);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user" style="color:#fff;font-size:0.8rem;"></i>
                </div>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <div class="dropdown-header" style="font-size:0.75rem;color:#64748b;padding:0.5rem 0.75rem;">
                    Masuk sebagai <strong><?= strtoupper($role) ?></strong>
                </div>
                <div class="dropdown-divider" style="margin:0.25rem 0;border-color:#f1f5f9;"></div>
                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Keluar
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