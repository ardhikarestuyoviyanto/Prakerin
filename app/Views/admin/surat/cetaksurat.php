<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Cetak Surat Pengantar</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Cetak Surat Pengantar</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Cetak Surat Pengantar
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/cetaksurat'); ?>" method="get">
            <div class="row">

                <div class="col-3">
                    <select class="form-control form-control-sm" aria-label="Default select example" required name="industri">
                        <option selected value="">- Pilih Industri -</option>
                        <?php foreach ($industri as $x): ?>
                        <?php if($x->id_industri == @$_GET['industri']){ ?>
                        <option value="<?= $x->id_industri; ?>" selected><?= $x->nama_industri; ?></option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_industri; ?>"><?= $x->nama_industri; ?></option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-success btn-sm">Filter</button>
                    <a href="<?= base_url('admin/cetaksurat'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                </div>
            </div>
        </form>
    </div>

        <?php if(isset($_GET['industri'])): ?>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $x->nis; ?></td>
                            <td><?= $x->nama_siswa; ?></td>
                            <td><?= $x->nama_jurusan; ?></td>
                            <td><?= $x->nama_kelas; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <form action="<?= base_url('export/export_suratpengantar'); ?>" method="get" target="_blank">
                    <input type="hidden" name="industri" value="<?= $_GET['industri'] ?>">
                    <input type="hidden" name="surat" value="yes">
                    <button type="submit" class="btn btn-primary btn-sm">Cetak Surat Pengantar</button>
                </form>
            </div>

        <?php endif; ?>

    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){


});
</script>

<?= $this->endSection('content'); ?>