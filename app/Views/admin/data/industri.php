<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Industri</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Industri</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="card">
        <div class="card-header">
            Data Industri
            <a href="<?= base_url('admin/tambahindustri'); ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
        </div>

        <form id="HapusIndustri">
        <div class="card-body">
            <table class="table table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col"><input type="checkbox" id="parent"></th>
                        <th scope="col">Id Industri</th>
                        <th scope="col">Nama Industri</th>
                        <th scope="col">Bidang Kerja</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Kuota</th>
                        <th scope="col" style="width:10px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($industri as $x): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><input name="id[]" class="child" type="checkbox" value="<?= $x->id_industri; ?>"></td>
                        <td><?= $x->id_industri; ?></td>
                        <td><?= $x->nama_industri; ?></td>
                        <td><?= $x->bidang_kerja; ?></td>
                        <td><?= $x->telp; ?></td>
                        <td><?= $x->kuota; ?></td>
                        <td>
                            <center>
                                <a href="<?php echo base_url('admin/editindustri/'.$x->id_industri); ?>"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                                <a href="<?php echo base_url('admin/editindustri/'.$x->id_industri); ?>"><span class="badge badge-primary"><i class="fas fa-eye"></i></span></a>
                            </center>
                        </td>

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


<script>
    $('document').ready(function(){
        $(function () {
            bsCustomFileInput.init();
        });
        $('#loading').hide();

        $('#DataTable').DataTable({
            "responsive":true
        });

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

        $('#HapusIndustri').submit(function(e){
            e.preventDefault();
            
            var confirmed = confirm("Yakin Mau Menghapus Data Yang Ter-Checklist");

            if(confirmed){

                $.ajax({
                url : '<?= base_url('admin/hapusindustri_action'); ?>',
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

    });
</script>

<?= $this->endSection('content'); ?>