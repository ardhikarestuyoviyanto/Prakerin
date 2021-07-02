<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jurusan</th>

        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($data as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nis; ?></td>
            <td><?= $x->nama_siswa; ?></td>
            <td><?= $x->jenis_kelamin; ?></td>
            <td><?= $x->nama_kelas; ?></td>
            <td><?= $x->nama_jurusan; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
