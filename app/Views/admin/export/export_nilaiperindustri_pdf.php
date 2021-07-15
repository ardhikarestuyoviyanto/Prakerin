<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Laporan Nilai</h3>
<h3 class="text-center text-bold">Industri <?= $modell->getNamaIndustriByIdIndustri($_GET['industri']); ?></h3>
<br><br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Kelas</th>
            <th scope="col">Total Laporan</th>
            <th scope="col">Approval Laporan</th>
            <th scope="col">Unapproval Laporan</th>
            <th scope="col">Rata - rata Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($siswa as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nis; ?></td>
            <td><?= $x->nama_siswa; ?></td>
            <td><?= $x->nama_kelas; ?></td>
            <td><?= count($modell->getJurnalByIdSiswa($x->id_siswa)->getResult()); ?></td>
            <td><?= $modell->getTotalStatusJurnalApproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
            <td><?= $modell->getTotalStatusJurnalUnapproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
            <td><?= number_format($modell->getRataRataNilai($modell->getIdPenempatanByidSiswa($x->id_siswa)), 1); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
