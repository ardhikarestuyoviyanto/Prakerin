<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Input Nilai Per Siswa</h1>
        </div>
        <div class="col-sm-6">
        <?php foreach($data_siswa as $x): ?>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/penilaian?industri='.$id_industri.'&kelas='.$id_kelas); ?>">Penilaian</a></li>
            <li class="breadcrumb-item"><?= $x->nama_siswa; ?></li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card mb-5">
            <div class="card-header">
                Data Siswa
                <a href="#" data-toggle="modal" data-target="#kehadiran" type="button" class="btn btn-success btn-sm" style="float:right;">Lihat Kehadiran</a>
            </div>  

            <div class="card-header bg-gray-light">
                <table width="100%">
                  <tbody>
                    <tr>
                      <td class="text-bold">Nama Industri</td>
                      <td class="text-bold">:</td>
                      <td><?= $x->nama_industri; ?></td>
                    </tr>
                    <tr>
                      <td class="text-bold" width="200px">NIS </td>
                      <td class="text-bold" width="10px">:</td>
                      <td><?= $x->nis; ?></td>
                    </tr>
                    <tr>
                      <td class="text-bold" width="200px">Nama Siswa</td>
                      <td class="text-bold" width="10px">:</td>
                      <td><?= $x->nama_siswa; ?></td>
                    </tr>
                    <tr>
                      <td class="text-bold">Kelas</td>
                      <td class="text-bold">:</td>
                      <td><?= $x->nama_kelas; ?></td>
                    </tr>
                    <tr>
                      <td class="text-bold">Jurusan</td>
                      <td class="text-bold">:</td>
                      <td><?= $x->nama_jurusan; ?></td>
                    </tr>
                  </tbody>
                <?php endforeach; ?>
                </table>
            </div>

            <div class="card-body">

                <?php if(empty($data_aspek)){ ?> <p>Aspek Penilaian Belum Dibuat, Silahkan buat aspek penilaian dahulu di menu Aspek Penilaian. </p> <?php } ?>

                <form id="SimpanNilai" method="post">
                <input type="hidden" name="id_penempatan" value="<?= $id_penempatan; ?>">   
                <input type="hidden" id="totalaspek" value="<?= count($data_aspek); ?>"> 
                <?php $i=1; foreach($data_aspek as $x): ?>
                
                <label for="nama_kelas"><?= $i; ?>. <?= $x->nama_aspek; ?></label>
                
                <input type="hidden" name="id_aspek[]" value="<?= $x->id_aspek; ?>">
                
                <div class="mb-3 row">
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="nilai_angka[]" id="<?= "nilaiangka".$i; ?>" placeholder="Nilai Angka" required value="<?= $modell->getNilaiAngkaByIdPenempatanAndIdAspek($id_penempatan, $x->id_aspek); ?>">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nilai_huruf[]" id="<?= "nilaihuruf".$i; ?>" readonly placeholder="Keterangan Nilai (Tergenarate Otomatis)" required value="<?= $modell->getNilaiHurufByIdPenempatanAndIdAspek($id_penempatan, $x->id_aspek); ?>">
                    </div>
                </div>

                <?php $i++; endforeach; ?>
            
            </div>

            <div class="card-footer">
                <?php if(!empty($data_aspek)): ?>
                <button type="submit" class="btn btn-primary btn-sm" id="submit">Simpan Data</button>
                <button class="btn btn-primary btn-sm" type="button" disabled id="loading">
                    <span class="visually-hidden">Loading...</span>
                </button>
                <?php endif; ?>
                </form>
            </div>

        </div>
    </div>
</section>
</div>

<div class="modal fade" id="kehadiran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rekap Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Sakit</th>
                    <th scope="col">Ijin</th>
                    <th scope="col">Alfa</th>
                </tr>
            </thead>
            <tbody>
                <?php $H = 0; $I = 0; $S = 0; $A = 0;  foreach($modell->getAbsensiPerSiswa($id_penempatan)->getResult() as $x): ?>
                <tr>
                    <th scope="row"><?= date('d-M-Y', strtotime($x->tgl)); ?></th>
                    <td>
                        <?php if($x->status == "hadir"){ $H++; ?>
                        <i class="fas fa-check"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($x->status == "sakit"){ $S++; ?>
                        <i class="fas fa-check"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($x->status == "ijin"){ $I++; ?>
                        <i class="fas fa-check"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($x->status == "alfa"){ $A++; ?>
                        <i class="fas fa-check"></i>
                        <?php } ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr class="table table-success">
                    <th scope="row">Total</th>
                    <td><?= $H; ?></td>
                    <td><?= $S; ?></td>
                    <td><?= $I ?></td>
                    <td><?= $A; ?></td>
                </tr>
                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
$('document').ready(function(){
    $('#loading').hide();

    var totalAspek = $('#totalaspek').val();

    for (let i = 0; i <= totalAspek; i++){

        $('#nilaiangka'+i).on('change', function(){
            var val = $(this).val();

            if(val >= 0 && val <= 59){

                $('#nilaihuruf'+i).val("Kurang");

            }else if(val >= 60 && val <= 74){

                $('#nilaihuruf'+i).val("Cukup");

            }else if(val >= 75 && val <= 89){

                $('#nilaihuruf'+i).val("Baik");

            }else if(val >= 90 && val <=100){

                $('#nilaihuruf'+i).val("Baik Sekali");

            }

        });

    }



    $('#SimpanNilai').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?= base_url('admin/inputnilai_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#loading').show();
                $('#submit').hide();
            },
            complete : function(){
                $('#submit').show(),
                $('#loading').hide();
            },
            success : function(e){
                swal(e)
                .then((result) => {
                   location.reload();
                }).catch((err) => {
                    
                });
            },
            error : function(error){
                alert("SERVER ERROR, Silahkan Coba Lagi Lain Waktu");
            }
        })

    });

});
</script>

<?= $this->endSection('content'); ?>