<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Industri yang Anda Bimbing</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Industri yang Anda Bimbing</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                Data Industri yang Anda Bimbing
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
                            <th scope="col" style="width:10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $x->nama_industri; ?></td>
                            <td><?= $x->bidang_kerja; ?></td>
                            <td><?= $x->kuota; ?></td>
                            <td><?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri) ?></td>
                            <td><?= $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?></td>
                            <td><center><a target="__BLANK" href="<?php echo base_url('industri/'.$x->slug); ?>"><span class="badge badge-success"><i class="fas fa-eye"></i></span></a></center></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</section>
</div>
<script>

</script>
<?= $this->endSection('content'); ?>