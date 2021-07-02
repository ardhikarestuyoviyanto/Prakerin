<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>

<hr>
<h3 class="text-center text-bold">Data Guru Pembimbing</h3>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Pembimbing</th>
            <th scope="col">Membimbing Jurusan</th>
            <th scope="col">Membimbing Industri</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($pembimbing as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nip; ?></td>
            <td><?= $x->nama_pembimbing; ?></td>
            <td><?= $x->nama_jurusan; ?></td>
            <td><?= $x->nama_industri; ?></td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
