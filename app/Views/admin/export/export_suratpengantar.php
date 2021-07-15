<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>

<?php foreach($data_industri as $x): ?>
<?php $no_surat = $x->id_industri.'/105.0.1/SMK-TP/MN/'.date('Y'); ?>
<?php endforeach; ?>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">No</td>
		<td width="10px">:</td>
		<td><?= $no_surat; ?></td>
	</tr>
	<tr>
		<td>Lamp</td>
		<td>:</td>
		<td>1 Berkas</td>
	</tr>
    <tr>
		<td>Hal</td>
		<td>:</td>
		<td><b><u>Permohonan Praktek Kerja Industri</u></b></td>
	</tr>
</tbody>
</table>

<br>

<table width="100%">
	<tbody>
	<?php foreach($data_industri as $x): ?>
    <tr>
		<td width="200px">Kepada Yth</td>
		<td width="10px">:</td>
		<td class="text-bold">Bapak Pimpinan, <?= $x->nama_industri; ?></td>
	</tr>
	<tr>
		<td width="200px"></td>
		<td width="10px"></td>
		<td class="text-bold">Di - Tempat</td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>

<?php foreach($surat as $x): ?>
<p>
	<?= $x->badansurat; ?>
</p>

<table width="90%" class="center">
	<tbody>

		<td align="right"></td>
		<td align="right">
			Binjani, <?= date("d F Y", strtotime(date('Y-m-d')));  ?>	
			<br>Kepala Sekolah,<br><br><br><br>
			<b><u><?= $x->kepala_sekolah; ?> </u><br>-</b>
		</td>
	</tbody>
</table>
<?php endforeach; ?>

<p>Tembusan</p>
<p>1. Ketua Yayasan Pendidikan Tunas Pelita</p>
<p>2. Dinas Pendidikan Kota Binjai</p>

<p style="page-break-before: always">
	<p class="text-bold"><i>Lampiran No <?= $no_surat; ?></i></p>
	<br><br>
	<?php foreach($surat as $x):?>
	<h5 class="text-center">DAFTAR NAMA - NAMA SISWA</h5>
	<h5 class="text-center"><?= $x->nama_instansi; ?></h5>
	<?php endforeach; ?>
	<br><br>
	<table class="table table-bordered table-striped" id="DataSiswa">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">NIS</th>
				<th scope="col">Nama Siswa</th>
				<th scope="col">Jurusan</th>
				<th scope="col">Kelas</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; foreach($data as $x): ?>
			<tr>
				<td><?= $i++; ?></td>
				<td><?= $x->nis; ?></td>
				<td><?= $x->nama_siswa; ?></td>
				<td><?= $x->nama_jurusan; ?></td>
				<td><?= $x->nama_kelas; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
</table>

</p>

<br><br>
<?= $this->endSection('content'); ?>
