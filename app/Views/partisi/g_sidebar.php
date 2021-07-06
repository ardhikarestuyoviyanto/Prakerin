<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="<?= base_url('admin/home'); ?>" class="brand-link">
    <img src="<?= base_url('dist/img/AdminLTELogo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Guru Pembimbing</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="<?= base_url('dist/img/unnamed.png') ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Hai, Pembimbing</a>
    </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item active">
                <?php if($sidebar == "Homepage"){ ?>
                <a href="<?= base_url('guru/home'); ?>" class="nav-link active">
                <?php }else{ ?>
                <a href="<?= base_url('guru/home'); ?>" class="nav-link">
                <?php } ?>
                <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <?php if($sidebar == "Industri" || $sidebar == "Data Bimbingan"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
            <i class="nav-icon fas fa-book"></i>
                <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Industri"){ ?>
                        <a href="<?php echo base_url('guru/industri') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('guru/industri') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Industri</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Data Bimbingan"){ ?>
                        <a href="<?php echo base_url('guru/bimbingan') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('guru/bimbingan') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bimbingan</p>
                    </a>
                    </li>
                </ul>
            </li>

            <?php if($sidebar == "Approval Presensi" || $sidebar == "Rekap Presensi"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
            <i class="fas fa-id-card nav-icon"></i>
            <p>
                Presensi
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Approval Presensi"){ ?>
                        <a href="<?php echo base_url('guru/approvalpresensi') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('guru/approvalpresensi') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approval Presensi</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Rekap Presensi"){ ?>
                        <a href="<?php echo base_url('guru/rekappresensi') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('guru/rekappresensi') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Presensi</p>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item active">
                <a href="<?= base_url('auth/isLogout'); ?>"class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Keluar
                    </p>
                </a>
            </li>

        </ul>
    </nav>
</div>
</aside>