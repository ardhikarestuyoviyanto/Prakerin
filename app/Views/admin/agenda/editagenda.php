<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Agenda</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/agenda'); ?>">Data Agenda</a></li>
            <li class="breadcrumb-item">Edit Agenda</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Edit Agenda
            </div>  

            <?php foreach($data as $y): ?>
            <div class="card-body">
            <form id="EditAgenda">

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Judul Agenda</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="judul" placeholder="Judul Agenda" required value="<?= $y->judul; ?>">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $y->id_agenda; ?>">
                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_kategoriagenda" name="id_kategoriagenda" style="width: 100%;" required>
                            <option value="">Pilih Kategori Agenda</option>
                            <?php foreach ($kategoriagenda as $x): ?>
                            <?php if($x->id_kategoriagenda == $y->id_kategoriagenda){ ?>
                            <option selected value="<?= $x->id_kategoriagenda; ?>"><?= $x->nama_kategoriagenda; ?></option>
                            <?php }else{ ?>
                            <option value="<?= $x->id_kategoriagenda; ?>"><?= $x->nama_kategoriagenda; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Isi Agenda</label>
                    <div class="col-sm-10">
                        <textarea id="isi" name="isi"><?= $y->isi; ?></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="foto" accept=".jpg, .png, .jpeg">
                            <label class="custom-file-label" for="customFile">Upload Foto</label>
                            <a href="<?= base_url('assets/agenda/'.$y->gambar); ?>"><?= $y->gambar; ?></a>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_kelas" class="col-sm-2 col-form-label">Lampiran File</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFilee" name="file">
                            <label class="custom-file-label" for="customFile">Upload Lampiran File</label>
                            <?php if($y->file != "kosong"): ?>
                            <a href="<?= base_url('assets/agenda/'.$y->file); ?>"><?= $y->file; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                </div>
                <?php endforeach; ?>
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

    $('#EditAgenda').submit(function(e){
        e.preventDefault();

        if($('#isi').summernote('isEmpty')){

            swal('Isi Agenda Masih Kosong');

        }else{

            
            $.ajax({
                url : '<?= base_url('Admin/editagenda_action') ?>',
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