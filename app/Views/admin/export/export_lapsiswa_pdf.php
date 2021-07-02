<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Kelas <?php if(isset($_GET['kelas'])){ echo $modell->getNamaKelas($_GET['kelas']); } ?></h3>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jurusan</th>

        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($data as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nis; ?></td>
            <td><?= $x->nama_siswa; ?></td>
            <td><?= $x->jenis_kelamin; ?></td>
            <td><?= $x->nama_kelas; ?></td>
            <td><?= $x->nama_jurusan; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
