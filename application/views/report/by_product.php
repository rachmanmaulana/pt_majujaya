<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-box mr-2"></i> Laporan Per Produk</h1>
    <div>
        <a href="<?= base_url('report') ?>" class="btn btn-secondary btn-sm mr-1">Per Sales</a>
        <a href="<?= base_url('report/byPeriod') ?>" class="btn btn-secondary btn-sm mr-1">Per Periode</a>
        <a href="<?= base_url('report/exportPdf') ?>?date_from=<?= $date_from ?>&date_to=<?= $date_to ?>"
           class="btn btn-danger btn-sm">
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
        <form method="get" action="<?= base_url('report/byProduct') ?>" class="form-inline">
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Dari:</label>
                <input type="date" class="form-control" name="date_from" value="<?= $date_from ?>">
            </div>
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Sampai:</label>
                <input type="date" class="form-control" name="date_to" value="<?= $date_to ?>">
            </div>
            <div class="form-group mr-3 mb-2">
                <label class="mr-2">Produk:</label>
                <select class="form-control" name="product_id">
                    <option value="">-- Semua Produk --</option>
                    <?php foreach ($product_list as $p) : ?>
                    <option value="<?= $p->id ?>" <?= $product_id == $p->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p->kode_produk) ?> - <?= htmlspecialchars($p->nama_produk) ?>
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
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Total Qty</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; $grand = 0; foreach ($report as $r) : $grand += $r->total_penjualan; ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($r->kode_produk) ?></td>
                    <td><?= htmlspecialchars($r->nama_produk) ?></td>
                    <td class="text-center"><?= number_format($r->total_qty, 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($r->total_penjualan, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-primary font-weight-bold">
                        <td colspan="4" class="text-right">TOTAL</td>
                        <td class="text-right">Rp <?= number_format($grand, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>