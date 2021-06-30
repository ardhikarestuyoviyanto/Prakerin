<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<?php foreach ($data as $x): ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Permohonan Siswa</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/penmohon'); ?>">Permohonan</a></li>
            <li class="breadcrumb-item"><?= $x->nama_siswa; ?></li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Identitas Siswa
                    </div>
                    <form id="UbahPenempatan">
                    <input type="hidden" name="id_penempatan[]" value="<?= $x->id_penempatan; ?>">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">NIS</th>
                                    <td><?= $x->nis; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Siswa</th>
                                    <td><?=$x->nama_siswa; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jurusan</th>
                                    <td><?= $x->nama_jurusan; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Kelas</th>
                                    <td><?= $x->nama_kelas; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tgl Permohonan</th>
                                    <td><?= date('d - m - y  /  H:i:s', strtotime($x->tgl_request)); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Penempatan</th>
                                    <td><?= ucfirst($x->status); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Surat Permohonan</th>
                                    <?php if($x->surat == "kosong"){ ?>
                                        <td>DITEMPATKAN MANUAL</td>
                                    <?php }else{ ?>
                                        <td><a target="__BLANK" href="<?= base_url('assets/surat/'.$x->surat); ?>"><?= $x->surat;?></a></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th scope="row">Keputusan</th>
                                    <td>
                                        <select class="form-control" aria-label="Default select example" id="type" required name="type">
                                            <option selected value="">- PILIH AKSI -</option>
                                            <option value="diterima">- TERIMA PERMOHONAN SESUAI INDUSTRI YANG DIPILIH -</option>
                                            <option value="ditolak">- TOLAK PERMOHONAN SESUAI INDUSTRI YANG DIPILIH - </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr id="alasan">
                                    <th scope="row">Alasan Penolakan</th>
                                    <td>
                                        <input type="text" name="alasan" id="alasan" class="form-control" placeholder="Alasan Penolakan">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Pilihan Industri
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Industri</th>
                                    <td><?= $x->nama_industri; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Bidang Kerja</th>
                                    <td><?=$x->bidang_kerja; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Kuota Maksimal</th>
                                    <td><?= $x->kuota; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Kuota Terisi</th>
                                    <td><?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sisa Kuota</th>
                                    <td><?= $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Persyaratan</th>
                                    <td>
                                        <?= $x->syarat; ?>
                                    </td>
                                </tr>
                                <tr>
                                <th scope="row">Guru Pembimbing</th>
                                    <td>
                                        <?php $i=1; foreach($modell->getguruByidIndustri($x->id_industri)->getResult() as $y): ?>
                                            <?php if($i == 1): ?>
                                            <?= $y->nama_pembimbing; ?>
                                            <?php endif; ?>
                                        <?php $i++; endforeach; ?>
                                    </td>
                                </tr>

                                <?php $k=1; foreach($modell->getguruByidIndustri($x->id_industri)->getResult()as $y): ?>
                                <?php if(count($modell->getguruByidIndustri($x->id_industri)->getResult()) > 1 && $k > 1): ?>
                                <tr>
                                    <td></td>
                                    <td><?= $y->nama_pembimbing; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php $k++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>


    </div>
</section>
</div>
<?php endforeach; ?>

<script>
$('document').ready(function(){

    $('#alasan').hide();

    $('#type').change(function() {
        var val = $(this).val();
        if(val == "ditolak"){
            $('#alasan').show();
        }else{
            $('#alasan').hide();
        }
    });

    $('#UbahPenempatan').submit(function(e){
        e.preventDefault();
        
            var confirmed = confirm("Lanjutkan Proses Penempatan ?");

            if(confirmed){

                $.ajax({
                url : '<?= base_url('admin/simpanpermohonan_global'); ?>',
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

<?= $this->endSection('content'); ?>