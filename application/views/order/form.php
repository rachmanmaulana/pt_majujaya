<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2"></i> Buat Sales Order</h1>
    <a href="<?= base_url('order') ?>" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>

<form action="<?= base_url('order/store') ?>" method="post" id="orderForm">
<div class="row">

    <!-- Left: Header Order -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> Info Order</h6>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="customer_id">Pelanggan <span class="text-danger">*</span></label>
                    <select class="form-control" id="customer_id" name="customer_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach ($customers as $c) : ?>
                        <option value="<?= $c->id ?>"><?= htmlspecialchars($c->nama) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"
                              placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div class="card bg-light">
                    <div class="card-body py-3">
                        <h6 class="font-weight-bold">Total Order:</h6>
                        <h4 class="text-primary font-weight-bold mb-0" id="grandTotal">Rp 0</h4>
                    </div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block btn-lg shadow">
            <i class="fas fa-save mr-2"></i> Simpan Order
        </button>
    </div>

    <!-- Right: Item Order -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list mr-1"></i> Item Produk</h6>
                <button type="button" class="btn btn-primary btn-sm" id="addRow">
                    <i class="fas fa-plus mr-1"></i> Tambah Produk
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="itemTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Produk</th>
                                <th style="width:90px;">Qty</th>
                                <th style="width:150px;">Harga</th>
                                <th style="width:150px;">Subtotal</th>
                                <th style="width:50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="itemBody">
                            <!-- Baris dinamis -->
                        </tbody>
                    </table>
                </div>
                <p class="text-muted small" id="emptyMsg">
                    <i class="fas fa-info-circle mr-1"></i> Klik "Tambah Produk" untuk mulai memilih produk.
                </p>
            </div>
        </div>
    </div>

</div>
</form>

<script>
// Debug: cek apakah data produk ada
console.log('Data products:', <?= json_encode($products) ?>);

$(document).ready(function() {
    var rowIndex = 0;
    var products = <?= json_encode($products) ?>;
    
    // Cek apakah products kosong
    if (!products || products.length === 0) {
        console.error('Data produk kosong!');
        $('#emptyMsg').html('<i class="fas fa-exclamation-triangle mr-1"></i> Data produk tidak ditemukan. Silakan tambahkan produk terlebih dahulu.');
        $('#addRow').prop('disabled', true);
        return;
    }
    
    function formatRupiah(num) {
        if (isNaN(num) || num === null) num = 0;
        return 'Rp ' + parseInt(num).toLocaleString('id-ID');
    }
    
    function buildProductOptions(selectedId) {
        var opts = '<option value="">-- Pilih Produk --</option>';
        for (var i = 0; i < products.length; i++) {
            var p = products[i];
            var sel = (p.id == selectedId) ? ' selected' : '';
            opts += '<option value="' + p.id + '" data-harga="' + p.harga + '" data-stok="' + p.stok + '"' + sel + '>'
                  + p.kode_produk + ' - ' + p.nama_produk + ' (Stok: ' + p.stok + ')'
                  + '</option>';
        }
        return opts;
    }
    
    function recalcRow(i) {
        var row = $('#row_' + i);
        var selectedOption = row.find('.product-select').find(':selected');
        var harga = parseFloat(selectedOption.data('harga') || 0);
        var qty = parseInt(row.find('.qty-input').val() || 1);
        
        if (isNaN(qty) || qty < 1) {
            qty = 1;
            row.find('.qty-input').val(1);
        }
        
        var sub = harga * qty;
        row.find('.harga-display').val(formatRupiah(harga));
        row.find('.subtotal-display').val(formatRupiah(sub));
        recalcTotal();
    }
    
    function recalcTotal() {
        var total = 0;
        $('#itemBody tr').each(function() {
            var selectedOption = $(this).find('.product-select').find(':selected');
            var harga = parseFloat(selectedOption.data('harga') || 0);
            var qty = parseInt($(this).find('.qty-input').val() || 0);
            if (!isNaN(harga) && !isNaN(qty)) {
                total += harga * qty;
            }
        });
        $('#grandTotal').text(formatRupiah(total));
    }
    
    function removeRow(i) {
        $('#row_' + i).remove();
        recalcTotal();
        if ($('#itemBody tr').length === 0) {
            $('#emptyMsg').show();
        }
    }
    
    window.onProductChange = function(sel, i) {
        recalcRow(i);
    };
    
    window.removeRow = function(i) {
        removeRow(i);
    };
    
    function addRow() {
        var i = rowIndex++;
        var row = '<tr id="row_' + i + '">'
            + '<td>'
            + '<select class="form-control form-control-sm product-select" name="product_id[]" required'
            + ' onchange="onProductChange(this, ' + i + ')">'
            + buildProductOptions(null)
            + '</select>'
            + '</td>'
            + '<td>'
            + '<input type="number" class="form-control form-control-sm qty-input" name="qty[]"'
            + ' min="1" value="1" required oninput="onProductChange(this, ' + i + ')">'
            + '</td>'
            + '<td><input type="text" class="form-control form-control-sm harga-display" readonly value="Rp 0"></td>'
            + '<td><input type="text" class="form-control form-control-sm subtotal-display" readonly value="Rp 0"></td>'
            + '<td class="text-center">'
            + '<button type="button" class="btn btn-danger btn-sm" onclick="removeRow(' + i + ')">'
            + '<i class="fas fa-times"></i>'
            + '</button>'
            + '</td>'
            + '</tr>';
        $('#itemBody').append(row);
        $('#emptyMsg').hide();
    }
    
    // Event handler untuk tombol tambah
    $('#addRow').on('click', function() { 
        addRow(); 
    });
    
    // Validasi minimal 1 produk sebelum submit
    $('#orderForm').on('submit', function(e) {
        if ($('#itemBody tr').length === 0) {
            e.preventDefault();
            alert('Minimal 1 produk harus ditambahkan!');
            return false;
        }
        
        // Validasi semua produk sudah dipilih
        var allSelected = true;
        $('#itemBody .product-select').each(function() {
            if (!$(this).val()) {
                allSelected = false;
                return false;
            }
        });
        
        if (!allSelected) {
            e.preventDefault();
            alert('Semua produk harus dipilih!');
            return false;
        }
        
        return true;
    });
    
    // Auto tambah satu baris saat halaman dimuat
    addRow();
});
</script>