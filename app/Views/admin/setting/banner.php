<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Banner dan Logo</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Banner dan Logo</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Banner dan Logo
    </div>

        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">Keterangan</th>
                        <th scope="col">File Banner</th>
                        <th scope="col" style="width:10px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($banner as $x): ?>
                    <tr>
                        <td><?= $x->judul; ?></td>
                        <td><a href="<?= base_url('assets/banner/'.$x->file) ?>"><?= $x->file; ?></a></td>
                        <td><center><a class="banner" data-toggle="modal" href="#" data-id_banner="<?= $x->id; ?>"data-judul_banner="<?= $x->judul; ?>" data-target="#modal-banner"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php foreach ($logo as $x):  ?>
                    <tr>
                        <td>Logo Kanan</td>
                        <td><a href="<?= base_url('dist/img/'.$x->logo_kanan) ?>"><?= $x->logo_kanan; ?></a></td>
                        <td><center><a class="logo" data-type="Logo Kanan" data-toggle="modal" data-target=".modal-logo" href="#"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>
                    </tr>
                    <tr>
                        <td>Logo Kiri</td>
                        <td><a href="<?= base_url('dist/img/'.$x->logo_kiri) ?>"><?= $x->logo_kiri; ?></a></td>
                        <td><center><a class="logo" data-toggle="modal" data-type="Logo Kiri" data-target=".modal-logo" href="#"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a></center></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
        </div>
    </div>


    </div>
</section>
</div>

<div class="modal fade" id="modal-banner">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="FormBanner">
        <div class="modal-body">
            <div class="form-group">
            <input type="text" name="judul" class="form-control" id="judul_banner" placeholder="Judul Banner" required>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="banner" accept=".png, .PNG, .jpg, .JPEG, .JPG">
              <label class="custom-file-label" for="customFile">Klik disini</label>
            </div>
            <input type="hidden" name="id" id="id_banner">
            <small><i>Rekomendasi ukuran 1080 x 674</i></small>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" disabled id="loading">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submit">Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade modal-logo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title typelogo"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="FormLogo" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFiles" name="file" required accept=".png, .PNG, .jpg, .JPEG, .JPG">
              <label class="custom-file-label" for="customFiles">Klik disini</label>
            </div>
            <input type="hidden" name="typelogo" id="typelogo">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" disabled id="loadings">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submits">Edit</button>
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
    $('#loadings').hide();

    $('.banner').on('click', function(){
        $('#judul_banner').val($(this).data('judul_banner'));
        $('#id_banner').val($(this).data('id_banner'));
        $('#modal-banner').show();
    });

    $('.logo').on('click', function(){
        $('#typelogo').val($(this).data('type'));
        $('.typelogo').text($(this).data('type'));
    });

    $('#FormBanner').submit(function(e){
      e.preventDefault();
        $.ajax({
          url : '<?= base_url('Admin/editbanner') ?>',
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

    $('#FormLogo').submit(function(e){
      e.preventDefault();
        $.ajax({
          url : '<?= base_url('Admin/editlogo') ?>',
          type : 'POST',
          data : new FormData(this),
          dataType : 'JSON',
          contentType : false,
          cache : false,
          processData : false,
          beforeSend : function(){
              $('#loadings').show();
              $('#submits').hide();
          },
          complete : function(){
              $('#loadings').hide();
              $('#submits').show();
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