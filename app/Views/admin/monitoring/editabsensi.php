<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Absensi Per Siswa</h1>
        </div>
        <div class="col-sm-6">
        <?php foreach($data_siswa as $x): ?>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/absensi'); ?>">Absensi</a></li>
            <li class="breadcrumb-item"><?= $x->nama_siswa; ?></li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Edit Absensi Per Siswa
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

            <form id="editAbsen">
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col" style="width:50px;"><input type="checkbox" id="parent"></th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($data as $x): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><input name="id_absen[]" class="child" type="checkbox" value="<?= $x->id_absen; ?>"></td>
                            <td><?= date('d-M-Y', strtotime($x->tgl));  ?></td>
                            <td><?= strtoupper($x->status); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            
            <div class="card-footer">
                <div class="row justify-content-center">
                    <div class="col">
                        <select class="form-control form-control-sm" aria-label="Default select example" required name="status">
                            <option selected value="">- PILIH KEHADIRAN -</option>
                            <option value="hadir">- HADIR -</option>
                            <option value="sakit">- SAKIT - </option>
                            <option value="ijin">- IJIN -</option>
                            <option value="alfa">- ALFA - </option>
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
</div>


<script>
$('document').ready(function(){
    $('#loading').hide();

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

    $('#editAbsen').submit(function(e){
        e.preventDefault();
        
        var confirmed = confirm("Lanjutkan Proses Edit Absensi Sesuai Data Yang Anda Checklist ?");

        if(confirmed){

            $.ajax({
            url : '<?= base_url('admin/editabsen_action'); ?>',
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