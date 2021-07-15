<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Data Industri
            <a href="<?= base_url('admin/tambahindustri'); ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
            <a href="#" data-toggle="modal" data-target="#modal-default" type="button" class="btn btn-success btn-sm" style="float:right; margin-right: 5px;">Import</a>
        </div>

        <form id="HapusIndustri">
        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col" width="10">No</th>
                        <th scope="col" width="15"><input type="checkbox" id="parent"></th>
                        <th scope="col">Id Industri</th>
                        <th scope="col">Nama Industri</th>
                        <th scope="col">Bidang Kerja</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kuota</th>
                        <th scope="col" style="width:10px;">Action</th>
                        <th scope="col" class="none">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($industri as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><input name="id[]" class="child" type="checkbox" value="<?= $x->id_industri; ?>"></td>
                        <td><?= $x->id_industri; ?></td>
                        <td><?= $x->nama_industri; ?></td>
                        <td><?= $x->bidang_kerja; ?></td>
                        <td><?= $x->telp; ?></td>
                        <td><?= $x->email; ?></td>
                        <td><?= $x->kuota; ?></td>
                        <td>
                            <center>
                                <a href="<?php echo base_url('admin/editindustri/'.$x->id_industri); ?>"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                <a target="__BLANK" href="<?php echo base_url('industri/'.$x->slug); ?>"><span class="badge badge-primary"><i class="fas fa-eye"></i></span></a>
                            </center>
                        </td>
                        <td>
                            <br>
                            <?= $x->alamat_industri; ?>
                        </td>
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
            <small><a href="<?= base_url('assets/file/import_industri.xlsx'); ?>">Templeate Import</a></small>
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

        $('#HapusIndustri').submit(function(e){
            e.preventDefault();
            
            var confirmed = confirm("Yakin Mau Menghapus Data Yang Ter-Checklist");

            if(confirmed){

                $.ajax({
                url : '<?= base_url('admin/hapusindustri_action'); ?>',
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
                url : '<?= base_url('Admin/importindustri') ?>',
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