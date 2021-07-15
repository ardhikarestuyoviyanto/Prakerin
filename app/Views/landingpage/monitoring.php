<!DOCTYPE html>
<html lang="en">
    <?= $this->include('landingpage/partisi/head.php'); ?>
    <body>
    <?= $this->include('landingpage/partisi/navbar.php'); ?>
    <?php use App\Models\Application; $modell = new Application; ?>
        <div class="container px-4 px-lg-5">
        
            <nav class="navbar navbar-light bg-light mb-3">

                <nav class="nav">
                    <a class="nav-link disabled" href="#">Monitoring</a>
                </nav>

            </nav>

        <div class="row">

            <div class="col-sm">
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        Top 10 Siswa Kehadiran Terbaik
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach($absensi as $x): ?>
                            <li class="list-group-item justify-content-between align-items-center">
                                <?= $x->nama_siswa; ?> <span class="badge badge-success badge-pill" data-toggle="tooltip" data-placement="top" title="Total Kehadiran" style="float: right; "><?= $x->total_absensi; ?></span>
                                <br>
                                <small><?= $x->nama_kelas; ?></small>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm">
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        Top 10 Siswa Jurnal Terbaik
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach($jurnal as $x): ?>
                            <li class="list-group-item justify-content-between align-items-center">
                                <?= $x->nama_siswa; ?> <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Total Jurnal" style="float: right; "><?= $x->total_jurnal; ?></span>
                                <br>
                                <small><?= $x->nama_kelas; ?></small>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm">
                <div class="card mt-4">
                    <div class="card-header bg-info text-white">
                        Keaktifan Lokasi Prakerin
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach($industri as $x): ?>
                            <li class="list-group-item justify-content-between align-items-center">
                                <?= $x->nama_industri; ?>
                                <div style="float: right;">
                                    <span class="badge badge-success badge-pill" data-toggle="tooltip" data-placement="top" title="Total Kehadiran"><?= $modell->getTotalAbsensiByIdIndustri($x->id_industri); ?></span>
                                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top" title="Total Jurnal"><?= $modell->getTotalJurnalByIdIndustri($x->id_industri); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <?php if($pager != null): ?>
                                <?= $pager->links('industri', 'bootstrap_pagination'); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <?= $this->include('landingpage/partisi/js.php'); ?>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
    </body> 
</html>
