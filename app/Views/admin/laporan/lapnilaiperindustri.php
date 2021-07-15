<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Nilai Per Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Nilai Per Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Nilai Per Industri
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/nilaiperindustri'); ?>" method="get">
                <div class="row">
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

                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Filter</button>
                        <a href="<?= base_url('admin/nilaiperindustri'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <?php if(isset($_GET['industri'])): ?>
        <div class="card-body">
            
            <p class="text-bold">Industri : <?= $modell->getNamaIndustriByIdIndustri($_GET['industri']); ?></p>

            <table class="table table-bordered table-hover" >
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Total Laporan</th>
                        <th scope="col">Approval Laporan</th>
                        <th scope="col">Unapproval Laporan</th>
                        <th scope="col">Rata - rata Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($siswa as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $x->nama_kelas; ?></td>
                        <td><?= count($modell->getJurnalByIdSiswa($x->id_siswa)->getResult()); ?></td>
                        <td><?= $modell->getTotalStatusJurnalApproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
                        <td><?= $modell->getTotalStatusJurnalUnapproval($modell->getIdPenempatanByidSiswa($x->id_siswa));?></td>
                        <td><?= number_format($modell->getRataRataNilai($modell->getIdPenempatanByidSiswa($x->id_siswa)), 1); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <small>*) Jika Rata - rata Nilai 0, maka ada aspek penilaian yang belum dinilai atau siswa tersebut belum ditempatkan.</small>

        </div>
        
        <div class="card-footer">
            <form action="<?= base_url('export/export_nilaiperindustri'); ?>" method="GET" target="_blank">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="type">
                            <option selected value="">- Pilih Type Export -</option>
                            <option value="pdf">- PDF -</option>
                            <option value="excel">- EXCEL -</option>
                        </select>
                    </div>
                    <input type="hidden" name="industri" value="<?= @$_GET['industri']; ?>">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                    </div>
                </div>
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