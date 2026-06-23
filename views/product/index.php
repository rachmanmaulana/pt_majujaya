<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-box mr-2"></i> Data Produk</h1>
    <a href="<?= base_url('product/create') ?>" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Produk
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable" width="100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($products as $p) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($p->kode_produk) ?></td>
                    <td><?= htmlspecialchars($p->nama_produk) ?></td>
                    <td class="text-right">Rp <?= number_format($p->harga, 0, ',', '.') ?></td>
                    <td class="text-center">
                        <span class="badge badge-<?= $p->stok > 10 ? 'success' : ($p->stok > 0 ? 'warning' : 'danger') ?>">
                            <?= $p->stok ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= base_url('product/edit/' . $p->id) ?>"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete(<?= $p->id ?>, '<?= addslashes($p->nama_produk) ?>')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i> Hapus Produk</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus produk <strong id="productName"></strong>?
                <br><small class="text-danger">Tindakan ini tidak dapat dibatalkan.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="deleteLink" href="#" class="btn btn-danger">Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('productName').textContent = name;
    document.getElementById('deleteLink').href = '<?= base_url('product/delete/') ?>' + id;
    $('#deleteModal').modal('show');
}
</script>