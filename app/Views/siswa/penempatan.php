<!DOCTYPE html>
<html lang="en">
    <?= $this->include('siswa/partisi/head.php'); ?>
    <style>
    .disabled {
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
    }
    </style>
    <body>
    <?= $this->include('siswa/partisi/navbar.php'); ?>
    <?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin(); ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Penempatan</a>
                </nav>

            </nav>

            <div class="card">
                <div class="card-header">
                    Penempatan
                    <a href="#" <?php if(!empty($industri)): ?> class="disabled btn btn-primary btn-sm" <?php endif; ?> data-toggle="modal" data-target="#pengajuan" type="button" class="btn btn-primary btn-sm" style="float: right;">Ajukan Permohonan</a>
                </div>
                <?php if(empty($industri)): ?>
                    <div class="card-body">
                        <p class="card-text">Anda Belum Terdaftar pada industri manapun, silahkan hubungi admin atau anda dapat mengajukan  permohonan sendiri melalui surat permohonan.</p>
                    </div>
                <?php else : ?>
                <div class="card-body">

                    <table class="table table-striped">
                        <tbody>
                            <?php foreach($industri as $x): ?>
                            <tr>
                                <th scope="row">Industri Pilihan</th>
                                <td><?= $x->nama_industri; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status Penempatan</th>
                                <?php if($x->status == 'diterima'): ?>
                                    <td class="text-success"><?= ucfirst($x->status); ?></td>
                                <?php else: ?>
                                    <td class="text-danger"><?= ucfirst($x->status); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th scope="row">Tipe Penempatan</th>
                                <?php if($x->surat == "kosong"){ ?>
                                    <td>DITEMPATKAN MANUAL</td>
                                <?php }else{ ?>
                                    <td>SURAT PERMOHONAN</td>
                                <?php } ?>
                            </tr>
                            

                            <?php if($x->surat != "kosong"): ?>
                            <tr>
                                <th scope="row">Surat Permohonan</th>
                                <td><a href="<?= base_url('assets/surat/'.$x->surat); ?>"><?= $x->surat; ?></a></td>
                            </tr>
                            <?php endif; ?>

                            <?php if($x->status == "ditolak"): ?>
                            <tr>
                                <th scope="row">Alasan Penolakan</th>
                                <td><?= $modell->getAlasanPenolakan($x->id_penempatan); ?></td>
                            </tr>
                            <?php endif; ?>

                            <th scope="row">Guru Pembimbing</th>
                                    <td>
                                        <?php $i=1; foreach($modell->getguruByidIndustri($x->id_industri)->getResult() as $y): ?>
                                            <?php if($i == 1): ?>
                                            <?= $y->nama_pembimbing." ($y->nohp)"; ?>
                                            <?php endif; ?>
                                        <?php $i++; endforeach; ?>
                                    </td>
                                </tr>

                                <?php $k=1; foreach($modell->getguruByidIndustri($x->id_industri)->getResult()as $y): ?>
                                <?php if(count($modell->getguruByidIndustri($x->id_industri)->getResult()) > 1 && $k > 1): ?>
                                <tr>
                                    <td></td>
                                    <td><?= $y->nama_pembimbing." ($y->nohp)"; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php $k++; endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <?php if($x->surat != "kosong" && $x->status == "ditolak" || $x->status == "pending"): ?>
                    <form id="BatalPermohonan">
                        <input type="hidden" name="id_penempatan[]" value="<?= $x->id_penempatan; ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Batalkan Permohonan</button>
                    </form>
                    <?php else: ?>
                        Anda sudah dinyatakan diterima di industri yang dipilih, jika ingin melakukan perubahan hubungi admin
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>


                <?php endif; ?>
            </div>

        <!-- Modal -->
        <div class="modal fade" id="pengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajukan Permohonan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="TambahPermohonan">
                        <input type="hidden" name="id_siswa" value="<?= $id_siswa; ?>">
                        <div class="form-group">
                            <label for="">Industri Tujuan</label>
                            <select name="id_industri" class="form-control" required>
                                <option value="">Pilih Industri Tujuan</option>
                                <?php foreach($data_industri as $x): ?>
                                <option value="<?= $x->id_industri; ?>"><?= $x->nama_industri; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleFormControlFile1">Surat Permohonan</label>
                            <input type="file" class="form-control" name="surat" required id="exampleFormControlFile1">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit">
                        Simpan
                    </button>

                    <button class="btn btn-primary" disabled id="loading">
                        <span class="spinner-border spinner-border-sm"></span>
                        Loading..
                    </button>
                </div>
                </form>
                </div>
            </div>
        </div>

        </div>
        <?= $this->include('siswa/partisi/js.php'); ?>
        <script>
            $(document).ready(function(){
                $('#loading').hide();

                $('#BatalPermohonan').submit(function(e){
                    e.preventDefault();

                    var confirmed = confirm("Lanjutkan Proses Pembatalan Permohonan ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('admin/hapuspermohonan'); ?>',
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

                $('#TambahPermohonan').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url : '<?= base_url('siswa/tambahpenempatan_action'); ?>',
                        type : 'POST',
                        data : new FormData(this),
                        dataType : 'JSON',
                        contentType : false,
                        cache : false,
                        processData : false,
                        beforeSend : function(){
                            $('#loading').show();
                            $('#submit').hide();
                        },
                        complete : function(){
                            $('#loading').hide();
                            $('#submit').show();
                        },
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

                });
            
            });
        </script>
    </body> 
</html>
