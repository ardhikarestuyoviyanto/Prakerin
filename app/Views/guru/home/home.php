<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card card-info">
    <div class="card-header" id="ucapan">
    </div>

    <div class="card-footer">
        <div class="alert alert-light" role="alert">
            Ini adalah halaman Dashboard yang digunakan untuk mengelola Data Prakerin, Silahkan digunakan dengan baik dan sampaikan jika ada keluhan dalam masalah penggunaan aplikasi. Terima kasih atas kepercayaan anda!
        </div>
    </div>
    </div>
    </div>
</section>
</div>
<script type="text/javascript">
  var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
  var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var tanggal = new Date().getDate();
  var _hari = new Date().getDay();
  var _bulan = new Date().getMonth();
  var _tahun = new Date().getYear();

  var hari = hari[_hari];
  var bulan = bulan[_bulan];
  var tahun = (_tahun  < 1000) ? _tahun + 1900 : _tahun;

  var waktu = new Date();
  var sh = waktu.getHours() + "";
  var sm = waktu.getMinutes() + "";
  var ss = waktu.getSeconds() + "";

  //<![CDATA[
  var h=(new Date()).getHours();
  var m=(new Date()).getMinutes();
  var s=(new Date()).getSeconds();
  if (h >= 4 && h < 10) document.getElementById("ucapan").innerHTML = "Selamat pagi , <?php if(isset($_SESSION['nama'])):echo $_SESSION['nama']; endif; ?> || "+hari+", "+tanggal+" "+bulan+" "+tahun+" || "+(sh.length==1?"0"+sh:sh) + ":"+ (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
  if (h >= 10 && h < 15) document.getElementById("ucapan").innerHTML = "Selamat siang , <?php if(isset($_SESSION['nama'])):echo $_SESSION['nama']; endif; ?> || "+hari+", "+tanggal+" "+bulan+" "+tahun+" || "+(sh.length==1?"0"+sh:sh) + ":"+ (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
  if (h >= 15 && h < 18) document.getElementById("ucapan").innerHTML = "Selamat sore , <?php if(isset($_SESSION['nama'])):echo $_SESSION['nama']; endif; ?> || "+hari+", "+tanggal+" "+bulan+" "+tahun+" || "+(sh.length==1?"0"+sh:sh) + ":"+ (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
  if (h >= 18 || h < 4)document.getElementById("ucapan").innerHTML = "Selamat malam , <?php if(isset($_SESSION['nama'])):echo $_SESSION['nama']; endif; ?> || "+hari+", "+tanggal+" "+bulan+" "+tahun+" || "+(sh.length==1?"0"+sh:sh) + ":"+ (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
  //]]>
  </script>
<?= $this->endSection('content'); ?>