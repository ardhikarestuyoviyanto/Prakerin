<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Kartu Penempatan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Kartu Penempatan</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Kartu Penempatan
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/kartu'); ?>" method="get">
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
                        <a href="<?= base_url('admin/kartu'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <?php if(isset($_GET['kelas'])): ?>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Cetak Kartu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($siswa as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->nis; ?></td>
                        <td><?= $x->nama_siswa; ?></td>
                        <td><?= $x->jenis_kelamin; ?></td>
                        <td><?= $x->nama_kelas; ?></td>
                        <td><?= $x->nama_jurusan; ?></td>
                        <td><a target="__BLANK" data-toggle="tooltip" data-placement="top" title="Cetak Kartu Penempatan" href="<?= base_url('export/export_kartu/'.$x->id_siswa); ?>" type="button" class="btn btn-primary btn-sm">Cetak Kartu Penempatan</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
        </div>
        <?php endif; ?>
    </div>

    </div>
</section>
</div>

<script>
$('document').ready(function(){

    $('#DataTable').DataTable({
        "responsive":true,
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

});
</script>

<?= $this->endSection('content'); ?>