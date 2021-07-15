<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Guru Pembimbing</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Guru Pembimbing</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Data Guru Pembimbing
        <a href="<?= base_url('admin/tambahpembimbing'); ?>" type="button" class="btn btn-primary btn-sm" style="float:right;">Tambah</a>
        <a href="#" data-toggle="modal" data-target="#modal-default" type="button" class="btn btn-success btn-sm" style="float:right; margin-right: 5px;">Import</a>
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/pembimbing'); ?>" method="get">
            <div class="row">

                <div class="col-3">
                    <select class="form-control form-control-sm" aria-label="Default select example" required name="industri">
                        <option selected value="">- Pilih Industri -</option>
                        <?php foreach ($industri as $x): ?>
                        <?php if($x->id_industri == @$_GET['industri']){ ?>
                        <option value="<?= $x->id_industri; ?>" selected><?= $x->nama_industri; ?></option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_industri; ?>"><?= $x->nama_industri; ?></option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-success btn-sm">Filter</button>
                    <a href="<?= base_url('admin/pembimbing'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <form id="HapusGuru">
        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col" width="10">No</th>
                        <th scope="col" width="10"><input type="checkbox" id="parent"></th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Pembimbing</th>
                        <th scope="col">Tipe Pembimbing</th>
                        <th scope="col">NoHp</th>
                        <th scope="col">Industri</th>
                        <th scope="col" style="width:10px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($pembimbing as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><input name="id[]" class="child" type="checkbox" value="<?= $x->id_pembimbing; ?>"></td>
                        <td><?= $x->nip; ?></td>
                        <td><?= $x->nama_pembimbing; ?></td>
                        <td>
                            <?php if($x->type == "I"): ?>
                                INDUSTRI
                            <?php else : ?>
                                SEKOLAH
                            <?php endif; ?>
                        </td>
                        <td><?= $x->nohp; ?></td>
                        <td><?= $x->nama_industri; ?></td>
                        <td><center><a href="<?php echo base_url('admin/editpembimbing/'.$x->id_pembimbing); ?>"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>

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
            <small><a href="<?= base_url('assets/file/import_pembimbing.xlsx'); ?>">Templeate Import</a></small>
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
    $('#DataTable').DataTable();
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

    $('#HapusGuru').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Yakin Mau Menghapus Data Yang Ter-Checklist");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/deletepembimbing_action'); ?>',
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
            url : '<?= base_url('Admin/importpembimbing') ?>',
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