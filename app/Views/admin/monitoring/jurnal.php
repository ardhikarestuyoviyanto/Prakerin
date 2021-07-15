<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Laporan Akhir</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Laporan Akhir</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
        Laporan Akhir
    </div>

    <div class="card-header bg-gray-light">
        <form action="<?= base_url('admin/jurnal'); ?>" method="get">
            <div class="mb-3 row">
                <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Industri</label>
                <div class="col-sm-10">
                    <select class="form-control" aria-label="Default select example" required name="industri">
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
            </div>
    </div>
        <div class="card-header bg-light" >
            <button type="submit" class="btn btn-primary" style="float: right;">Lihat</button>     
        </div>
    </form>
    
    <?php if(isset($_GET['industri'])): ?>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Pending</th>
                    <th scope="col">Unapproval</th>
                    <th scope="col">Approval</th>
                    <th scope="col">Total Laporan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($data as $x): ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td  data-toggle="collapse" id="table1" data-target=".table<?php echo $i; ?>"><a type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i></a></td>
                    <td><?= $x->nis; ?></td>
                    <td><?= $x->nama_siswa; ?></td>
                    <td><?= $modell->getNamaKelas($x->id_kelas); ?></td>
                    <td class="text-primary text-bold"><?= $modell->getTotalStatusJurnalPending($x->id_penempatan); ?></td>
                    <td class="text-red text-bold"><?= $modell->getTotalStatusJurnalUnapproval($x->id_penempatan); ?></td>
                    <td class="text-success text-bold"><?= $modell->getTotalStatusJurnalApproval($x->id_penempatan); ?></td>
                    <td class="text-bold">
                        <?= $modell->getTotalJurnalByIdPenempatan($x->id_penempatan); ?>
                    </td>
                </tr>

                <tr class="collapse table<?php echo $i; ?>">
                    <td colspan="999">
                        <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Tgl Kumpul</th>
                                <th scope="col">Status Approval</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $k=1; foreach($modell->getJurnalByIdPenempatan($x->id_penempatan)->getResult() as $y): ?>
                                <tr>
                                    <th scope="row"><?= $k++; ?></th>
                                    <td  data-toggle="collapse" id="table2" data-target=".table2<?php echo $k; ?>">
                                        <a target="__BLANK" class="btn btn-success btn-xs text-white" type="button" href="<?= base_url('assets/jurnal/'.$y->file); ?>"><i class="fas fa-file-download"></i></a>&#160;
                                        <a href="#" class="btn btn-secondary btn-xs text-white" type="button"><i class="fas fa-plus"></i></a>
                                    </td>
                                    <td><?= $y->judul; ?></td>
                                    <td><?= $y->keterangan; ?></td>
                                    <td><?= date('d-m-y  /  H:i:s', strtotime($y->tgl_kumpul)); ?></td>
                                    <td>
                                        <select class="form-control form-control-sm status" aria-label="Default select example" required name="status">
                                            <option value="">- Pilih Status Approval -</option>
                                            <option value="Y" <?php if($y->status == "Y"): ?> selected <?php endif; ?>>- Approval -</option>
                                            <option value="N" <?php if($y->status == "N"): ?> selected <?php endif; ?> >- Unapproval -</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" data-id="<?= $y->id_jurnal; ?>" class="savestatus"><span class="badge badge-primary">Update Status</span></a>
                                    </td>
                                </tr>
                                
                                <tr class="collapse table2<?php echo $k; ?>">
                                    <td colspan="999">
                                        <div>
                                        <?php if(empty($y->catatan)){echo "Belum ada Catatan"; }else{echo "<b>Catatan : </b>".$y->catatan;} ?>
                                        </div>
                                    </td>

                                </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){

    //get nilai on change ketika user meng-inputkan nilai
    //lalu di append kan nilai tersebut atribut data-nilai pada link

    $('.status').on('change', function(){
        var value = $(this).val();
        $('.savestatus').attr('data-status', value);
    });


    $('#DataTable').DataTable({
    });

    $('.savestatus').click(function(e){
        e.preventDefault();

        swal("Tambahkan Catatan Untuk Siswa:", {
            content:"input"
        })
        .then((value)=>{

            var status = $(this).data('status');
            var id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('admin/UpdateStatusJurnal'); ?>',
                data: {'id':id, 'status':status, 'catatan':value},
                type: 'POST',
                success: function(data){
                    swal(data);
                },
                error: function(error){
                    alert('Server Error');
                }
            });

        });

    });


});
</script>

<?= $this->endSection('content'); ?>