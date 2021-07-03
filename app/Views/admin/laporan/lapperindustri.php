<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Data Penempatan Per Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Data Penempatan Per Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Data Penempatan Per Industri
        </div>
        <div class="card-header bg-gray-light">
            
            <form action="<?= base_url('admin/perindustri'); ?>" method="get">
                <div class="row">
                    <div class="col">
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
                        <a href="<?= base_url('admin/perindustri'); ?>" type="button" class="btn btn-primary btn-sm" style="margin-left:5px;">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <?php if(isset($_GET['industri'])): ?>
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
            <form action="<?= base_url('export/export_lapsiswa'); ?>" method="GET" target="_blank">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="type">
                            <option selected value="">- Pilih Type Export -</option>
                            <option value="pdf">- PDF -</option>
                            <option value="excel">- EXCEL -</option>
                        </select>
                    </div>
                    <input type="hidden" name="kelas" value="<?= @$_GET['kelas'] ?>">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm">Export</button>
                    </div>
                </div>
            </form>
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