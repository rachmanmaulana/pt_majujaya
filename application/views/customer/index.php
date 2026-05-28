<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users mr-2"></i> Data Pelanggan</h1>
    <a href="<?= base_url('customer/create') ?>" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Pelanggan
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable" width="100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($customers as $c) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($c->nama) ?></td>
                    <td><?= htmlspecialchars($c->alamat) ?></td>
                    <td><?= htmlspecialchars($c->telepon) ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('customer/edit/' . $c->id) ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete(<?= $c->id ?>, '<?= addslashes($c->nama) ?>')">
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
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i> Hapus Pelanggan</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus pelanggan <strong id="customerName"></strong>?
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
    document.getElementById('customerName').textContent = name;
    document.getElementById('deleteLink').href = '<?= base_url('customer/delete/') ?>' + id;
    $('#deleteModal').modal('show');
}
</script>