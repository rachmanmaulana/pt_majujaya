<?php $user = $session_user; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-file-invoice mr-2"></i> Detail Order: <?= $order->no_order ?>
    </h1>
    <a href="<?= base_url('order') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="row">
    <!-- Order Info -->
    <div class="col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Order</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <th style="width:140px;">No. Order</th>
                        <td><?= htmlspecialchars($order->no_order) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></td>
                    </tr>
                    <tr>
                        <th>Sales</th>
                        <td><?= htmlspecialchars($order->nama_sales) ?></td>
                    </tr>
                    <tr>
                        <th>Pelanggan</th>
                        <td><?= htmlspecialchars($order->nama_customer) ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= htmlspecialchars($order->alamat) ?></td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td><?= htmlspecialchars($order->telepon) ?></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td><?= $order->catatan ? htmlspecialchars($order->catatan) : '<em class="text-muted">-</em>' ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-pill badge-<?= $order->status ?> p-2">
                                <?= ucfirst($order->status) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><strong class="text-primary h5">Rp <?= number_format($order->total, 0, ',', '.') ?></strong></td>
                    </tr>
                </table>

                <!-- Update Status (admin only) -->
                <?php if ($user['role'] === 'admin') : ?>
                <hr>
                <h6 class="font-weight-bold text-primary">Ubah Status Order</h6>
                <form action="<?= base_url('order/updateStatus/' . $order->id) ?>" method="post">
                    <div class="input-group">
                        <select class="form-control" name="status">
                            <?php foreach (array('draft','dikirim','selesai','dibatalkan') as $s) : ?>
                            <option value="<?= $s ?>" <?= $order->status === $s ? 'selected' : '' ?>>
                                <?= ucfirst($s) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Order Detail Items -->
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Item Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $grand = 0; foreach ($details as $d) : $grand += $d->subtotal; ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d->kode_produk) ?></td>
                            <td><?= htmlspecialchars($d->nama_produk) ?></td>
                            <td class="text-center"><?= $d->qty ?></td>
                            <td class="text-right">Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                            <td class="text-right">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-primary font-weight-bold">
                                <td colspan="5" class="text-right">TOTAL</td>
                                <td class="text-right">Rp <?= number_format($grand, 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>