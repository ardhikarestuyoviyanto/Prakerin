<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<hr>
<h3 class="text-center text-bold">Laporan Nilai Prakerin</h3><br>
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
		<td>Industri</td>
		<td>:</td>
		<td> <?php if(empty($modell->getNamaIndustriByIdSiswa($x->id_siswa))){echo "BELUM DITEMPATKAN";}{ ?> <?= $modell->getNamaIndustriByIdSiswa($x->id_siswa); ?> <?php } ?></td>
	</tr>
</tbody>
</table>
<?php endforeach; ?>
<hr>
<br>
<h5 class="mb-4 text-bold">A. Nilai Pelaksanaan dan Ketrampilan</h5>
<table class="table table-bordered table-striped">
    <tr>
        <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
        <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;">Aspek Yang Dinilai</th>
        <th scope="col" colspan="2" style="text-align: center; vertical-align: middle;">Daftar Nilai</th>
    </tr>

    <tr>
        <th scope="col" style="text-align: center; vertical-align: middle;">Nilai Angka</th>
        <th scope="col" style="text-align: center; vertical-align: middle;">Keterangan</th>
    </tr>
    <?php $i=1; $total_nilai = 0; foreach($data_aspek as $x): ?>
    <tr>
        <td  style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
        <td><?= $x->nama_aspek; ?></td>
        <td  style="text-align: center; vertical-align: middle;"><?= $modell->getDetailNilaiAngkaByidSiswa($id_siswa, $x->id_aspek); ?></td>
        <td  style="text-align: center; vertical-align: middle;"><?= ucfirst($modell->getDetailNilaiHurufByidSiswa($id_siswa, $x->id_aspek)); ?></td>
    </tr>
    <?php $total_nilai = $total_nilai + $modell->getDetailNilaiAngkaByidSiswa($id_siswa, $x->id_aspek);  endforeach; ?>
    <tr class="text-bold">
        <td colspan="2"  style="text-align: right; vertical-align: middle;">
            Rata - rata
        </td>
        <td style="text-align: center; vertical-align: middle;">
            <?php if(!empty($data_aspek)): ?>
            <?= number_format($total_nilai/count($data_aspek), 1) ?>
            <?php endif; ?>
        </td>
        <td></td>
    </tr>
</table>
<br>
<h5 class="mb-4 text-bold">B. Keterangan</h5>
<table>

    <tr>
        <td scope="col" style=" width:100px;">0 - 59</td>
        <td scope="col" style=" width:0px;">Kurang</td>
    </tr>
    <tr>
        <td scope="col" style=" width:100px;">60 - 74</td>
        <td scope="col" style=" width:0px;">Cukup</td>
    </tr>
    <tr>
        <td scope="col" style=" width:100px;">75 - 89</td>
        <td scope="col" style=" width:0px;">Baik</td>
    </tr>
    <tr>
        <td scope="col" style=" width:100px;">90 - 100</td>
        <td scope="col" style=" width:0px;">Baik Sekali</td>
    </tr>

</table>

<br><br>
<?= $this->endSection('content'); ?>
