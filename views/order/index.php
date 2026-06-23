<?php $user = $session_user; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-file-invoice mr-2"></i>
        <?= $user['role'] === 'sales' ? 'Order Saya' : 'Semua Sales Order' ?>
    </h1>
    <?php if (in_array($user['role'], array('admin', 'sales'))) : ?>
    <a href="<?= base_url('order/create') ?>" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Buat Order Baru
    </a>
    <?php endif; ?>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Sales Order</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered datatable" width="100%">
                <thead>
                    <tr class="text-center">
                        <th>No. Order</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <?php if ($user['role'] !== 'sales') : ?><th>Sales</th><?php endif; ?>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $o) : ?>
                <tr>
                    <td><?= htmlspecialchars($o->no_order) ?></td>
                    <td class="text-center"><?= date('d/m/Y H:i', strtotime($o->created_at)) ?></td>
                    <td><?= htmlspecialchars($o->nama_customer) ?></td>
                    <?php if ($user['role'] !== 'sales') : ?>
                    <td><?= htmlspecialchars($o->nama_sales) ?></td>
                    <?php endif; ?>
                    <td class="text-right">Rp <?= number_format($o->total, 0, ',', '.') ?></td>
                    <td class="text-center">
                        <span class="badge badge-pill badge-<?= $o->status ?>">
                            <?= ucfirst($o->status) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="<?= base_url('order/detail/' . $o->id) ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        <?php if ($user['role'] === 'admin') : ?>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete(<?= $o->id ?>, '<?= addslashes($o->no_order) ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i> Hapus Order</h5>
                <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus order <strong id="orderNo"></strong>?
                <br><small class="text-danger">Stok produk akan dikembalikan secara otomatis.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="deleteLink" href="#" class="btn btn-danger">Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, no) {
    document.getElementById('orderNo').textContent = no;
    document.getElementById('deleteLink').href = '<?= base_url('order/delete/') ?>' + id;
    $('#deleteModal').modal('show');
}
</script>