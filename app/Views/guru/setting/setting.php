<?= $this->extend('guru/v_guru'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Setting</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Setting</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                Setting    
            </div>
            <div class="card-body">
                <form id="EditPembimbing">
                    
                    <?php foreach($guru as $j): ?>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" placeholder="NIP" required value="<?= $j->nip; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pembimbing" placeholder="Nama Pembimbing" required value="<?= $j->nama_pembimbing; ?>">
                        </div>
                    </div>
                    
                    <input type="hidden" name="id_industri" value="<?= $j->id_industri; ?>">
                    <input type="hidden" name="id" value="<?= $_SESSION['id_pembimbing'];?>">


                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required value="<?= $j->username; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <small>Kosongkan jika tidak diubah</small>
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
    $('#loading').hide();

    $('#EditPembimbing').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/editpembimbing_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#loading').show();
                $('#submit').hide();
            },
            complete : function(){
                $('#submit').show(),
                $('#loading').hide();
            },
            success : function(e){
                swal(e)
                .then((result) => {
                   location.reload();
                }).catch((err) => {
                    
                });
            },
            error : function(error){
                alert(error);
            }
        })
    });
</script>
<?= $this->endSection('content'); ?>