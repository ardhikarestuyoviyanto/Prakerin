<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin();?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Setting Badan Surat Pengantar</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Setting Badan Surat Pengantar</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Setting Badan Surat Pengantar
            </div>
            <?php foreach($data_surat as $x): ?>
            <div class="card-body">
                <form id="updateForm">
                    <textarea id="badan_surat" name="badansurat"><?= $x->badansurat; ?></textarea>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="submit" style="float:right">Update</button>
                <button class="btn btn-primary" type="button" style="float:right" disabled id="loading">
                    <span class="visually-hidden">Loading...</span>
                </button>
            </div>
            <?php endforeach; ?>
        </form>
        </div>


    </div>
</section>
</div>


<script>
$('document').ready(function(){

    $('#loading').hide();

    $('#badan_surat').summernote({
        height: 600,
        placeholder : 'Tuliskan Badan Surat Permohonan....'
    });

    $('#updateForm').submit(function(e){
        e.preventDefault();

        if($('#badan_surat').summernote('isEmpty')){

            swal('Badan Surat Tidak Boleh Kosong');

        }else{

            $.ajax({
                url : '<?= base_url('admin/updatebadansurat'); ?>',
                type : 'POST',
                data : $(this).serialize(),
                beforeSend : function(){
                    $('#loading').show();
                    $('#submit').hide();
                },
                complete : function(){
                    $('#loading').hide();
                    $('#submit').show();
                },
                success : function(e){
                    swal(e)
                    .then((result) => {
                       location.reload(); 
                    });
                }

            });

        }

    });

    $('#loading').hide();

});
</script>

<?= $this->endSection('content'); ?>