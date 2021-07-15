<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Nilai.xls");
?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<h3 class="text-center text-bold">Laporan Nilai Kelas  <?= $modell->getNamaKelas($_GET['kelas']); ?></h3>

<table border="1">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Industri</th>
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
            <td><?= $modell->getNamaIndustriByIdSiswa($x->id_siswa); ?></td>
            <td><?= count($modell->getJurnalByIdSiswa($x->id_siswa)->getResult()); ?></td>
            <td><?= $modell->getTotalStatusJurnalApproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
            <td><?= $modell->getTotalStatusJurnalUnapproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
            <td><?= number_format($modell->getRataRataNilai($modell->getIdPenempatanByidSiswa($x->id_siswa)), 1); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
