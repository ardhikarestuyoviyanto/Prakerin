<!DOCTYPE html>
<html lang="en">
    <?= $this->include('siswa/partisi/head.php'); ?>

    <body>
    <?= $this->include('siswa/partisi/navbar.php'); ?>
    <?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin(); ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Jurnal Harian</a>
                </nav>

            </nav>

            <div class="card bg-white">
                <div class="card-header">
                    <form action="<?= base_url('siswa/jurnalharian'); ?>" method="get">

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

                    <div class="card-header bg-white">
                        <?php if($cekjurnal != 1): ?>
                            <form id="SimpanJurnal">
                                <input type="hidden" name="id_penempatan" value="<?= $modell->getIdPenempatanByidSiswa($_SESSION['id_siswa']); ?>">
                                <table class="table table-bordered" id="tbl_posts">
                                    <tbody id="tbl_posts_body">
                                        <tr id="rec-1">
                                            <td><span class="sn"><input type="text" name="kegiatan[]" placeholder="Tuliskan Kegiatan Anda..." required class="form-control"></span></td>
                                            <td style="width:50px;"><a class="btn btn-sm delete-record btn-danger text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary btn-sm" style="float:right;">Simpan</button>
                                <a href="#" id="tambah" type="button" class="btn btn-success btn-sm pull-right add-record" data-added="0" style="float:right; margin-right:5px;"><i class="fas fa-plus fa-1x"></i></a>

                            </form>
                        <?php else : ?>
                            Hari Ini Anda Sudah Mengisi Jurnal Harian
                        <?php endif; ?>
                    </div>

                <div style="display:none;">
                    <table id="sample_table">
                        <tr id="">
                            <td><span class="sn"><input type="text" name="kegiatan[]" placeholder="Tuliskan Kegiatan Anda..." required class="form-control"></span></td>
                            <td style="width:50px;"><a class="btn btn-sm delete-record btn-danger text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-trash fa-sm"></i></a></td>
                        </tr>
                </table>
                </div>

                <div class="card-body">

                    <table class="table table-bordered dt-responsive nowrap" id="DataTable" style="width:100%">
                        <thead>
                        <tr>
                            <th class="all" width="10">No</th>
                            <th class="all">Tanggal</th>
                            <th class="all">Status Approval</th>
                            <th width="10">Aksi</th>
                            <th class="none">Kegiatan : </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($data as $x): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= date('d-M-Y', strtotime($x->tgl)); ?></td>
                                <td>
                                    <?php if($x->status == "Y"): ?>
                                        Approval
                                    <?php elseif($x->status == "P"): ?>
                                        Pending
                                    <?php else: ?>
                                        Unapproval
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="hapusjunal" data-id="<?= $x->id_jurnal_harian; ?>"><span class="badge badge-danger">Hapus</span></a>
                                </td>
                                <td>
                                    <br>
                                    <?php
                                        $arr = explode(",", $x->kegiatan);
                                        foreach($arr as $x):
                                            echo $x."<br>";
                                        endforeach;
                                    ?>
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

                jQuery(document).delegate('a.add-record', 'click', function(e) {
                    e.preventDefault();    
                    var content = jQuery('#sample_table tr'),
                    size = jQuery('#tbl_posts >tbody >tr').length + 1,
                    element = null,    
                    element = content.clone();
                    element.attr('id', 'rec-'+size);
                    element.find('.delete-record').attr('data-id', size);
                    element.appendTo('#tbl_posts_body');
                    element.find('.sn');
                });

                jQuery(document).delegate('a.delete-record', 'click', function(e) {
                    e.preventDefault();    
                    var didConfirm = confirm("Yakin Mau Menghapus ?");
                    if (didConfirm == true) {
                        var id = jQuery(this).attr('data-id');
                        var targetDiv = jQuery(this).attr('targetDiv');
                        jQuery('#rec-' + id).remove();
                        
                        //regnerate index number on table
                        $('#tbl_posts_body tr').each(function(index) {
                        //alert(index);
                        $(this).find('span.sn');
                        });
                        return true;
                    } else {
                        return false;
                    }
                });

                $('#SimpanJurnal').submit(function(e){
                    e.preventDefault();

                    var confirmed = confirm("Kumpulkan Jurnal Harian ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('siswa/tambahjurnalharian'); ?>',
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

                $('.hapusjunal').click(function(e){
                    e.preventDefault();

                    var confirmed = confirm("Hapus Jurnal Harian ?");

                    if(confirmed){

                        $.ajax({
                            url : '<?= base_url('siswa/hapusjurnalharian'); ?>',
                            type : 'POST',
                            data : {'id': $(this).data('id')},
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
