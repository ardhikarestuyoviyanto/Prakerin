<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Atur Penempatan : <?= $nama_industri; ?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/penmanual'); ?>">Atur Penempatan</a></li>
            <li class="breadcrumb-item"><?= $nama_industri; ?></li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    
    <div class="row">

        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Pilih Siswa
                </div>

                <div class="card-header bg-gray-light">
                    <form action="<?= base_url('admin/setmanual/'.$industri); ?>" method="get">
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
                                <a href="<?= base_url('admin/setmanual/'.$industri); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if(isset($_GET['kelas'])): ?>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="Pos">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col"><input type="checkbox" id="parent"></th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas / Jurusan</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form id="Penempatan">
                        <input type="hidden" name="id_industri" value="<?= $industri; ?>">
                        <?php $i=1; foreach ($data as $x): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <?php if($modell->getStatusPenempatanByIdIndustri($x->id_siswa, $industri) == 0 && $modell->CekPenempatan($x->id_siswa) == 0){ ?>
                            <td><input name="id_siswa[]" class="child" type="checkbox" value="<?= $x->id_siswa; ?>"></td>
                            <?php }else{ ?>
                            <td></td>
                            <?php } ?>
                            <td><?php echo $x->nama_siswa; ?></td>
                            <td><?php echo $x->nama_kelas." / ".$x->nama_jurusan; ?></td>
                            <td>
                                <?php if($modell->getStatusPenempatanByIdIndustri($x->id_siswa, $industri) == 0){ ?>
                                    <?php if($modell->CekPenempatan($x->id_siswa) > 0){ ?>
                                    <span class="badge badge-warning">Terdaftar Di Industri Lain</span>
                                    <?php }else{ ?>
                                    <span class="badge badge-danger">Belum Terdaftar</span>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <span class="badge badge-success">Terdaftar</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-sm">Atur Penempatan</button>
                </div>
                </form>           
                <?php endif; ?>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="card">
                <div class="card-header">
                    Data Industri
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <?php foreach ($industri_detail as $x): ?>
                            
                            <tr>
                                <th scope="row">Nama Industri</th>
                                <td><?php echo $x->nama_industri; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Bidang Kerja</th>
                                <td><?php echo $x->bidang_kerja; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kuota Maksimal</th>
                                <td><?php echo $x->kuota; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kuota Terisi</th>
                                <td><?php echo $kuota_terisi; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sisa Kuota</th>
                                <td><?php echo $x->kuota - $kuota_terisi; ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Guru Pembimbing</th>
                                <td>
                                    <?php $i=1; foreach($pembimbing as $y): ?>
                                        <?php if($i == 1): ?>
                                        <?= $y->nama_pembimbing; ?>
                                        <?php endif; ?>
                                    <?php $i++; endforeach; ?>
                                </td>
                            </tr>

                            <?php $k=1; foreach($pembimbing as $y): ?>
                            <?php if(count($pembimbing) > 1 && $k > 1): ?>
                            <tr>
                                <td></td>
                                <td><?= $y->nama_pembimbing; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php $k++; endforeach; ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



    </div>
</section>
</div>


<script>
$('document').ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

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

    $('#Penempatan').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Yakin Mau Menempatkan Siswa Yang Ter-Checklist");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/setmanual_action'); ?>',
            type : 'POST',
            data : $(this).serialize(),
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