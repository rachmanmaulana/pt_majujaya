<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-calendar-alt mr-2"></i> Laporan Per Periode</h1>
    <div>
        <a href="<?= base_url('report') ?>" class="btn btn-secondary btn-sm mr-1">Per Sales</a>
        <a href="<?= base_url('report/byProduct') ?>" class="btn btn-secondary btn-sm mr-1">Per Produk</a>
        <a href="<?= base_url('report/exportPdf') ?>?date_from=<?= $date_from ?>&date_to=<?= $date_to ?>"
           class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf mr-1"></i> Export PDF
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter mr-1"></i> Filter Periode</h6>
    </div>
    <div class="card-body">
        <form method="get" action="<?= base_url('report/byPeriod') ?>" class="form-inline">
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Dari:</label>
                <input type="date" class="form-control" name="date_from" value="<?= $date_from ?>">
            </div>
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Sampai:</label>
                <input type="date" class="form-control" name="date_to" value="<?= $date_to ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">
                <i class="fas fa-search mr-1"></i> Tampilkan
            </button>
        </form>
    </div>
</div>

<!-- Chart -->
<?php if (!empty($report)) : ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan Harian</h6>
    </div>
    <div class="card-body">
        <canvas id="periodChart" height="100"></canvas>
    </div>
</div>
<?php endif; ?>

<!-- Tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Tabel Penjualan: <?= $date_from ?> s/d <?= $date_to ?>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($report)) : ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle mr-2"></i> Tidak ada data pada periode ini.
        </div>
        <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Order</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; $grand = 0; foreach ($report as $r) : $grand += $r->total_penjualan; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($r->tanggal)) ?></td>
                    <td class="text-center"><?= $r->jumlah_order ?></td>
                    <td class="text-right">Rp <?= number_format($r->total_penjualan, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-primary font-weight-bold">
                        <td colspan="3" class="text-right">TOTAL</td>
                        <td class="text-right">Rp <?= number_format($grand, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($report)) : ?>
<script src="<?= base_url('assets/vendor/chart.js/Chart.bundle.min.js') ?>"></script>
<script>
var labels  = <?= json_encode(array_map(function($r){ return date('d/m', strtotime($r->tanggal)); }, $report)) ?>;
var totals  = <?= json_encode(array_map(function($r){ return (float)$r->total_penjualan; }, $report)) ?>;

var ctx = document.getElementById('periodChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Penjualan (Rp)',
            data: totals,
            backgroundColor: 'rgba(78,115,223,0.5)',
            borderColor: 'rgba(78,115,223,1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{ ticks: { beginAtZero: true } }]
        }
    }
});
</script>
<?php endif; ?>