<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Laporan Penempatan</h3>
<h3 class="text-center text-bold">Kelas <?= $modell->getNamaKelas($_GET['kelas']); ?></h3>
<table class="table table-bordered mt-2 table-hover penempatan">
<thead>
    <tr>
        <th scope="col" width="10">No</th>
        <th scope="col">NIS</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Industri</th>
        <th scope="col">Jalur Penempatan</th>
        <th scope="col">Status Penempatan</th>
    </tr>
</thead>
<tbody>
    <?php $i=1; foreach($data as $x): ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $x->nis; ?></td>
        <td><?= $x->nama_siswa; ?></td>
        <td><?= $x->nama_industri; ?></td>
        <td>
            <?php if($x->surat == "kosong"){ ?>
                MANUAL
            <?php }else{ ?>
                PERMOHONAN
            <?php } ?>
        </td>
        <td><?= ucfirst($x->status); ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>

<br><br><br>
<?= $this->endSection('content'); ?>
