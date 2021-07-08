<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">    
            <?php foreach($app as $x): ?><img src="<?= base_url('dist/img/'.$x->logo_kanan); ?>" width="40" height="30" alt=""><?php endforeach; ?>
            <?php foreach($app as $x): echo $x->nama_app; endforeach; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if($navbar == "Beranda"): ?>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= base_url(); ?>">Beranda</a></li>
                <?php endif; ?>
                <?php if($navbar == "Agenda"): ?>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('agenda'); ?>">Agenda</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('agenda'); ?>">Agenda</a></li>
                <?php endif; ?>
                <?php if($navbar == "Industri"): ?>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('industri'); ?>">Industri</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('industri'); ?>">Industri</a></li>
                <?php endif; ?>
                <?php if($navbar == "Monitoring"): ?>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('monitoring'); ?>">Monitoring</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('monitoring'); ?>">Monitoring</a></li>
                <?php endif; ?>
                <?php if($navbar == "Login"): ?>
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('login'); ?>">Login</a></li>
                <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('login'); ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>