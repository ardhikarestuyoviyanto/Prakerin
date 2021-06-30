<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Admin</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/showadmin'); ?>">Data Admin</a></li>
            <li class="breadcrumb-item active">Edit Admin</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Edit Admin
            </div>

            <div class="card-body">
                <?php foreach ($admin as $x): ?>
                <form id="EditAdmin">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Admin" required value="<?= $x->nama; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $x->id; ?>">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required value="<?= $x->username; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <small>Kosongkan Jika Tidak dirubah</small>
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

    $('#EditAdmin').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/editadmin_action'); ?>',
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
            },
            error : function(err){
                alert(err);
            }
        });
    });

});
</script>

<?= $this->endSection('content'); ?>