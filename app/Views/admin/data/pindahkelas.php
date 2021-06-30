<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Proses Pindah Kelas</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Pindah Kelas</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Proses Pindah Kelas
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/pindah'); ?>" method="get">

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
    
    <?php if(isset($_GET['kelas'])): ?>
    <form id="PindahKelas">
    <div class="card-body">

        <table class="table table-bordered" id="DataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"><input type="checkbox" id="parent"></th>
                    <th scope="col">NIS</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($siswa as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><input name="id[]" class="child" type="checkbox" value="<?= $x->id_siswa; ?>"></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->username; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $x->nama_kelas; ?></td>
                        <td><?= $x->nama_jurusan; ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row justify-content-center">
            <div class="col">
                <select class="form-control form-control-sm" aria-label="Default select example" required name="id_kelas">
                    <option selected value="">- Pilih Kelas Tujuan -</option>
                    <?php foreach ($kelas as $x): ?>
                    <option value="<?= $x->id_kelas; ?>"><?=  $x->nama_kelas." / ".$x->nama_jurusan;?></option>
                    <?php endforeach; ?>
                 </select>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm">Proses Pindah</button>
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
        "responsive":true
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

    $('#PindahKelas').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Lanjutkan Proses Pindah Kelas Sesuai Data Yang Anda Checklist ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/pindah_action'); ?>',
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



});
</script>

<?= $this->endSection('content'); ?>