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
    <?php use App\Models\Application; $modell = new Application; ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <?php if($map != null): ?><a class="nav-link" href="<?= base_url('agenda'); ?>">Agenda</a> <?php endif; ?>
                    <?php if($map != null): ?><a class="nav-link disabled" id="slash" href="#">/</a><?php endif; ?>
                    <a class="nav-link disabled" href="#"><?php if(is_null($map)): ?>Agenda <?php else: echo $map; endif;?></a>
                </nav>

                <form class="form-inline" action="<?= base_url('agenda'); ?>" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="cari" required>
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>

        <div class="row">
            <div class="col-sm-8">
                
                <div class="row">
                <?php foreach($agenda as $x): ?>
                    <div class="col-sm-6 mb-5">
                        <div class="card h-100 border-0">
                            <img class="card-img-top" style="width:100%; height: 160px !important;" src="<?= base_url('assets/agenda/'.$x->gambar); ?>" alt="Card image cap">
                            <div class="card-body">
                                <a href="<?= base_url($x->slug); ?>" id="populer" style="text-decoration: none;"><h5 class="card-text mb-2"><?= $x->judul; ?></h5></a>
                                <small class="text-muted" style="font-size:12px;">
                                    <i class="fas fa-calendar-week"></i> <?= date('d-M-Y', strtotime($x->tgl)); ?>
                                    <i class="fas fa-bolt"></i> dilihat <?= $x->dilihat; ?>
                                </small>
                                <p class="card-text mt-3">
                                    <?= strip_tags(substr($x->isi, 0, 69))."..."; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if($pager != null): ?>
                        <?= $pager->links('agenda', 'bootstrap_pagination'); ?>
                <?php endif; ?>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header bg-white">
                        Kategori Agenda
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach($kategori as $x): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                               <a href="<?= base_url('agenda/kategori/'.$x->nama_kategoriagenda); ?>" style="text-decoration: none; color:black;"><?= $x->nama_kategoriagenda; ?></a>
                                <span class="badge badge-primary badge-pill"><?= $modell->getTotalAgendaByKategori($x->id_kategoriagenda); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-white">
                        Paling Banyak dilihat
                    </div>
                    <div class="card-body">
                        <?php foreach($agendapopuler as $x): ?>
                        <div class="row mt-4">
                            <div class="col">
                                <img src="<?= base_url('assets/agenda/'.$x->gambar);  ?>" alt="" width="140px">
                            </div>
                            <div class="col">
                                <p>
                                    <a id="populer" href="<?= base_url($x->slug); ?>" style="text-decoration: none;" ><?= $x->judul; ?></a><br>
                                    <small style="font-size: 11px;"><i class="far fa-calendar-alt"></i> <?= date('d-M-Y', strtotime($x->tgl)); ?> &bull; <i class="fas fa-bolt"></i> dilihat <?= $x->dilihat; ?></small>
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
