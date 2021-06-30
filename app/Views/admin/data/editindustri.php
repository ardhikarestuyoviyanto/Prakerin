<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/industri'); ?>">Data Industri</a></li>
            <li class="breadcrumb-item active">Edit Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Edit Industri
            </div>

            <div class="card-body">
                <?php foreach ($industri as $x): ?>
                <form id="EditIndustri">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Industri</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_industri" placeholder="Nama Industri" required value="<?= $x->nama_industri; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Bidang Kerja</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bidang_kerja" placeholder="Contoh : Teknik Mesin" required value="<?= $x->bidang_kerja; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $x->id_industri; ?>">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Kuota</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="kuota" placeholder="Kuota Penerimaan" required value="<?= $x->kuota; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat_industri" placeholder="Alamat" required value="<?= $x->alamat_industri; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Email Industri" required value="<?= $x->email; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">No Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" placeholder="No Telpon" required value="<?= $x->telp; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Foto Industri</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="foto" accept=".jpg, .png, .jpeg">
                                <label class="custom-file-label" for="customFile">Upload Foto</label>
                            </div>
                            <small>Gambar Terpasang : <a href="<?= base_url('assets/industri/'.$x->foto); ?>"> <?= $x->foto; ?></a></small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="deskripsi" name="deskripsi"><?= $x->deskripsi; ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Persyaratan</label>
                        <div class="col-sm-10">
                            <textarea id="syarat" name="syarat"><?= $x->syarat; ?></textarea>
                        </div>
                    </div>
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
        <?php endforeach; ?>
        </div>

    </div>
</section>
</div>

<script>
$('document').ready(function(){
    $('#loading').hide();

    $(function () {
        bsCustomFileInput.init();
    });
    
    $('#deskripsi').summernote({
        height: 300,
        placeholder : 'Tuliskan Deskripsi Industri....'
    });
    $('#syarat').summernote({
        height: 300,
        placeholder : 'Tuliskan Persyaratan Masuk Industri....'
    });

    $('#EditIndustri').submit(function(e){

        e.preventDefault();

        if($('#deskripsi').summernote('isEmpty')){

            swal('Kolom Deskripsi Tidak Boleh Kosong');

        }else if($('#syarat').summernote('isEmpty')){

            swal('Kolom Persyaratan Tidak Boleh Kosong');

        }else{

            $.ajax({
                url : '<?= base_url('Admin/editindustri_action') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
                beforeSend : function(){
                    $('#loading').show();
                    $('#submit').hide();
                },
                complete : function(){
                    $('#loading').hide();
                    $('#submit').show();
                },
                success : function(data){
                    swal(data)
                    .then((value) => {
                        location.reload(); 
                    });
                }, 
                error : function(data){
                    console.log(data);
                }

            });

        }


    });
});
</script>

<?= $this->endSection('content'); ?>