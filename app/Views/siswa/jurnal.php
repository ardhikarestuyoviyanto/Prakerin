<!DOCTYPE html>
<html lang="en">
    <?= $this->include('siswa/partisi/head.php'); ?>

    <body>
    <?= $this->include('siswa/partisi/navbar.php'); ?>
    <?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin(); ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Laporan Akhir</a>
                </nav>

            </nav>

            <div class="card bg-white">
                <div class="card-header">
                    <form action="<?= base_url('siswa/jurnal'); ?>" method="get">

                        <div class="row">
                            <div class="col">
                                <select name="industri" class="form-control form-control-sm" required>
                                    <option value="">Pilih Industri</option>
                                    <?php foreach($industri as $x): ?>
                                        <option <?php if($x->id_industri == @$_GET['industri']): ?> selected <?php endif; ?> value="<?= $x->id_industri; ?>"><?= $modell->getNamaIndustriByNama($x->id_industri); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col" style="margin-left:-20px;">
                                <button type="submit" class="btn btn-primary btn-sm">Lihat</button>
                            </div>
                        </div>


                    </form>
                </div>
                <?php if(isset($_GET['industri'])): ?>

                    <form id="SimpanJurnal">
                        <div class="card-header bg-white">
                            <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Tgl Sekarang</th>
                                    <td><?= date('d  M  Y');?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul</th>
                                    <td><input type="text" name="judul" id="judul" class="form-control form-control-sm" placeholder="Judul Laporan"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td><input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" placeholder="Keterangan"></td>
                                </tr>
                                <tr>
                                    <th scope="row">File Jurnal</th>
                                    <td><input type="file" class="form-control form-control-sm" name="jurnal" required id="exampleFormControlFile1"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="hidden" name="id_penempatan" value="<?= $modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']); ?>">
                                        <button type="submit" class="btn btn-primary btn-sm" style="float:right;">Kumpulkan</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </form>

                <div class="card-body">

                    <table class="table table-bordered dt-responsive nowrap" id="DataTable" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Tgl Kumpul</th>
                            <th>Status Approval</th>
                            <th>Aksi</th>
                            <th class="none">Catatan : </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $k=1; foreach($modell->getJurnalByIdPenempatan($modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']))->getResult() as $y): ?>
                            <tr>
                                <td><?= $k++; ?></td>
                                <td>
                                    <span class="badge badge-primary text-white"><a target="__BLANK" href="<?= base_url('assets/jurnal/'.$y->file); ?>" style="color:white;"><i class="fas fa-download fa-1x"></i></a></span>

                                </td>
                                <td><?= $y->judul; ?></td>
                                <td><?= $y->keterangan; ?></td>
                                <td><?= date('d-m-y  /  H:i:s', strtotime($y->tgl_kumpul)); ?></td>
                                <td>
                                    <?php if($y->status == "Y"): ?>
                                        Approval
                                    <?php elseif($y->status == "P"): ?>
                                        Pending
                                    <?php else: ?>
                                        Unapproval
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" data-id="<?= $y->id_jurnal; ?>" class="hapusjurnal"><span class="badge badge-danger">Hapus</span></a>
                                </td>
                                <td>
                                    <br>
                                    <?php if(empty($y->catatan)){echo "Belum Ada Catatan dari Pembimbing"; }else{echo $y->catatan; } ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            
                    <?php endif; ?>

                </div>
            </div>

        </div>
        <?= $this->include('siswa/partisi/js.php'); ?>
        <script>
            $(document).ready(function(){
                $('#DataTable').DataTable({
                    responsive: true
                });

                $('.hapusjurnal').click(function(e){
                    e.preventDefault();

                    var confirmed = confirm("Hapus Laporan ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('siswa/hapusjurnal_action'); ?>',
                            type : 'POST',
                            data : {'id':$(this).data('id')},
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

                $('#SimpanJurnal').submit(function(e){
                    e.preventDefault();

                    var confirmed = confirm("Kumpulkan Laporan ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('siswa/tambahjurnal_action'); ?>',
                            type : 'POST',
                            data : new FormData(this),
                            dataType : 'JSON',
                            contentType : false,
                            cache : false,
                            processData : false,
                            success : function(data){
                                swal(data)
                                .then((value) => {
                                    location.reload();
                                });
                                
                            }, 
                            error : function(data){
                                console.log(data);
                            }

                        });

                    }

                });



            });
        </script>
    </body> 
</html>
