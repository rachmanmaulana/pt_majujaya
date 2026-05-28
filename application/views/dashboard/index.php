<?php $user = $session_user; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
    </h1>
    <span class="text-gray-500">Selamat datang, <strong><?= htmlspecialchars($user['nama']) ?></strong></span>
</div>

<!-- Content Row (Stats Cards) -->
<div class="row">

    <?php if (in_array($user['role'], array('admin', 'manager'))) : ?>
    <!-- Total Produk -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_products ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-box fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pelanggan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_customers ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Revenue (Selesai)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp <?= number_format($total_revenue, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-money-bill-wave fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Total Order -->
    <div class="col-xl-<?= in_array($user['role'], array('admin','manager')) ? '3' : '4' ?> col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <?= $user['role'] === 'sales' ? 'Order Saya' : 'Total Order' ?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_orders ?></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-file-invoice fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Stats Cards -->

<!-- Content Row (Table + Status) -->
<div class="row">

    <!-- Recent Orders Table -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-history mr-1"></i>
                    Order Terbaru
                </h6>
                <a href="<?= base_url('order') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Pelanggan</th>
                                <?php if ($user['role'] !== 'sales') : ?><th>Sales</th><?php endif; ?>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($recent_orders)) : ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada order.</td></tr>
                        <?php else : ?>
                            <?php foreach ($recent_orders as $o) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('order/detail/' . $o->id) ?>">
                                        <?= $o->no_order ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($o->nama_customer) ?></td>
                                <?php if ($user['role'] !== 'sales') : ?>
                                <td><?= htmlspecialchars($o->nama_sales) ?></td>
                                <?php endif; ?>
                                <td>Rp <?= number_format($o->total, 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge badge-pill badge-<?= $o->status ?>">
                                        <?= ucfirst($o->status) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Breakdown -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie mr-1"></i> Status Order
                </h6>
            </div>
            <div class="card-body">
                <?php
                $status_map = array(
                    'draft'      => array('label' => 'Draft',      'color' => 'secondary'),
                    'dikirim'    => array('label' => 'Dikirim',    'color' => 'info'),
                    'selesai'    => array('label' => 'Selesai',    'color' => 'success'),
                    'dibatalkan' => array('label' => 'Dibatalkan', 'color' => 'danger'),
                );
                $counts = array();
                foreach ($status_counts as $sc) {
                    $counts[$sc->status] = $sc->jumlah;
                }
                foreach ($status_map as $key => $info) :
                    $jumlah = isset($counts[$key]) ? $counts[$key] : 0;
                    $pct    = $total_orders > 0 ? round(($jumlah / $total_orders) * 100) : 0;
                ?>
                <h4 class="small font-weight-bold">
                    <?= $info['label'] ?>
                    <span class="float-right"><?= $jumlah ?></span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-<?= $info['color'] ?>" role="progressbar"
                         style="width: <?= $pct ?>%" aria-valuenow="<?= $pct ?>"
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>