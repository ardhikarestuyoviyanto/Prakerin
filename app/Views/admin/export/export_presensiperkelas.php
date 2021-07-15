<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Rekap Absensi</h3><br>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">Industri</td>
		<td width="10px">:</td>
		<td><?= $modell->getNamaIndustriByIdIndustri($_GET['industri']); ?></td>
	</tr>
    <tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?= date('d M Y', strtotime($_GET['start']))." s.d ".date('d M Y', strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>
<hr>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Kelas</th>
            <th scope="col">Hadir</th>
            <th scope="col">Sakit</th>
            <th scope="col">Izin</th>
            <th scope="col">Alfa</th>
            <th scope="col">Total Rekap</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($data as $x): ?>
        <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $x->nis; ?></td>
            <td><?= $x->nama_siswa; ?></td>
            <td><?= $modell->getNamaKelas($x->id_kelas); ?></td>
            <td class="text-bold"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "hadir", $_GET['start'], $_GET['finish']); ?></td>
            <td class="text-bold"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "sakit", $_GET['start'], $_GET['finish']); ?></td>
            <td class="text-bold"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "izin", $_GET['start'], $_GET['finish']); ?></td>
            <td class="text-bold"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "alfa", $_GET['start'], $_GET['finish']); ?></td>
            <td class="text-bold"><?= $modell->getTotalAbsensiByIdPenempatan($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
