<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Siswa</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/siswa'); ?>">Data Siswa</a></li>
            <li class="breadcrumb-item active">Edit Siswa</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Edit Siswa
            </div>

            <div class="card-body">
                <?php foreach ($siswa as $s): ?>
                <form id="EditSiswa">

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nis" placeholder="NIS" required value="<?= $s->nis; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Siswa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_siswa" placeholder="Nama" required value="<?= $s->nama_siswa; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Kelas / Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="id_kelas">
                                <option value="" selected>- Pilih Kelas -</option>
                                <?php foreach ($kelas as $x): ?>
                                <?php if($s->id_kelas == $x->id_kelas){ ?>
                                <option selected value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                                <?php }else{ ?>
                                <option value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault1" required value="L" <?php if($s->jenis_kelamin == "L"): ?> checked <?php endif; ?>>
                                <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                    Laki - Laki
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="jenis_kelamin" id="flexRadioDefault2" required value="P" <?php if($s->jenis_kelamin == "P"): ?> checked <?php endif; ?>>
                                <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" value="<?= $s->id_siswa; ?>">

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat" required value="<?= $s->alamat; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required value="<?= $s->username; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-eye toggle-password"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak perlu diubah">
                            <br>
                        </div>
                    </div>

                    <?php endforeach; ?>

            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" id="submit">
                        Update
                    </button>

                    <button class="btn btn-primary" type="button" disabled id="loading">
                        <span class="visually-hidden">Loading...</span>
                    </button>
                </div>

            </div>
        </form>
        </div>

    </div>
</section>
</div>

<script>
$('document').ready(function(){
    $('#loading').hide();

    $('#EditSiswa').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/editsiswa_action'); ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#loading').show();
                $('#submit').hide();
            },
            complete : function(){
                $('#loading').hide();
                $('#submit').show();
            },
            success : function(e){
                swal(e)
                .then((result) => {
                    location.reload();   
                }).catch((err) => {
                    
                });
            }

        });

    });
});

$(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script>

<?= $this->endSection('content'); ?>