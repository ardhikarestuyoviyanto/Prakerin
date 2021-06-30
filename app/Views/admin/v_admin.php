<!DOCTYPE html>
<html lang="en">
<?= $this->include('partisi/head'); ?>
<?= $this->include('partisi/js'); ?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<?= $this->include('partisi/navbar'); ?>

<?= $this->include('partisi/a_sidebar'); ?>

<?= $this->renderSection('content'); ?>

<?= $this->include('partisi/footer'); ?>
</div>

</body>
</html>
