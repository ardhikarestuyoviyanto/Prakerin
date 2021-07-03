<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Export Data Pembimbing</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Export Data Pembimbing</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Export Data Pembimbing
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Pembimbing</th>
                        <th scope="col">Membimbing Jurusan</th>
                        <th scope="col">Membimbing Industri</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($pembimbing as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->nip; ?></td>
                        <td><?= $x->nama_pembimbing; ?></td>
                        <td><?= $x->nama_jurusan; ?></td>
                        <td><?= $x->nama_industri; ?></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <form action="<?= base_url('export/export_lappembimbing'); ?>" method="GET" target="_blank">
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
        </div>
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