<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Tambah Jurusan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/jurusan'); ?>">Data Jurusan</a></li>
            <li class="breadcrumb-item active">Tambah Jurusan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Tambah Jurusan
            </div>

            <div class="card-body">
                <form id="TambahJurusan">
                <div class="mb-3 row">
                    <label for="tambah_jurusan" class="col-sm-2 col-form-label">Nama Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_jurusan" placeholder="Nama" required>
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

    $('#TambahJurusan').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/tambahjurusan_action'); ?>',
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
                $('#TambahJurusan').trigger("reset");
            }

        });

    });
});
</script>

<?= $this->endSection('content'); ?>