<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Tambah Kelas</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kelas'); ?>">Data Kelas</a></li>
            <li class="breadcrumb-item active">Tambah Kelas</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Tambah Kelas
            </div>

            <div class="card-body">
                <form id="TambahKelas">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kelas" placeholder="Nama" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="id_jurusan">
                                <option selected>- Pilih Jurusan -</option>
                                <?php foreach ($jurusan as $x): ?>
                                <option value="<?= $x->id_jurusan; ?>"><?= $x->nama_jurusan; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" id="submit">
                        Simpan
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

    $('#TambahKelas').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/tambahkelas_action'); ?>',
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
                swal(e);
                $('#TambahKelas').trigger("reset");
            }

        });

    });
});
</script>

<?= $this->endSection('content'); ?>