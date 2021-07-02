<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Laporan Penempatan</h3><br>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">Nama Industri</td>
		<td width="10px">:</td>
		<td><?= $modell->getNamaIndustriByNama($_GET['industri']); ?></td>
	</tr>
	<tr>
		<td>Nama Kelas</td>
		<td>:</td>
		<td><?= $modell->getNamaKelas($_GET['kelas']); ?></td>
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
            <th scope="col">Industri</th>
            <th scope="col">Jalur Penempatan</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nis; ?></td>
            <td><?= $x->nama_siswa; ?></td>
            <td><?= $x->nama_kelas; ?></td>
            <td><?= $x->nama_industri; ?></td>
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
