<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Siswa</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Siswa</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Data Siswa
            <a href="<?= base_url('admin/tambahsiswa'); ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
            <a href="#" type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-success btn-sm" style="float: right; margin-right:5px;">Import</a>
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/siswa'); ?>" method="get">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="kelas">
                            <option selected value="">- Pilih Kelas / Jurusan -</option>
                            <?php foreach ($kelas as $x): ?>
                            <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                            <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                            <?php }else{ ?>
                            <option value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Filter</button>
                        <a href="<?= base_url('admin/siswa'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <form id="HapusSiswa">
        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"><input type="checkbox" id="parent"></th>
                        <th scope="col">NIS</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col" style="width:10px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($siswa as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><input name="id[]" class="child" type="checkbox" value="<?= $x->id_siswa; ?>"></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->username; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $x->nama_kelas; ?></td>
                        <td><?= $x->nama_jurusan; ?></td>
                        <td><center><a href="<?php echo base_url('admin/editsiswa/'.$x->id_siswa); ?>"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </div>
        </form>
    </div>

    </div>
</section>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Excel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="excel" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="excel" required accept=".xls, .xlsx">
              <label class="custom-file-label" for="customFile">Klik disini</label>
            </div>
            <small><a href="<?= base_url('assets/file/import_siswa.xlsx'); ?>">Templeate Import</a></small>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" disabled id="loading">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submit">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<script>
    $('document').ready(function(){
        $(function () {
            bsCustomFileInput.init();
        });
        $('#loading').hide();

        $('#DataTable').DataTable({
            "responsive":true
        });

        $('#parent').click(function(){
            $('.child').prop('checked', this.checked);
        });

        $('.child').click(function() {
            if ($('.child:checked').length == $('.child').length) {
                $('#parent').prop('checked', true);
            } else {
                $('#parent').prop('checked', false);
            }
        });

        $('#HapusSiswa').submit(function(e){
            e.preventDefault();
            
            var confirmed = confirm("Yakin Mau Menghapus Data Yang Ter-Checklist");

            if(confirmed){

                $.ajax({
                url : '<?= base_url('admin/hapussiswa_action'); ?>',
                type : 'POST',
                data : $(this).serialize(),
                success : function(data){
                    swal(data)
                    .then((result) => {
                        location.reload();
                    });
                },
                error : function(err){
                    alert(err);
                }
            });

            }

        });

        $('#excel').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?= base_url('Admin/importsiswa') ?>',
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
        });


    });
</script>

<?= $this->endSection('content'); ?>