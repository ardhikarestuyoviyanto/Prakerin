<!DOCTYPE html>
<html lang="en">
    <?= $this->include('siswa/partisi/head.php'); ?>

    <body>
    <?= $this->include('siswa/partisi/navbar.php'); ?>
    <?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin(); ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Presensi</a>
                </nav>

            </nav>

            <div class="card bg-white">
                <div class="card-header">
                    <form action="#" method="get">

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

                    <form id="SimpanAbsen">
                        <div class="card-header bg-white">
                            <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Tgl Sekarang</th>
                                    <td><?= date('d  M  Y');?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Absensi</th>
                                    <?php if(!empty($modell->getStatusAbsensi($modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']), date('Y-m-d')))): ?>
                                        <td><?= ucfirst($modell->getStatusAbsensi($modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']), date('Y-m-d'))); ?></td>
                                    <?php else: ?>
                                        <td>Belum Absen</td>
                                    <?php endif; ?>
                                </tr>
                                <?php if(empty($modell->getStatusAbsensi($modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']), date('Y-m-d')))): ?>
                                <tr>
                                    <th scope="row">Pilih Kehadiran</th>
                                    <td>
                                        <select class="form-control form-control-sm" aria-label="Default select example" required name="status">
                                            <option selected value="">- PILIH KEHADIRAN -</option>
                                            <option value="pending">- HADIR -</option>
                                            <option value="pending">- SAKIT - </option>
                                            <option value="pending">- IJIN -</option>
                                            <option value="pending">- ALFA - </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="hidden" name="tgl" value="<?=  date('Y-m-d'); ?>">
                                        <input type="hidden" name="id_penempatan" value="<?= $modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']); ?>">
                                        <button type="submit" class="btn btn-primary btn-sm" style="float:right;">Absen Sekarang</button>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </form>

                <div class="card-body">

                    <table class="table table-bordered table-hover" id="Absensi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $j=1; foreach($data as $x): ?>
                                <tr>
                                    <td><?= $j++; ?></td>
                                    <td scope="row"><?= date('d-M-Y', strtotime($x->tgl)); ?></td>
                                    <td>
                                        <?php if($x->status == "hadir"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "sakit"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "ijin"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($x->status == "alfa"){ ?>
                                        <i class="fas fa-check"></i>
                                        <?php } ?>
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
                $('#Absensi').DataTable({
                    responsive: true
                });

                $('#SimpanAbsen').submit(function(e){
                    e.preventDefault();
                    
                    var confirmed = confirm("Lanjutkan Proses Absensi ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('siswa/rekapabsensi'); ?>',
                            type : 'POST',
                            data : $(this).serialize(),
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


            });
        </script>
    </body> 
</html>
