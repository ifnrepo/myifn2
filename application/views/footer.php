</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; www.indoneptune.com <?= date('Y') ?></span>
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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content font-kecil text-black">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">System</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin akan keluar dari aplikasi .?</div>
            <div class="modal-footer font-kecil">
                <button class="btn btn-secondary font-kecil flat" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-success font-kecil flat" href="<?= base_url() . 'login/logout' ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() . 'assets/plugins/jquery/jquery-3.3.1.js' ?>"></script>
<script src="<?= base_url() . 'assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() . 'assets/plugins/jquery-easing/jquery.easing.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/bootstrap/js/bootstrap.js' ?>"></script>

<!-- dataTablses -->
<script src="<?= base_url() . 'assets/vendor/datatables/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/datatables/js/dataTables.bootstrap4.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/datatables/js/dataTables.responsive.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/datatables/js/responsive.bootstrap.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/vendor/toast/jquery.toast.min.js' ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() . 'assets/js/sb-admin-2.js' ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() . 'assets/js/myscript.js' ?>"></script>
<?php if (isset($footer) && $footer == 'stokopname') { ?>
    <script src="<?= base_url() . 'assets/js/modul/stokopname.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/modul/opname.js' ?>"></script>
<?php } ?>
<?php if (isset($footer) && $footer == 'profile') { ?>
    <script src="<?= base_url() . 'assets/js/modul/profile.js' ?>"></script>
<?php } ?>
<?php if (isset($footer) && $footer == 'user') { ?>
    <script src="<?= base_url() . 'assets/js/modul/user.js' ?>"></script>
<?php } ?>
<?php if (isset($footer) && $footer == 'sublok') { ?>
    <script src="<?= base_url() . 'assets/js/modul/sublok.js' ?>"></script>
<?php } ?>
<?php if (isset($footer) && $footer == 'onmachine') { ?>
    <script src="<?= base_url() . 'assets/js/modul/onmachine.js' ?>"></script>
<?php } ?>
<?php if (isset($footer) && $footer == 'cari') { ?>
    <script src="<?= base_url() . 'assets/js/modul/cari.js' ?>"></script>
<?php } ?>

</body>

</html>