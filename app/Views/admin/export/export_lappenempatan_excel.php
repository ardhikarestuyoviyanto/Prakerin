<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Penempatan.xls");
?>

<table border="1">
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
