<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-bar mr-2"></i> Laporan Per Sales</h1>
    <div>
        <a href="<?= base_url('report/byProduct') ?>" class="btn btn-secondary btn-sm mr-1">Per Produk</a>
        <a href="<?= base_url('report/byPeriod') ?>" class="btn btn-secondary btn-sm mr-1">Per Periode</a>
        <a href="<?= current_url() . '?' . http_build_query(array('date_from' => $date_from, 'date_to' => $date_to, 'user_id' => $user_id)) . '&export=pdf' ?>"
           class="btn btn-danger btn-sm"
           onclick="this.href='<?= base_url('report/exportPdf') ?>?date_from=<?= $date_from ?>&date_to=<?= $date_to ?>&user_id=<?= $user_id ?>'">
            <i class="fas fa-file-pdf mr-1"></i> Export PDF
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-filter mr-1"></i> Filter Laporan</h6>
    </div>
    <div class="card-body">
        <form method="get" action="<?= base_url('report') ?>" class="form-inline">
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Dari:</label>
                <input type="date" class="form-control" name="date_from" value="<?= $date_from ?>">
            </div>
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Sampai:</label>
                <input type="date" class="form-control" name="date_to" value="<?= $date_to ?>">
            </div>
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Sales:</label>
                <select class="form-control" name="user_id">
                    <option value="">-- Semua Sales --</option>
                    <?php foreach ($sales_list as $s) : ?>
                    <option value="<?= $s->id ?>" <?= $user_id == $s->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s->nama) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">
                <i class="fas fa-search mr-1"></i> Tampilkan
            </button>
        </form>
    </div>
</div>

<!-- Hasil -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Hasil Laporan: <?= $date_from ?> s/d <?= $date_to ?>
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
                        <th>Nama Sales</th>
                        <th>Jumlah Order</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; $grand = 0; foreach ($report as $r) : $grand += $r->total_penjualan; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($r->nama_sales) ?></td>
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