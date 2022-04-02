<!-- jQuery -->
<script src="<?= base_url() ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- Sweet Alert2 -->
<script src="<?= base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<!-- Main Script -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<!-- Content Here (from Controllers) -->
<?php if (isset($script)) : ?>
  <?php foreach ($script as $value) : ?>
    <script src="<?= base_url($value) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>
</body>

</html>