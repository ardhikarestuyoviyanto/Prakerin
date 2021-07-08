<!DOCTYPE html>
<html lang="en">
    <?= $this->include('landingpage/partisi/head.php'); ?>
    <style>
        #slash{
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>
    <body>
    <?= $this->include('landingpage/partisi/navbar.php'); ?>
    <?php use App\Models\ModelsAdmin; $modell = new ModelsAdmin(); ?>
        <div class="container px-4 px-lg-5">
        
        <nav class="navbar navbar-light bg-light mb-3">
            <nav class="nav">
                <?php if($map != null): ?><a class="nav-link" href="<?= base_url('industri'); ?>">Industri</a> <?php endif; ?>
                <?php if($map != null): ?><a class="nav-link disabled" id="slash" href="#">/</a><?php endif; ?>
                <a class="nav-link disabled" href="#"><?php if(is_null($map)): ?>Industri <?php else: echo $map; endif;?></a>
            </nav>

            <form class="form-inline" action="<?= base_url('industri'); ?>" method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="cari" required>
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>

        <?php foreach($industri as $x): ?>
        <div class="row">
            <div class="col-sm-8">
                
                <span class="badge badge-pill badge-primary mt-4 mb-3"><i class="far fa-circle"></i> <?= $x->bidang_kerja; ?></span>
                <h2 class="text-bold"><?= $x->nama_industri; ?></h2>
                <br>
                <div class="text-left">
                    <img src="<?= base_url('assets/industri/'.$x->foto); ?>" class="img-fluid img-rounded" alt="">
                </div>

                <nav class="mt-5">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Persyaratan</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Pendaftar</a>
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <?= $x->deskripsi; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <?= $x->syarat; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <input type="hidden" id="slug" value="<?= $slug; ?>">
                        <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <br><br>
                <div id="disqus_thread"></div>

            </div>

            <div class="col-sm-4">
         
                <div class="card mt-4">
                    <div class="card-header bg-white">
                        Status Penempatan
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Kuota dibuka
                                <span class="badge badge-success badge-pill"><?= $x->kuota; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Kuota Terisi
                                <span class="badge badge-danger badge-pill"><?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sisa Kuota
                                <span class="badge badge-warning badge-pill"><?= $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="card mt-3">
                    <div class="card-header bg-white">
                        Industri Favorit
                    </div>
                    <div class="card-body">
                        <?php foreach($industripopuler as $x): ?>
                        <?php $sisa = $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?>
                        <div class="row mt-4">
                            <div class="col">
                                <img src="<?= base_url('assets/industri/'.$x->foto);  ?>" alt="" width="140px">
                            </div>
                            <div class="col">
                            <small><span class="badge badge-primary badge-pill"><i class="far fa-circle"></i> <?= $x->bidang_kerja; ?></span></small><br>
                                <p>
                                    <a id="populer" href="<?= base_url('industri/'.$x->slug); ?>" style="text-decoration: none;" ><?= $x->nama_industri; ?></a><br>
                                    <small style="font-size: 11px;" class="text-muted"> 
                                        <i class="fas fa-user-check"></i> <?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri) ?> siswa &nbsp;
                                        <i class="fas fa-bolt"></i> sisa kuota <?= $sisa; ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <?= $this->include('landingpage/partisi/footer.php'); ?>
        <?= $this->include('landingpage/partisi/js.php'); ?>
        <script>
                $(document).ready(function() {
                    $('#table').DataTable({ 
                        processing: true,
                        serverSide: true,
                        order: [],
                        ajax : {
                            'type':'POST',
                            'url': '<?= base_url('Home/getDataTablePendaftar') ?>',
                            'data':{
                                'slug':$('#slug').val()
                            }
                        }
                    });
                });
        </script>
    </body>
</html>
