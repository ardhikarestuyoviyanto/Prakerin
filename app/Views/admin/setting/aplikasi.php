<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Pengaturan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Pengaturan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Pengaturan
    </div>

    <div class="card-body">
        <form id="EditInstansi">
            
            <?php foreach($data as $j): ?>

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_instansi" required value="<?= $j->nama_instansi; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Aplikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_app" required value="<?= $j->nama_app; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Kepala Sekolah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kepala_sekolah" required value="<?= $j->kepala_sekolah; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" required value="<?= $j->email; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">No Hp</label>
                <div class="col-sm-10">
                    <input type="notelp" class="form-control" name="notelp" required value="<?= $j->notelp; ?>">
                </div>
            </div>

            
            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Script Disqus</label>
                <div class="col-sm-10">
                    <textarea name="disqus" id="" cols="30" rows="10" class="form-control" required><?= $j->disqus; ?></textarea>
                    <small><a target="__BLANK" href="https://disqus.com/">Info Lebih lanjut mengenai disqus</a></small>
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

    $('#EditInstansi').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/aplikasi_edit'); ?>',
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
                });
            }

        });

    });

});
</script>

<?= $this->endSection('content'); ?>