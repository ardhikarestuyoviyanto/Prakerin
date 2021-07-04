<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<table width="100%">
	<tbody>
    <tr>
		<td width="200px">No</td>
		<td width="10px">:</td>
		<td></td>
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
<hr>


<br><br>
<?= $this->endSection('content'); ?>
