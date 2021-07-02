<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pembimbing.xls");
?>

<table border="1">
<thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Pembimbing</th>
            <th scope="col">Membimbing Jurusan</th>
            <th scope="col">Membimbing Industri</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($pembimbing as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nip; ?></td>
            <td><?= $x->nama_pembimbing; ?></td>
            <td><?= $x->nama_jurusan; ?></td>
            <td><?= $x->nama_industri; ?></td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
