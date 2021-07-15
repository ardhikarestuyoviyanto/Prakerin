<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pembimbing.xls");
?>

<table border="1">
<thead>
        <tr>
            <th scope="col" width="10">No</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Pembimbing</th>
            <th scope="col">Tipe Pembimbing</th>
            <th scope="col">NoHp</th>
            <th scope="col">Industri</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach ($pembimbing as $x): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $x->nip; ?></td>
            <td><?= $x->nama_pembimbing; ?></td>
            <td>
                <?php if($x->type == "I"): ?>
                    INDUSTRI
                <?php else : ?>
                    SEKOLAH
                <?php endif; ?>
            </td>
            <td><?= $x->nohp; ?></td>
            <td><?= $x->nama_industri; ?></td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
