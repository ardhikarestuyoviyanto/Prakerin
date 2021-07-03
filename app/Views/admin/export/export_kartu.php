<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Kartu Penempatan</h3><br>
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
		<td>Nama Kelas</td>
		<td>:</td>
		<td><?= $x->nama_kelas; ?></td>
	</tr>
    <tr>
		<td>Jurusan</td>
		<td>:</td>
		<td><?= $x->nama_jurusan; ?></td>
	</tr>
</tbody>
</table>
<?php endforeach; ?>
<hr>
<br>
<table class="table table-bordered table-striped" id="DataSiswa">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Industri</th>
            <th scope="col">Bidang Kerja</th>
            <th scope="col">Tgl Daftar</th>
            <th scope="col">Jalur Pendaftaran</th>
            <th scope="col">Status Penempatan</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nama_industri; ?></td>
            <td><?= $x->bidang_kerja; ?></td>
            <td><?= $x->tgl_request; ?></td>
            <td>
                <?php if($x->surat == "kosong"){ ?>
                    Jalur Manual
                <?php }else{ ?>
                    Jalur Permohonan
                <?php } ?>
            </td>
            <td><?= ucfirst($x->status); ?></td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br><br>
<?= $this->endSection('content'); ?>
