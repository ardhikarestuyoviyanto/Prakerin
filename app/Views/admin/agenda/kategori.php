<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Kategori Agenda</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Kategori Agenda</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Data Kategori Agenda
                <a href="#" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahagenda" style="float:right">Tambah Kategori Agenda</a>
            </div>  

            <div class="card-body">
                <table class="table table-bordered" id="DataTable">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori Agenda</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($agenda as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $x->nama_kategoriagenda; ?></td>
                            <td>
                                <a href="#" data-id="<?= $x->id_kategoriagenda; ?>" class="hapusagenda"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> 
                                <a href="#" data-id="<?= $x->id_kategoriagenda; ?>" data-toggle="modal" class="editagenda"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahagenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Agenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="TambahAgenda">

            <div class="mb-3 row">
            <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_kategoriagenda" placeholder="Nama Kategori Agenda" required value="">
            </div>
        </div>                          

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editagenda_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Agenda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="EditAgenda">

            <div class="mb-3 row">
            <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_kategoriagenda" name="nama_kategoriagenda" placeholder="Nama Kategori Agenda" required value="">
            </div>
            <input type="hidden" name="id_kategoriagenda" value="" id="id_kategoriagenda">
        </div>                          

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
$('document').ready(function(){
    $('#DataTable').DataTable();

    $('#TambahAgenda').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/tambahKategoriAgenda_action'); ?>',
            data : $(this).serialize(),
            type : 'POST',
            success : function(data){
                swal(data)
                .then((result) => {
                   location.reload(); 
                });

            }
        });
    });

    $('.editagenda').click(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/getKategoriAgenda'); ?>',
            type : 'POST',
            data : {'id_kategoriagenda':$(this).data('id')},
            success : function(data){
                var val = JSON.parse(data);
                for(let i=0; i<val.length; i++){
                    $('#nama_kategoriagenda').val(val[i].nama_kategoriagenda);
                    $('#id_kategoriagenda').val(val[i].id_kategoriagenda);
                }
                $('#editagenda_modal').modal('show');
            }
        });
    });

    $('#EditAgenda').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/updateKategoriAnggota_action'); ?>',
            type : 'POST',
            data : $(this).serialize(),
            success : function(data){
                swal(data)
                .then((result) => {
                    location.reload(); 
                });
            }
        })
    });

    $('.hapusagenda').click(function(e){
        e.preventDefault();

        var confirmed = confirm("Lanjutkan Proses Hapus ?");

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/hapusKategoriAgenda_action')?>',
                data : {'id_kategoriagenda':$(this).data('id')},
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

});
</script>

<?= $this->endSection('content'); ?>