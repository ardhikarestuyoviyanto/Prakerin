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

        <?php foreach($agenda as $x): ?>
        <div class="row">
            <div class="col-sm-8">
                
                <span class="badge badge-pill badge-primary mt-4 mb-3"><i class="far fa-circle"></i> <?= $x->nama_kategoriagenda; ?></span>
                <h2 class="text-bold"><?= $x->judul; ?></h2>
                <small class="text-muted" style="font-size:12px;">
                    <i class="fas fa-calendar-week"></i> <?= date('d-M-Y', strtotime($x->tgl)); ?> ,
                    <i class="fas fa-bolt"></i> dilihat <?= $x->dilihat; ?>
                </small><br><br>
                <div class="text-center">
                    <img src="<?= base_url('assets/agenda/'.$x->gambar); ?>" class="img-fluid img-rounded" alt="">
                </div>

                <p class="card-text">
                    <?= $x->isi; ?>
                </p>

                <?php  if($x->file != "kosong"): ?>
                <div class="card">
                    <div class="card-header bg-white">
                        Lampiran File
                    </div>
                    <div class="card-body">
                        <p class="card-text"><a style="text-decoration:none;" target="__BLANK" id="populer" href="<?= base_url('assets/agenda/'.$x->file); ?>"><?= $x->file; ?></a></p>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row row-cols-auto mt-5 mb-5 justify-content-end">
                    <div><h4>Share</h4> </div>
                    <div><a target="__BLANLK" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?= $x->judul; ?>&amp;p[summary]=<?= substr(strip_tags($x->isi),0,100) ;?>&amp;p[url]=<?= base_url('agenda/'.$x->slug); ?>&amp;&p[images][0]=<?= base_url('assets/agenda/'.$x->gambar);?>"><img src="https://image.flaticon.com/icons/png/512/124/124010.png" width="30px" alt=""></a></div>
                    <div><a target="__BLANK" href="https://wa.me/?text=<?= base_url('agenda/'.$x->slug); ?>"><img src="https://www.apkmirror.com/wp-content/uploads/2020/01/5e278ba9f3021.png" width="30px" alt=""></a></div>
                    <div><a target="__BLANK" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url('agenda/'.$x->slug); ?>&title=<?= $x->slug; ?>"><img src="https://image.flaticon.com/icons/png/512/174/174857.png" width="30px" alt=""></a></a></div>
                </div>

                <div id="disqus_thread"></div>

            </div>
            <?php endforeach; ?>

            <div class="col-sm-4">
         
                <div class="card mt-4">
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
                                    <a id="populer" href="<?= base_url('agenda/'.$x->slug); ?>" style="text-decoration: none;" ><?= $x->judul; ?></a><br>
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
