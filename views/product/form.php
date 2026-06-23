<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-<?= isset($product) ? 'edit' : 'plus-circle' ?> mr-2"></i>
        <?= isset($product) ? 'Edit Produk' : 'Tambah Produk' ?>
    </h1>
    <a href="<?= base_url('product') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?= isset($product) ? 'Form Edit Produk' : 'Form Tambah Produk' ?>
                </h6>
            </div>
            <div class="card-body">
                <?php
                $action = isset($product)
                    ? base_url('product/update/' . $product->id)
                    : base_url('product/store');
                ?>
                <form action="<?= $action ?>" method="post">

                    <div class="form-group">
                        <label for="kode_produk">Kode Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                               maxlength="20" placeholder="contoh: PRD-009"
                               value="<?= isset($product) ? htmlspecialchars($product->kode_produk) : set_value('kode_produk') ?>"
                               <?= isset($product) ? 'readonly' : 'required' ?>>
                        <?php if (isset($product)) : ?>
                        <small class="form-text text-muted">Kode produk tidak dapat diubah.</small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nama_produk">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                               maxlength="150" placeholder="Nama lengkap produk" required
                               value="<?= isset($product) ? htmlspecialchars($product->nama_produk) : set_value('nama_produk') ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="harga">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                   min="0" step="1000" placeholder="0" required
                                   value="<?= isset($product) ? $product->harga : set_value('harga') ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="stok">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                   min="0" placeholder="0" required
                                   value="<?= isset($product) ? $product->stok : set_value('stok') ?>">
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('product') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            <?= isset($product) ? 'Simpan Perubahan' : 'Simpan Produk' ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>