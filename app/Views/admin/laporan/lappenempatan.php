<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Data Penempatan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Data Penempatan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Pilih Type Filtering
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Industri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kelas</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <?php if(@$_GET['type'] == "industri" || @empty($_GET['type'])): ?>
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php else : ?>
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php endif ?>
                <form action="<?= base_url('admin/lappenempatan'); ?>" method="get">
                    <div class="row mt-4">
                        <div class="col">
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
                        <input type="hidden" name="type" value="industri">
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-sm">Filter</button>
                            <a href="<?= base_url('admin/lappenempatan'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                        </div>
                    </div>
                </form>
                
                <?php if(isset($_GET['industri'])): ?>
                <table class="table table-bordered mt-3 table-hover penempatan">
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

                <div class="card-footer mt-4">
                    <form action="<?= base_url('export/export_perindustri'); ?>" method="GET" target="_blank">
                        <input type="hidden" name="industri" value="<?= @$_GET['industri'] ?>">
                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                    </form>
                </div>

                <?php endif; ?>

            </div>


            <div class="tab-pane fade <?php if(@$_GET['type'] == "kelas"){?> active show <?php } ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form action="<?= base_url('admin/lappenempatan'); ?>" method="get">
                    <div class="row mt-4">
                        <div class="col">
                            <select class="form-control form-control-sm" aria-label="Default select example" required name="kelas">
                                <option selected value="">- Pilih Kelas -</option>
                                <?php foreach ($kelas as $x): ?>
                                <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                                <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas; ?></option>
                                <?php }else{ ?>
                                    <option value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas; ?></option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="type" value="kelas">

                        <div class="col">
                            <button type="submit" class="btn btn-success btn-sm">Filter</button>
                            <a href="<?= base_url('admin/perindustri'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                        </div>
                    </div>
                </form>

                <?php if(isset($_GET['kelas'])): ?>
                <table class="table table-bordered mt-3 table-hover penempatan">
                    <thead>
                        <tr>
                            <th scope="col" width="10">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Industri</th>
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
                            <td><?= $x->nama_industri; ?></td>
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

                <div class="card-footer mt-4">
                    <form action="<?= base_url('export/exportpenempatan_perkelas'); ?>" method="GET" target="_blank">
                        <input type="hidden" name="kelas" value="<?= @$_GET['kelas'] ?>">
                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                    </form>
                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>

    </div>

    </div>
</section>
</div>


<script>
$('document').ready(function(){
    $('.penempatan').DataTable({
        "responsive":true,
        "paginate": false,
        "info": false
    });
});
</script>

<?= $this->endSection('content'); ?>