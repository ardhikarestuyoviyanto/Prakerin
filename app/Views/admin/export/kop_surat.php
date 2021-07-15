<!DOCTYPE html>
<html>
<head>
	<title><?= date("d F Y", strtotime(date('Y-m-d'))); ?>	</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/jqvmap/jqvmap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/summernote/summernote-bs4.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    <?= $this->include('partisi/js') ?>
    <style>
        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

    <?php foreach ($data_sekolah as $x): ?>
    <table width="100%">
        <td width="100px" align="left">
            <img src="<?= base_url('dist/img/'.$x->logo_kiri) ?>" alt="" height="60px">
        </td>
        <td align="top">
            <h3 align="center" style="margin-bottom:8px;"><?= $x->nama_instansi; ?></h3>
            <center><?= $x->alamat; ?></center>
        </td>
        <td width="100px" align="right">
            <img src="<?= base_url('dist/img/'.$x->logo_kanan) ?>" alt="" height="60px">
        </td>
    </table>

    <?= $this->renderSection('content'); ?>

    <table width="90%" class="center">
        <tbody>
            <?php if(isset($_GET['surat'])){}else{ ?>
            <td align="left"></td>
            <td align="left">
                Binjani, <?= date("d F Y", strtotime(date('Y-m-d')));  ?>	
                <br>Penerima,<br><br><br><br>
                <b><u> </u><br>-</b>
            </td>
            <?php } ?>

            <td align="right"></td>
            <td align="right">
                Binjani, <?= date("d F Y", strtotime(date('Y-m-d')));  ?>	
                <br>Kepala Sekolah,<br><br><br><br>
                <b><u><?= $x->kepala_sekolah; ?> </u><br>-</b>
            </td>
        </tbody>
    </table>

    <?php endforeach; ?>
	<script>
		window.print();
	</script>

</body>
</html>