<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="<?= base_url('admin/home'); ?>" class="brand-link">
    <img src="<?= base_url('dist/img/AdminLTELogo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Administrator</span>
</a>

<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Ardhika Restu Yoviyanto</a>
    </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item active">
                <?php if($sidebar == "Homepage"){ ?>
                <a href="<?= base_url('admin/home'); ?>" class="nav-link active">
                <?php }else{ ?>
                <a href="<?= base_url('admin/home'); ?>" class="nav-link">
                <?php } ?>
                <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <?php if($sidebar == "Jurusan" || $sidebar == "Kelas" || $sidebar == "Siswa" || $sidebar == "Industri" || $sidebar == "Admin" || $sidebar == "Pembimbing" || $sidebar == "Pindah"){ ?>
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
                    <?php if($sidebar == "Admin"){ ?>
                        <a href="<?php echo base_url('admin/showadmin') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/showadmin') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Admin</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Jurusan"){ ?>
                        <a href="<?php echo base_url('admin/jurusan') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/jurusan') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Jurusan</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Kelas"){ ?>
                        <a href="<?php echo base_url('admin/kelas') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/kelas') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Kelas</p>
                    </a>
                    </li>
                </ul>


                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Siswa"){ ?>
                        <a href="<?php echo base_url('admin/siswa') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/siswa') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Siswa</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Industri"){ ?>
                        <a href="<?php echo base_url('admin/industri') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/industri') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Industri</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Pembimbing"){ ?>
                        <a href="<?php echo base_url('admin/pembimbing') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/pembimbing') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pembimbing</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Pindah"){ ?>
                        <a href="<?php echo base_url('admin/pindah') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/pindah') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pindah Kelas</p>
                    </a>
                    </li>
                </ul>

            </li>


            <?php if($sidebar == "Manual" || $sidebar == "Permohonan" || $sidebar == "Data Penempatan"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
                <i class="nav-icon fas fa-link"></i>
                <p>
                Penempatan
                <i class="right fas fa-angle-left"></i>
                <?php if($permohonan_pending != 0){ ?>
                <span class="right badge badge-danger">New</span>
                <?php } ?>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Manual"){ ?>
                        <a href="<?php echo base_url('admin/penmanual') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/penmanual') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Atur Manual</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Permohonan"){ ?>
                        <a href="<?php echo base_url('admin/penmohon') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/penmohon') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Permohonan</p>
                        <?php if($permohonan_pending != 0){ ?>
                        <span class="right badge badge-info"><?= $permohonan_pending; ?></span>
                        <?php } ?>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Data Penempatan"){ ?>
                        <a href="<?php echo base_url('admin/pendata') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/pendata') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Penempatan</p>
                    </a>
                    </li>
                </ul>
            </li>


            <?php if($sidebar == "Absensi" || $sidebar == "Jurnal" || $sidebar == "Penilaian" || $sidebar == "Aspek"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
                <i class="nav-icon fas fa-satellite-dish"></i>
                <p>
                Monitoring
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Aspek"){ ?>
                        <a href="<?php echo base_url('admin/aspek') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/aspek') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aspek Penilaian</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Absensi"){ ?>
                        <a href="<?php echo base_url('admin/absensi') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/absensi') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Absensi</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Jurnal"){ ?>
                        <a href="<?php echo base_url('admin/jurnal') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/jurnal') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Nilai Jurnal</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Penilaian"){ ?>
                        <a href="<?php echo base_url('admin/penilaian') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/penilaian') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Penilaian</p>
                    </a>
                    </li>
                </ul>
            </li>


            <?php if($sidebar == "KategoriAgenda" || $sidebar == "DataAgenda" || $sidebar == "Agenda"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
                <i class="nav-icon fas fa-calendar-week"></i>
                <p>
                Agenda
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "KategoriAgenda"){ ?>
                        <a href="<?php echo base_url('admin/kategoriagenda') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/kategoriagenda') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Agenda"){ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Agenda</p>
                    </a>
                    </li>
                </ul>
            </li>

            <?php if($sidebar == "Kartu Penempatan" || $sidebar == "Lap Data Siswa" || $sidebar == "Lap Data Pembimbing" || $sidebar == "Lap Data Penempatan" || $sidebar == "Lap Nilai Per Siswa" || $sidebar == "Lap Nilai Per Kelas"){ ?>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
            <?php }else{ ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
            <?php } ?>
                <i class="nav-icon fas fa-file-export"></i>
                <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Lap Data Siswa"){ ?>
                        <a href="<?php echo base_url('admin/lapsiswa') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/lapsiswa') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lap Data Siswa</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Lap Data Pembimbing"){ ?>
                        <a href="<?php echo base_url('admin/lappembimbing') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/lappembimbing') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lap Data Pembimbing</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Lap Data Penempatan"){ ?>
                        <a href="<?php echo base_url('admin/lappenempatan') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/lappenempatan') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lap Data Penempatan</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Kartu Penempatan"){ ?>
                        <a href="<?php echo base_url('admin/kartu') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/kartu') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kartu Penempatan</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Lap Nilai Per Siswa"){ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lap Nilai Per Siswa</p>
                    </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <?php if($sidebar == "Lap Nilai Per Kelas"){ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link active">
                    <?php }else{ ?>
                        <a href="<?php echo base_url('admin/agenda') ?>" class="nav-link">
                    <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lap Nilai Per Kelas</p>
                    </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item active">
                <?php if($sidebar == "Chatting"){ ?>
                <a href="<?= base_url('admin/chat'); ?>" class="nav-link active">
                <?php }else{ ?>
                <a href="<?= base_url('admin/chat'); ?>" class="nav-link">
                <?php } ?>
                <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Chatting
                    </p>
                </a>
            </li>

        </ul>
    </nav>
</div>
</aside>