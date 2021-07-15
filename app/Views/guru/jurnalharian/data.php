<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Approval Jurnal Harian</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Approval Jurnal Harian</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Approval Jurnal Harian
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('guru/approvaljurnal'); ?>" method="get">
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

            <div class="row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Pilih Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" name="tgl" id="tgl" <?php if(isset($_GET['tgl'])){ ?> value="<?= $_GET['tgl']; ?>" <?php } ?> class="form-control" required>
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

        <table class="table table-bordered" id="DataTable">
            <thead>
                <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col" style="width:50px;"><input type="checkbox" id="parent"></th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="10">Aksi</th>
                    <th scope="col" class="none">Kegiatan : </th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <?php if(!empty($modell->getIdJurnalHarian($x->id_penempatan, $_GET['tgl']))): ?>
                        <td><input name="id_jurnal_harian[]" class="child" type="checkbox" value="<?= $modell->getIdJurnalHarian($x->id_penempatan, $_GET['tgl']); ?>"></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td><?= $modell->getNamaKelas($x->id_kelas); ?></td>
                    <td>
                        <?php if($modell->getStatusJurnalHarian($x->id_penempatan, $_GET['tgl']) == "P"): ?>
                            Pending
                        <?php elseif($modell->getStatusJurnalHarian($x->id_penempatan, $_GET['tgl']) == "N"): ?>
                            Unapproval
                        <?php elseif($modell->getStatusJurnalHarian($x->id_penempatan, $_GET['tgl']) == "Y"): ?>
                            Approval
                        <?php else: ?>
                            Belum Mengisi
                        <?php endif; ?>
                    </td>
                    <td>

                        <a href="#" class="hapus" data-tgl="<?= $_GET['tgl']; ?>" data-id="<?= $x->id_penempatan; ?>">
                            <span class="badge badge-danger"><i class="fas fa-trash"></i></span>
                        </a>
                    </td>
                    <td>
                        <br>
                        <?php $kegiatan = explode(",", $modell->getJurnalHarianByTgl($x->id_penempatan, $_GET['tgl']))?>
                        <?php
                            foreach($kegiatan as $y):
                                echo $y."<br>";
                            endforeach;
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <input type="hidden" name="tgli" id="tgli" <?php if(isset($_GET['tgl'])){ ?> value="<?= $_GET['tgl']; ?>" <?php } ?>>
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col">
                <select class="form-control form-control-sm" aria-label="Default select example" required name="status">
                    <option selected value="">- PILIH STATUS -</option>
                    <option value="Y">- APPROVAL -</option>
                    <option value="N">- UNAPPROVAL - </option>
                </select>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
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
        responsive : true,
        "ordering": false
    });
    $('#parent').click(function(){
        $('.child').prop('checked', this.checked);
    });

    $('.child').click(function() {
        if ($('.child:checked').length == $('.child').length) {
            $('#parent').prop('checked', true);
        } else {
            $('#parent').prop('checked', false);
        }
    });

    $('#UpdateStatusJurnal').submit(function(e){
        e.preventDefault();

        var confirmed = confirm('Lanjutkan Proses Approval ?');

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/updatejurnalharian')?>',
                type : 'POST',
                data: $(this).serialize(),
                success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    }).catch((err) => {
                        
                    });
                },
                error : function(err){
                    console.log(err);
                }
            })

        }
    });

    $('.hapus').click(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Hapus Data Ini ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/hapusjurnalharian'); ?>',
            type : 'POST',
            data : {'id':$(this).data('id'), 'tgl':$(this).data('tgl')},
            success : function(data){
                swal(data)
                .then((result) => {
                    location.reload();
                });
            },
            error : function(err){
                alert(err);
            }
        });

        }

    });


});
</script>

<?= $this->endSection('content'); ?>