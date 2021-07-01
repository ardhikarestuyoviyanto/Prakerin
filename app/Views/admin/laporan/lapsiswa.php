<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Data Siswa</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Data Siswa</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Data Siswa
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/lapsiswa'); ?>" method="get">
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
        <?php if(isset($_GET['kelas'])): ?>
        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>

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
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <form action="#" method="post">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="type">
                            <option selected value="">- Pilih Type Export -</option>
                            <option value="pdf">- PDF -</option>
                            <option value="excel">- EXCEL -</option>
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                    </div>
                </div>
            </form>
            <!-- <button type="submit" class="btn btn-danger btn-sm">Excel</button> -->
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
        "paginate": false,
        "info": false
    });

});
</script>

<?= $this->endSection('content'); ?>