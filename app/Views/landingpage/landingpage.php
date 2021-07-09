<!DOCTYPE html>
<html lang="en">
    <?= $this->include('landingpage/partisi/head.php'); ?>
    <body>
    <style>
    #populer:hover{
        color: blue;
    }
    #populer{
        color: #3e3f42;
    }
    .blink {

    animation: blink-animation 1s steps(5, start) infinite;

        -webkit-animation: blink-animation 1s steps(5, start) infinite;

    }

    @keyframes blink-animation {

        to {

        visibility: hidden;

        }

    }

    @-webkit-keyframes blink-animation {

    to {

        visibility: hidden;

    }

}
    </style>
    <?= $this->include('landingpage/partisi/navbar.php'); ?>
        <div class="container px-4 px-lg-5" style="margin-bottom: 60px;">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" style=" width:100%; height: 300px !important;">
                            <div class="carousel-item active">
                                <img class="d-block w-100 rounded" src="<?= base_url('assets/banner/'.$banner[0]['file']); ?>" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 rounded" src="<?= base_url('assets/banner/'.$banner[1]['file']); ?>" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 rounded" src="<?= base_url('assets/banner/'.$banner[2]['file']); ?>" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">Sistem Informasi Prakerin</h1>
                    <p>Selamat Datang di <?= $data_app[0]['nama_app']; ?>, <?= $data_app[0]['nama_instansi']; ?> Sistem Indormasi yang digunakan untuk mengelola Praktik kerja Industri, mulai dari Persiapan, Pelaksanaan, Penilaian, dan Evaluasi. Silahkan dipergunakan dengan baik</p>
                    <a class="btn btn-primary" href="<?= base_url('login'); ?>">Login</a>
                </div>
            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0 blink"><b>Agenda dan Berita mengenai Kegiatan Prakerin Terbaru</b></p></div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5">
                <?php foreach($agenda as $x): ?>
                <div class="col-md-4 mb-5">
                    <div class="card h-100 border-0">
                        <img class="card-img-top" style="width:100%; height: 160px !important;" src="<?= base_url('assets/agenda/'.$x->gambar); ?>" alt="Card image cap">
                        <div class="card-body"> 
                            <a href="<?= base_url('agenda/'.$x->slug); ?>" id="populer" style="text-decoration: none;"><h5 class="card-text mb-2"><?= $x->judul; ?></h5></a>
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
        </div>
        <?= $this->include('landingpage/partisi/footer.php'); ?>
        <?= $this->include('landingpage/partisi/js.php'); ?>
    </body>
</html>
