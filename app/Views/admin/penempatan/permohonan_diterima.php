<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Permohonan Siswa</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/penmanual'); ?>">Atur Penempatan</a></li>
            <li class="breadcrumb-item">Permohonan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a href="<?= base_url('admin/penmohon'); ?>" type="button" class="btn btn-outline-primary">Baru</a>
                <a href="<?= base_url('admin/penmohon?type=diterima'); ?>" type="button" class="btn btn-primary">Diterima</a>
                <a href="<?= base_url('admin/penmohon?type=ditolak'); ?>" type="button" class="btn btn-outline-primary">Ditolak</a>
            </div>
        </div>

        <div class="card-header bg-gray-light">
            <form action="<?= base_url('admin/penmohon') ?>" method="get">
            <input type="hidden" name="type" value="diterima">
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
                        <a href="<?= base_url('admin/penmohon?type=diterima'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="Permohonan">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Industri Pilihan</th>
                        <th scope="col">Surat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($data as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $x->nama_jurusan; ?></td>
                        <td><?= $x->nama_kelas; ?></td>
                        <td><?= $x->nama_industri; ?></td>
                        <td>
                            <a target="__BLANK" href="<?= base_url('assets/surat/'.$x->surat); ?>">
                                <span class="badge badge-success">Download</span>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/detmohon/'.$x->id_penempatan); ?>"><span class="badge badge-primary">Lihat Detail</span></a>
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
    $('#Permohonan').DataTable();
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

});
</script>

<?= $this->endSection('content'); ?>