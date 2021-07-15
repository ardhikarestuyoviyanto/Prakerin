<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Tambah Guru Pembimbing</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pembimbing'); ?>">Guru Pembimbing</a></li>
            <li class="breadcrumb-item active">Tambah Pembimbing</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                Tambah Pembimbing
            </div>

            <div class="card-body">
                <form id="TambahPembimbing">

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" placeholder="NIP" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pembimbing" placeholder="Nama Pembimbing" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nohp" placeholder="Nomor HP" required >
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="radio" class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio1" name="type" value="I">
                          <label for="customRadio1" class="custom-control-label text-black" style="font-weight:normal;">Pembimbing Industri</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="type" value="S">
                          <label for="customRadio2" class="custom-control-label" style="font-weight:normal;">Pembimbing Sekolah</label>
                        </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Pilih Industri</label>
                        <div class="col-sm-10">
                            <select class="form-control select2bs4" id="industri" name="id_industri" style="width: 100%;" required>
                                <option value="">Pilih Industri Yang Akan dibimbing oleh guru ini</option>
                                <?php foreach ($industri as $x): ?>
                                <option value="<?= $x->id_industri; ?>"><?= $x->nama_industri; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_kelas" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
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
    
    $('#industri').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Industri Yang Akan dibimbing oleh guru ini",
        placeholder: "Pilih Industri Yang Akan dibimbing oleh guru ini",
        allowClear: true
    });

    $('#jurusan').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jurusan Yang Akan dibimbing oleh guru ini",
        placeholder: "Pilih Jurusan Yang Akan dibimbing oleh guru ini",
        allowClear: true
    });


    $('#TambahPembimbing').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/tambahpembimbing_action') ?>',
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

});
</script>

<?= $this->endSection('content'); ?>