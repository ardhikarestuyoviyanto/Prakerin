<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Bimbingan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Bimbingan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                Data Bimbingan
            </div>
            <div class="card-header bg-gray-light">
            
                <form action="<?= base_url('guru/bimbingan'); ?>" method="get">
                    <div class="row">
                        <div class="col">
                            <select class="form-control form-control-sm" aria-label="Default select example" required name="industri">
                                <option selected value="">- Pilih Industri yang Anda Bimbing -</option>
                                <?php foreach ($industri as $x): ?>
                                <?php if($x->id_industri == @$_GET['industri']){ ?>
                                <option value="<?= $x->id_industri; ?>" selected><?= $x->nama_industri; ?></option>
                                <?php }else{ ?>
                                <option value="<?= $x->id_industri; ?>"><?= $x->nama_industri; ?></option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success btn-sm">Filter</button>
                            <a href="<?= base_url('guru/bimbingan'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <?php if(isset($_GET['industri'])): ?>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="DataTable">
                    <thead>
                        <tr>
                            <th scope="col" width="10">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jalur Penempatan</th>
                            <th scope="col">Status Penempatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $x->nis; ?></td>
                            <td><?= $x->nama_siswa; ?></td>
                            <td><?= $x->nama_kelas; ?></td>
                            <td>
                                <?php if($x->surat == "kosong"){ ?>
                                    MANUAL
                                <?php }else{ ?>
                                    PERMOHONAN
                                <?php } ?>
                            </td>
                            <td><?= ucfirst($x->status); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</div>
<script>
    $('#DataTable').DataTable({
        "responsive":true
    });
</script>
<?= $this->endSection('content'); ?>