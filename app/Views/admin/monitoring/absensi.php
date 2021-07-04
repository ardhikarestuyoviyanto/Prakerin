<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Input Presensi</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Input Presensi</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Input Persensi
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/absensi'); ?>" method="get">
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

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                <div class="col-sm-10">
                    <select class="form-control" aria-label="Default select example" required name="kelas">
                        <option selected value="">- Kelas / Jurusan -</option>
                        <?php foreach ($kelas as $x): ?>
                        <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                        <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_kelas; ?>"><?=  $x->nama_kelas." / ".$x->nama_jurusan;?></option>
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

    <?php if(isset($_GET['kelas']) && isset($_GET['industri'])): ?>
    <form id="TambahRekap">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" style="width:50px;"><input type="checkbox" id="parent"></th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Status Absensi</th>
                    <th scope="col" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <?php if(empty($modell->getStatusAbsensi($x->id_penempatan, $_GET['tgl']))){ ?>
                    <td><input name="id_penempatan[]" class="child" type="checkbox" value="<?= $x->id_penempatan; ?>"></td>
                    <?php }else{echo "<td></td>";} ?>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td>
                        <?php 
                            if(empty($modell->getStatusAbsensi($x->id_penempatan, $_GET['tgl']))){
                                
                                echo "BELUM ABSEN";
                            
                            }else{

                                echo strtoupper($modell->getStatusAbsensi($x->id_penempatan, $_GET['tgl']));

                            }
                        ?>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/editabsen/'.$x->id_penempatan); ?>">
                            <span class="badge badge-primary"><i class="fas fa-edit"></i></span>
                        </a>

                        <a href="#" class="HapusAbsensi" data-tgl="<?= $_GET['tgl']; ?>" data-id="<?= $x->id_penempatan; ?>">
                            <span class="badge badge-danger"><i class="fas fa-trash"></i></span>
                        </a>
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
                    <option selected value="">- PILIH KEHADIRAN -</option>
                    <option value="hadir">- HADIR -</option>
                    <option value="sakit">- SAKIT - </option>
                    <option value="ijin">- IJIN -</option>
                    <option value="alpa">- ALFA - </option>
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
    $('#Permohonan').DataTable({
        responsive : true
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

    $('#TambahRekap').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Lanjutkan Proses Rekap Absensi Sesuai Data Yang Anda Checklist ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/input_rekapabsensi'); ?>',
            type : 'POST',
            data : $(this).serialize(),
            success : function(data){
                swal(data)
                .then((result) => {
                    location.reload();
                });
            },
            error : function(err){
                console.log(err);
            }
        });

        }

    });

    $('.HapusAbsensi').click(function(e){
        e.preventDefault();

        var confirmed = confirm("Lanjutkan Proses Hapus ?");

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/hapusabsen_action')?>',
                data : {'id_penempatan':$(this).data('id'), 'tgl':$(this).data('tgl')},
                type : 'POST',
                success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                },
                error : function(err){
                    console.log(err);
                }
            });

        }
    });


});
</script>

<?= $this->endSection('content'); ?>