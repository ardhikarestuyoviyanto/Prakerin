<?= $this->extend('admin/v_admin'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Chatting</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Chatting</li>
        </ol>
        </div>
    </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Chatting dengan x orang
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Pilih Kontak
                </div>

                <div class="card-body">
                    <select class="form-control form-control-sm" aria-label="Default select example" required name="kelas">
                        <option selected value="">- Pilih Guru Pembimbing -</option>
                        <?php foreach ($kontak as $x): ?>
                        <?php if($x->id_kelas == @$_GET['kelas']){ ?>
                        <option value="<?= $x->id_kelas; ?>" selected><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                        <?php }else{ ?>
                        <option value="<?= $x->id_kelas; ?>"><?= $x->nama_kelas." / ".$x->nama_jurusan; ?></option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>



    </div>
</section>
</div>

<script>
    $('document').ready(function(){
    });
</script>

<?= $this->endSection('content'); ?>