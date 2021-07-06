<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Penilaian</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Penilaian</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Data Penilaian
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('guru/penilaian'); ?>" method="get">
            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Industri</label>
                <div class="col-sm-10">
                    <select class="form-control" aria-label="Default select example" required name="industri">
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
            </div>
        </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>     
        </div>
    </form>
    
    <?php if(isset($_GET['industri'])): ?>
    <div class="card-body">
    <div class="alert alert-light" role="alert">
        Ada <b><?= $modell->getTotalAspekByJurusan($id_jurusan)?> Aspek </b> Yang Perlu Dinilai Pada Jurusan Ini.
    </div>
        <table class="table table-bordered" id="Table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Approval Jurnal</th>
                    <th scope="col">Unapproval Jurnal</th>
                    <th scope="col">Total Jurnal</th>
                    <th scope="col">Rata - rata Nilai</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td class="text-bold text-success"><?= $modell->getTotalStatusJurnalApproval($x->id_penempatan); ?></td>
                    <td class="text-bold text-danger"><?= $modell->getTotalStatusJurnalUnapproval($x->id_penempatan); ?></td>
                    <td class="text-bold"><?= $modell->getTotalJurnalByIdPenempatan($x->id_penempatan); ?></td>
                    <td><?= number_format($modell->getRataRataNilai($x->id_penempatan), 1); ?></td>
                    <td><a href="<?=  base_url('guru/inputnilai/'.$x->id_penempatan.'/'.$modell->getIdJurusanByIdkelas($modell->getIdKelasByIdsiswa($x->id_siswa)).'/'.$_GET['industri'].'/'.$modell->getIdKelasByIdsiswa($x->id_siswa)) ?>" ><span class="badge badge-primary">Input Nilai</span></a></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>        
    </div>
    <div class="card-footer">
        *) Jika Rata - rata nilai 0 itu artinya nilai belum di inputkan
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