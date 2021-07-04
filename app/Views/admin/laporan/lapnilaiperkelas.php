<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; ?>
<?php $modell = new ModelsAdmin(); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Nilai Per Kelas</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Nilai Per Kelas</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Nilai Per Kelas
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/nilaiperkelas'); ?>" method="get">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="kelas">
                            <option selected value="">- Pilih Kelas / Jurusan -</option>
                            <?php foreach ($kelas as $x): ?>
                            <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                            <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                            <?php }else{ ?>
                            <option value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Filter</button>
                        <a href="<?= base_url('admin/nilaiperkelas'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <?php if(isset($_GET['kelas'])): ?>
        <div class="card-body">
            
            <p class="text-bold">Kelas : <?= $modell->getNamaKelas($_GET['kelas']); ?></p>

            <table class="table table-bordered table-hover" >
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Industri</th>
                        <th scope="col">Total Jurnal</th>
                        <th scope="col">Approval Jurnal</th>
                        <th scope="col">Unapproval Jurnal</th>
                        <th scope="col">Rata - rata Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($siswa as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $modell->getNamaIndustriByIdSiswa($x->id_siswa); ?></td>
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
            <form action="<?= base_url('export/export_nilaiperkelas'); ?>" method="GET" target="_blank">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="type">
                            <option selected value="">- Pilih Type Export -</option>
                            <option value="pdf">- PDF -</option>
                            <option value="excel">- EXCEL -</option>
                        </select>
                    </div>
                    <input type="hidden" name="kelas" value="<?= $_GET['kelas']; ?>"
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