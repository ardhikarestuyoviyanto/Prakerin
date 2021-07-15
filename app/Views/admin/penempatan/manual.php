<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Atur Penempatan Manual</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Atur Penempatan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Pilih Industri Terlebih Dahulu
    </div>

        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Industri</th>
                        <th scope="col">Bidang Kerja</th>
                        <th scope="col">Kuota Maksimal</th>
                        <th scope="col">Kuota Terisi</th>
                        <th scope="col">Sisa Kuota</th>
                        <th scope="col">Action</th>
                        <th scope="col" class="none">Pembimbing : </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($industri as $x): ?>
                    <?php
                        $sisa = $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri);
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $x->nama_industri; ?></td>
                        <td><?= $x->bidang_kerja; ?></td>
                        <td><?= $x->kuota; ?></td>
                        <td><?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri) ?></td>
                        <td><?= $sisa; ?></td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Setting Penempatan" href="<?php echo base_url('admin/setmanual/'.$x->id_industri); ?>"><span class="badge badge-success">Setting Penempatan</span></a>
                        </td>
                        <td>
                            <?php foreach($modell->getguruByidIndustri($x->id_industri)->getResult() as $y): ?>
                                <br>
                                <?= $y->nama_pembimbing; ?>
                            <?php endforeach; ?>
                        </td>

                    </tr>

                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

    $('#DataTable').DataTable({
        responsive : true
    });

});
</script>

<?= $this->endSection('content'); ?>