<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Rekap Jurnal Harian</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Rekap Jurnal Harian</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Rekap Jurnal Harian
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('guru/rekapjurnal'); ?>" method="get">
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
                    <input type="date" name="finish" id="finish" <?php if(isset($_GET['finish'])){ ?> value="<?= $_GET['finish']; ?>"<?php }else{ ?> value="<?= date('Y-m-d'); ?>" <?php } ?> class="form-control" required>
                </div>
            </div>

    </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>      
        </div>
    </form>

    <?php if(isset($_GET['industri'])): ?>
    <form id="UpdateStatusJurnal">
    <div class="card-body">
    <h6 class="text-bold mt-3 mb-4">Tanggal : <?= date('d M Y', strtotime($_GET['start']))." - ".date('d M Y', strtotime($_GET['finish'])); ?> </h6>

        <table class="table table-bordered" id="DataTable">
            <thead>
                <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Approval</th>
                    <th scope="col">Unapproval</th>
                    <th scope="col">Pending</th>
                    <th scope="col">Total Rekap</th>
                    <th scope="col" class="none" width="100%">Kegiatan : </th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td><?= $modell->getNamaKelas($x->id_kelas); ?></td>
                    <td class="text-bold text-success"><?= $modell->getTotalJurnalHarianApproval($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold text-danger"><?= $modell->getTotalJurnalHarianUnapproval($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold text-primary"><?= $modell->getTotalJurnalHarianPending($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
                    <td class="text-bold"><?= $modell->getTotalJurnalHarian($x->id_penempatan, $_GET['start'], $_GET['finish']); ?></td>
                    <td>
                        <br>
                        <?php foreach($modell->getJurnalHarianDetail($x->id_penempatan, $_GET['start'], $_GET['finish'])->getResult() as $x): ?>
                            <b class="text-success"><?= date('d-M-Y', strtotime($x->tgl)); ?> (<?php if($x->status == "Y"){echo "Approval"; }elseif($x->status == "N"){echo "Unapproval";}else{echo "Pending";} ?>)</b>
                            <br>
                             <?php
                                $kegiatan = explode(",", $x->kegiatan);
                                foreach($kegiatan as $y): 
                                    echo $y."<br>";
                                endforeach;
                            ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">

    </div>
    </form>
    <?php endif; ?>
    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){

    $('#DataTable').DataTable({
        responsive: true,
    })
    
    $('.linkcollapse').click(function(e){
        e.preventDefault();
    })

});
</script>

<?= $this->endSection('content'); ?>