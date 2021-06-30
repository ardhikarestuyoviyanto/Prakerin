<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Setting Aspek Penilaian</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Setting Aspek Penilaian</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Setting Aspek Penilaian
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/aspek'); ?>" method="get">

            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Pilih Jurusan</label>
                <div class="col-sm-10">
                    <select class="form-control" aria-label="Default select example" required name="jurusan">
                        <option selected value="">- Tampilkan Aspek Penilaian Berdasarkan Jurusan -</option>
                        <?php foreach ($jurusan as $x): ?>
                        <?php if($x->id_jurusan == @$_GET['jurusan']){ ?>
                        <option value="<?= $x->id_jurusan; ?>" selected> - <?= $x->nama_jurusan; ?> - </option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_jurusan; ?>"> - <?= $x->nama_jurusan;?> - </option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
    
    </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>     
        </div>
    </form>
    
    <?php if(isset($_GET['jurusan'])): ?>

        <div class="card-body">
        <table class="table table-bordered" id="Table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aspek Penilaian</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $x->nama_aspek; ?></td>
                    <td>
                        <a data-id="<?= $x->id_aspek; ?>" href="#" class="hapus_aspek"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> 
                        <a data-id="<?= $x->id_aspek; ?>" href="#" class="edit_aspek"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>        
    </div>

    <div class="card-footer">
        <a href="#" data-toggle="modal" data-target="#tambahAspek" type="button" class="btn btn-primary btn-sm">Tambah Aspek</a>
    </div>

    <?php endif; ?>

    </div>


    </div>
</section>
</div>

<div class="modal fade" id="tambahAspek" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Aspek Penilaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Tambahaspek_Action" method="post">
            <div class="mb-3 row">
                <label for="tambah_jurusan" class="col-sm-2 col-form-label">Nama Aspek</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_aspek" placeholder="Aspek Yang Akan Dinilai" required>
                </div>
            </div>
        <input type="hidden" name="id_jurusan" value="<?= @$_GET['jurusan']; ?>">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editAspek" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Aspek Penilaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Editaspek_Action" method="post">
            <div class="mb-3 row">
                <label for="tambah_jurusan" class="col-sm-2 col-form-label">Nama Aspek</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_aspek" name="nama_aspek" placeholder="Aspek Yang Akan Dinilai" required>
                </div>
            </div>
        <input type="hidden" name="id_aspek" id="id_aspek" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
$('document').ready(function(){

    $('.hapus_aspek').click(function(e){
        e.preventDefault();

        var confirmed = confirm("Lanjutkan Proses Hapus ?");

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/HapusAspek')?>',
                data : {'id_aspek':$(this).data('id')},
                type : 'POST',
                success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                },
                error : function(err){
                    console.log(err);
                }
            });

        }

    });

    $('.edit_aspek').click(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?= base_url('admin/AspekByid'); ?>',
            type : 'POST',
            data : {'id_aspek':$(this).data('id')},
            success : function(data){
                var data = JSON.parse(data);
                for(let i = 0; i<data.length; i++){
                    $('#nama_aspek').val(data[i].nama_aspek);
                    $('#id_aspek').val(data[i].id_aspek);
                }
                $('#editAspek').modal('show');
            }
        });

    });

    $('#Editaspek_Action').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?= base_url('admin/editAspek');?>',
            type : 'POST',
            data : $(this).serialize(),
            success : function(e){
                swal(e)
                .then((result) => {
                    location.reload();
                });
            }
        })
    });

    $('#Tambahaspek_Action').submit(function(e){

        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/Tambahaspek_Action'); ?>',
            type : 'POST',
            data : $(this).serialize(),
            success : function(e){
                swal(e)
                .then((result) => {
                    location.reload();
                }).catch((err) => {
                    
                });
            }

        });

    });

});
</script>

<?= $this->endSection('content'); ?>