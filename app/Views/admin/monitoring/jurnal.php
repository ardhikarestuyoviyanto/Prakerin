<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Rekap Jurnal</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Rekap Jurnal</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Rekap Jurnal
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/jurnal'); ?>" method="get">
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
    
    </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>     
        </div>
    </form>
    
    <?php if(isset($_GET['kelas']) && isset($_GET['industri'])): ?>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Total Jurnal</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td  data-toggle="collapse" id="table1" data-target=".table<?php echo $i; ?>"><a type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i></a></td>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td>
                        <?= $modell->getTotalJurnalByIdPenempatan($x->id_penempatan); ?>
                    </td>
                </tr>

                <tr class="collapse table<?php echo $i; ?>">
                    <td colspan="999">
                        <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Keterangan</th>
                                <th>Tgl Kumpul</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $k=1; foreach($modell->getJurnalByIdPenempatan($x->id_penempatan)->getResult() as $y): ?>
                                <tr>
                                    <td><?= $k++; ?></td>
                                    <td><?= $y->judul; ?></td>
                                    <td><?= $y->keterangan; ?></td>
                                    <td><?= date('d-m-y  /  H:i:s', strtotime($y->tgl_kumpul)); ?></td>
                                    <td>
                                        <input type="number" name="nilai" id="nilai" class="form-control nilai" placeholder="Silahkan Isi Nilai" required value="<?= $y->nilai; ?>">
                                    </td>
                                    <td>
                                        <a href="#" data-id="<?= $y->id_jurnal; ?>" class="savenilai"><span class="badge badge-primary">Input Nilai</span></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){

    //get nilai on change ketika user meng-inputkan nilai
    //lalu di append kan nilai tersebut atribut data-nilai pada link

    $('.nilai').on('change', function(){
        var value = $(this).val();
        $('.savenilai').attr('data-nilai', value);
    });

    $('.savenilai').click(function(e){
        e.preventDefault();

        var nilai = $(this).data('nilai');
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('admin/InputNilaiJurnal'); ?>',
            data: {'id':id, 'nilai':nilai},
            type: 'POST',
            success: function(data){
                swal(data);
            },
            error: function(error){
                alert('Server Error');
            }
        });

    });


});
</script>

<?= $this->endSection('content'); ?>