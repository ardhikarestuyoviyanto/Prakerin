<!DOCTYPE html>
<html lang="en">
    <?= $this->include('landingpage/partisi/head.php'); ?>
    <style>
        #populer:hover{
            color: blue;
        }
        #populer{
            color: #3e3f42;
        }
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

        <div class="row">
            <div class="col-sm-8">

                <div class="row">
                    <?php foreach($industri as $x): ?>
                    <?php $sisa = $x->kuota - $modell->getTotalKuotaPenempatanByIndustri($x->id_industri); ?>
                    <div class="col-sm-6 mb-5">
                        <div class="card h-100 border-0">
                            <img class="card-img-top" style="width:100%; height: 160px !important;" src="<?= base_url('assets/industri/'.$x->foto); ?>" alt="Card image cap">
                            <div class="card-body"> 
                                <small><span class="badge badge-primary badge-pill mb-3"><i class="far fa-circle"></i> <?= $x->bidang_kerja; ?></span></small><br>
                                <a href="<?= base_url(); ?>" id="populer" style="text-decoration: none;"><h5 class="card-text mb-2"><?= $x->nama_industri; ?></h5></a>
                                <small class="text-muted" style="font-size:12px;">
                                    <i class="fas fa-user-check"></i> <?= $modell->getTotalKuotaPenempatanByIndustri($x->id_industri) ?> siswa &nbsp;
                                    <i class="fas fa-bolt"></i> sisa kuota <?= $sisa; ?>
                                </small>
                                <p class="card-text mt-3">
                                    <?= strip_tags(substr($x->deskripsi, 0, 69))."..."; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if($pager != null): ?>
                        <?= $pager->links('industri', 'bootstrap_pagination'); ?>
                <?php endif; ?>
                
            </div>
            <div class="col-sm-4">
                <div class="card">
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
                                    <a id="populer" href="<?= base_url(); ?>" style="text-decoration: none;" ><?= $x->nama_industri; ?></a><br>
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
    </body>
</html>
