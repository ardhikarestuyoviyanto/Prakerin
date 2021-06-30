<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Agenda</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Agenda</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Data Agenda
                <a href="<?= base_url('admin/tambahagenda'); ?>" type="button" class="btn btn-primary btn-sm" style="float:right">Tambah Agenda</a>
            </div>  

            <div class="card-body">
                <table class="table table-bordered" id="DataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Agenda</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tgl Posting</th>
                            <th scope="col">Dilihat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $x->judul; ?></td>
                            <td><?= date('d - m - Y / H : i : s', strtotime($x->tgl)); ?></td>
                            <td><?= $x->nama_kategoriagenda; ?></td>
                            <td><?= $x->dilihat; ?></td>
                            <td>
                                <a class="hapusagenda" data-id="<?= $x->id_agenda; ?>" href="#"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> 
                                <a href="<?= base_url('admin/editagenda/'.$x->id_agenda); ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a>
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


<script>
$('document').ready(function(){
    $('#DataTable').DataTable();

    $('.hapusagenda').click(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Lanjutkan Proses Hapus ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/hapusagenda_action'); ?>',
            type : 'POST',
            data : {'id':$(this).data('id')},
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

});
</script>

<?= $this->endSection('content'); ?>