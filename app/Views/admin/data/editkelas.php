<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Kelas</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kelas'); ?>">Data Kelas</a></li>
            <li class="breadcrumb-item active">Edit Kelas</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Edit Kelas
            </div>

            <div class="card-body">
                <form id="EditKelas">

                    <?php foreach ($kelas as $j): ?>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kelas" placeholder="Nama" required value="<?= $j->nama_kelas; ?>">
                        </div>
                    </div>

                    <input type="hidden" name="id_kelas" value="<?= $j->id_kelas; ?>">

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="id_jurusan">
                                <option selected>- Pilih Jurusan -</option>
                                <?php foreach ($jurusan as $x): ?>
                                <?php if($j->id_jurusan == $x->id_jurusan){ ?>
                                <option selected value="<?= $x->id_jurusan; ?>"><?= $x->nama_jurusan; ?></option>
                                <?php }else{ ?>
                                <option value="<?= $x->id_jurusan; ?>"><?= $x->nama_jurusan; ?></option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
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

    $('#EditKelas').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/editkelas_action'); ?>',
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
</script>

<?= $this->endSection('content'); ?>