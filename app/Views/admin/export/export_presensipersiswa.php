<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Rekap Absensi</h3><br>
<?php foreach ($data_siswa as $x): ?>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">NIS</td>
		<td width="10px">:</td>
		<td><?= $x->nis; ?></td>
	</tr>
    <tr>
		<td>Nama Siswa</td>
		<td>:</td>
		<td><?= $x->nama_siswa; ?></td>
	</tr>
	<tr>
		<td>Nama Kelas / Jurusan</td>
		<td>:</td>
		<td><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></td>
	</tr>
    <tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?= date('d M Y', strtotime($_GET['start']))." s.d ".date('d M Y', strtotime($_GET['finish'])); ?></td>
	</tr>
</tbody>
</table>
<?php endforeach; ?>
<hr>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Hadir</th>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Alfa</th>
        </tr>
    </thead>
    <tbody>
        <?php $j=1; foreach($modell->getAbsensiPerSiswaRekap($_GET['id_penempatan'], $_GET['start'], $_GET['finish'])->getResult() as $x): ?>
            <tr>
                <td><?= $j++; ?></td>
                <td scope="row"><?= date('d-M-Y', strtotime($x->tgl)); ?></td>
                <td>
                    <?php if($x->status == "hadir"){ ?>
                    <i class="fas fa-check"></i>
                    <?php } ?>
                </td>
                <td>
                    <?php if($x->status == "sakit"){ ?>
                    <i class="fas fa-check"></i>
                    <?php } ?>
                </td>
                <td>
                    <?php if($x->status == "ijin"){ ?>
                    <i class="fas fa-check"></i>
                    <?php } ?>
                </td>
                <td>
                    <?php if($x->status == "alfa"){ ?>
                    <i class="fas fa-check"></i>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
