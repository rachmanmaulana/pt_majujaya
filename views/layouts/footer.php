</div>
<!-- End of Main Content -->

</div>
<!-- End of Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>PT Maju Jaya &copy; <?= date('Y') ?> — Sales Order System</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold">Konfirmasi Keluar</h6>
                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-size:0.875rem;">
                Apakah Anda yakin ingin keluar dari sistem?
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-light" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-sm btn-danger" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript (local) -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript (local) -->
<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script>
$(document).ready(function () {
    if ($('.datatable').length) {
        $('.datatable').DataTable({
            language: { url: '' },
            responsive: true,
            dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        });
    }
});
</script>

</body>
</html>