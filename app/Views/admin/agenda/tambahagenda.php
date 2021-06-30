<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Tambah Agenda</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/agenda'); ?>">Data Agenda</a></li>
            <li class="breadcrumb-item">Tambah Agenda</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Tambah Agenda Baru
            </div>  

            <div class="card-body">
            <form id="TambahAgenda">

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Judul Agenda</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="judul" placeholder="Judul Agenda" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_kategoriagenda" name="id_kategoriagenda" style="width: 100%;" required>
                            <option value="">Pilih Kategori Agenda</option>
                            <?php foreach ($kategoriagenda as $x): ?>
                            <option value="<?= $x->id_kategoriagenda; ?>"><?= $x->nama_kategoriagenda; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Isi Agenda</label>
                    <div class="col-sm-10">
                        <textarea id="isi" name="isi"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="foto" required accept=".jpg, .png, .jpeg">
                            <label class="custom-file-label" for="customFile">Upload Foto</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Lampiran File</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFilee" name="file">
                            <label class="custom-file-label" for="customFile">Upload Lampiran File</label>
                            <small>Boleh dikosongkan jika tidak melampiran file</small>
                        </div>
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
    </div>
</section>
</div>


<script>
$('document').ready(function(){

    $('#loading').hide();

    $(function () {
        bsCustomFileInput.init();
    });
    
    $('#isi').summernote({
        height: 390,
        placeholder : 'Tuliskan Isi Agenda....'
    });

    $('#TambahAgenda').submit(function(e){
        e.preventDefault();

        if($('#isi').summernote('isEmpty')){

            swal('Isi Agenda Masih Kosong');

        }else{

            
            $.ajax({
                url : '<?= base_url('Admin/tambahagenda_action') ?>',
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
                        $('#TambahAgenda').trigger("reset");
                        $('#isi').summernote('code', '');   
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