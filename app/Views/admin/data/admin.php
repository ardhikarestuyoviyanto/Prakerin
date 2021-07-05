<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Admin</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Admin</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Data Admin
            <a href="<?= base_url('admin/tambahadmin'); ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Admin</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($admin as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $x->username; ?></td>
                        <td><?= $x->nama; ?></td>
                        <td>
                            <a onclick="return confirm('Yakin Mau Menghapus Data Ini ? ')" href="<?= base_url('admin/hapusadmin_action/'.$x->id); ?>"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a> 
                            <a href="<?= base_url('admin/editadmin/'.$x->id); ?>"><span class="badge badge-primary"><i class="fas fa-edit"></i></span></a>
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
    });
</script>

<?= $this->endSection('content'); ?>