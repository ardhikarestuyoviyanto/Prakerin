<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<style type="text/css">
            table{
                background: #fff;
            }
.paging-nav {
  text-align: right;
  padding-top: 2px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

.paging-nav,
#tableData {
  width: 400px;
  margin: 0 auto;
  font-family: Arial, sans-serif;
}
</style>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Rekapitulasi Presensi</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Rekapitulasi Presensi</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Rekapitulasi Presensi
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/rekappresensi'); ?>" method="get">
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

            <div class="row mb-3">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Dari Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" name="start" id="start" <?php if(isset($_GET['start'])){ ?> value="<?= $_GET['start']; ?>" <?php } ?> class="form-control" required>
                </div>
            </div>

            <div class="row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" name="finish" id="finish" <?php if(isset($_GET['finish'])){ ?> value="<?= $_GET['finish']; ?>" <?php }else{ ?> value="<?= date('Y-m-d') ?>" <?php } ?>class="form-control" required>
                </div>
            </div>
    
    </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>     
        </div>
    </form>

    <?php if(isset($_GET['industri'])): ?>
    <div class="card-body">
        <h6 class="text-bold mt-3 mb-3">Tanggal : <?= date('d M Y', strtotime($_GET['start']))." - ".date('d M Y', strtotime($_GET['finish'])); ?> </h6>
        <table class="table table-bordered" id="DataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" width="10">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col" >Hadir</th>
                    <th scope="col">Sakit</th>
                    <th scope="col">Izin</th>
                    <th scope="col">Alfa</th>
                    <th scope="col">Total Rekap</th>
                    <th scope="col" class="none">Rekap Detail :</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                        <a target="__BLANK" href="<?= base_url('export/export_presensipersiswa?id_penempatan='.$x->id_penempatan.'&id_siswa='.$x->id_siswa.'&start='.$_GET['start'].'&finish='.$_GET['finish']) ?>" type="button" class="btn btn-success btn-xs"><i class="fas fa-file-download"></i></a>
                    </td>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td><?= $modell->getNamaKelas($x->id_kelas); ?></td>
                    <td class="text-bold text-success"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "hadir", $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold text-primary"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "sakit", $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold text-info"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "izin", $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold text-danger"><?= $modell->getAbsensiByIdPenempatan($x->id_penempatan, "alfa", $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold"><?= $modell->getTotalAbsensiByIdPenempatan($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
                    <td>
                    <br>
                    <table class="table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php $j=1; foreach($modell->getAbsensiPerSiswaRekap($x->id_penempatan, $_GET['start'], $_GET['finish'])->getResult() as $x): ?>
                                <tr>
                                    <td><?= $j++; ?></td>
                                    <td scope="row"><?= date('d-M-Y', strtotime($x->tgl)); ?></td>
                                    <td>
                                        <?php if($x->status == "hadir"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "sakit"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "ijin"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "alfa"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <form action="<?= base_url('export/export_presensi'); ?>" method="GET" target="_blank">
            <input type="hidden" name="start" value="<?= $_GET['start']; ?>">
            <input type="hidden" name="finish" value="<?= $_GET['finish'] ?>">
            <input type="hidden" name="industri" value="<?= $_GET['industri'] ?>">

            <button type="submit" class="btn btn-primary btn-sm">Cetak Rekapitulasi Diatas</button>
        </form>
    </div>
    <?php endif; ?>
    </div>


    </div>
</section>
</div>

<script>
$('document').ready(function(){

    $('#DataTable').DataTable({
        responsive : true
    })

});
</script>

<?= $this->endSection('content'); ?>
