<?= $this->extend('admin/export/kop_surat'); ?>
<?= $this->section('content'); ?>

<hr>
<h3 class="text-center text-bold">Data Guru Pembimbing</h3>
<br>
<table class="table table-bordered" id="DataTable">
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

<br><br>
<?= $this->endSection('content'); ?>
