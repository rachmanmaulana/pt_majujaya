<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-<?= isset($customer) ? 'edit' : 'user-plus' ?> mr-2"></i>
        <?= isset($customer) ? 'Edit Pelanggan' : 'Tambah Pelanggan' ?>
    </h1>
    <a href="<?= base_url('customer') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?= isset($customer) ? 'Form Edit Pelanggan' : 'Form Tambah Pelanggan' ?>
                </h6>
            </div>
            <div class="card-body">
                <?php
                $action = isset($customer)
                    ? base_url('customer/update/' . $customer->id)
                    : base_url('customer/store');
                ?>
                <form action="<?= $action ?>" method="post">

                    <div class="form-group">
                        <label for="nama">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" required
                               maxlength="150" placeholder="Nama lengkap pelanggan"
                               value="<?= isset($customer) ? htmlspecialchars($customer->nama) : set_value('nama') ?>">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                  placeholder="Alamat lengkap"><?= isset($customer) ? htmlspecialchars($customer->alamat) : set_value('alamat') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon"
                               maxlength="20" placeholder="contoh: 021-5551234"
                               value="<?= isset($customer) ? htmlspecialchars($customer->telepon) : set_value('telepon') ?>">
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('customer') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            <?= isset($customer) ? 'Simpan Perubahan' : 'Simpan Pelanggan' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>