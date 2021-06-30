<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Penempatan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Penempatan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Data Penempatan Seluruh Siswa
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/pendata'); ?>" method="get">
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

                <div class="col-3">
                    <select class="form-control form-control-sm" aria-label="Default select example" required name="kelas">
                        <option selected value="">- Pilih Kelas -</option>
                        <?php foreach ($kelas as $x): ?>
                        <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                        <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_kelas; ?>"><?=  $x->nama_kelas." / ".$x->nama_jurusan;?></option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-success btn-sm">Filter</button>
                    <a href="<?= base_url('admin/pendata'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                </div>
            </div>
        </form>
    </div>

        <?php if(isset($_GET['industri']) && isset($_GET['kelas'])): ?>
        <form id="BatalPenempatan">
            <div class="card-body">
                <table class="table table-bordered" id="Permohonan">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col"><input type="checkbox" id="parent"></th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Industri</th>
                            <th scope="col">Jalur Penempatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><input name="id_penempatan[]" class="child" type="checkbox" value="<?= $x->id_penempatan; ?>"></td>
                            <td><?= $x->nis; ?></td>
                            <td><?= $x->nama_siswa; ?></td>
                            <td><?= $x->nama_kelas; ?></td>
                            <td><?= $x->nama_industri; ?></td>
                            <td>
                                <?php if($x->surat == "kosong"){ ?>
                                    <span class="badge badge-primary">Manual</span>
                                <?php }else{ ?>
                                    <span class="badge badge-success">Permohonan</span>
                                <?php } ?>
                            </td>
                            <td><?= ucfirst($x->status); ?></td>
                            
                            <td>
                                <a href="<?= base_url('admin/detmohon/'.$x->id_penempatan); ?>"><span class="badge badge-primary">Lihat Detail</span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-danger btn-sm">Batalkan Penempatan</button>
            </div>

        </form>
        <?php endif; ?>

    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){
    $('#Permohonan').DataTable({
        responsive : true
    });
    $('[data-toggle="tooltip"]').tooltip();
    
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
    
    $('#BatalPenempatan').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Batalkan Penempatan Yang Anda Checklist ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/hapuspermohonan'); ?>',
            type : 'POST',
            data : $(this).serialize(),
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