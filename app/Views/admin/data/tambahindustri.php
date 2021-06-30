<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Tambah Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/industri'); ?>">Data Industri</a></li>
            <li class="breadcrumb-item active">Tambah Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Tambah Industri
            </div>

            <div class="card-body">
                <form id="TambahIndustri">
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Industri</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_industri" placeholder="Nama Industri" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Bidang Kerja</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bidang_kerja" placeholder="Contoh : Teknik Mesin" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Kuota</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="kuota" placeholder="Kuota Penerimaan" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat_industri" placeholder="Alamat" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Email Industri" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">No Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" placeholder="No Telpon" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Foto Industri</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="foto" required accept=".jpg, .png">
                                <label class="custom-file-label" for="customFile">Upload Foto</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="deskripsi" name="deskripsi"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Persyaratan</label>
                        <div class="col-sm-10">
                            <textarea id="syarat" name="syarat"></textarea>
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

    $(function () {
        bsCustomFileInput.init();
    });
    
    $('#deskripsi').summernote({
        height: 250,
        placeholder : 'Tuliskan Deskripsi Industri....'
    });
    $('#syarat').summernote({
        height: 250,
        placeholder : 'Tuliskan Persyaratan Masuk Industri....'
    });

    $('#TambahIndustri').submit(function(e){

        e.preventDefault();

        if($('#deskripsi').summernote('isEmpty')){

            swal('Kolom Deskripsi Tidak Boleh Kosong');

        }else if($('#syarat').summernote('isEmpty')){

            swal('Kolom Persyaratan Tidak Boleh Kosong');

        }else{

            $.ajax({
                url : '<?= base_url('Admin/tambahindustri_action') ?>',
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
                        $('#TambahIndustri').trigger("reset");
                        $('#syarat').summernote('code', '');   
                        $('#deskripsi').summernote('code', '');   
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