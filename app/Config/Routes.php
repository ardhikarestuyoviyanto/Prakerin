<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('auth', function($routes){
	$routes->get('admin', 'Auth::admin');
	$routes->get('siswa', 'Auth::siswa');
	$routes->get('guru', 'Auth::guru');
});

$routes->group('admin', function($routes){
	$routes->get('home', 'Admin::home', ['filter'=>'IsLogin']);

	$routes->get('jurusan', 'Admin::jurusan', ['filter'=>'IsLogin']);
	$routes->get('tambahjurusan', 'Admin::tambahjurusan', ['filter'=>'IsLogin']);
	$routes->get('editjurusan/(:any)', 'Admin::editjurusan', ['filter'=>'IsLogin']);

	$routes->get('editadmin/(:any)', 'Admin::editadmin', ['filter'=>'IsLogin']);

	$routes->get('kelas', 'Admin::kelas', ['filter'=>'IsLogin']);
	$routes->get('tambahkelas', 'Admin::tambahkelas', ['filter'=>'IsLogin']);
	$routes->get('editkelas', 'Admin::editkelas', ['filter'=>'IsLogin']);

	$routes->get('siswa', 'Admin::siswa', ['filter'=>'IsLogin']);
	$routes->get('tambahsiswa', 'Admin::tambahsiswa', ['filter'=>'IsLogin']);
	$routes->get('editsiswa/(:any)', 'Admin::editsiswa', ['filter'=>'IsLogin']);

	$routes->get('industri', 'Admin::industri', ['filter'=>'IsLogin']);
	$routes->get('tambahindustri', 'Admin::tambahindustri', ['filter'=>'IsLogin']);
	$routes->get('editindustri/(:any)', 'Admin::editindustri', ['filter'=>'IsLogin']);

	$routes->get('showadmin', 'Admin::showadmin', ['filter'=>'IsLogin']);
	$routes->get('tambahadmin', 'Admin::tambahadmin', ['filter'=>'IsLogin']);
	$routes->get('editadmin', 'Admin::editadmin', ['filter'=>'IsLogin']);

	$routes->get('pembimbing', 'Admin::pembimbing', ['filter'=>'IsLogin']);
	$routes->get('tambahpembimbing', 'Admin::tambahpembimbing', ['filter'=>'IsLogin']);
	$routes->get('editpembimbing/(:any)', 'Admin::editpembimbing', ['filter'=>'IsLogin']);

	$routes->get('penmanual', 'Admin::penmanual', ['filter'=>'IsLogin']);
	$routes->get('setmanual/(:any)', 'Admin::setmanual', ['filter'=>'IsLogin']);

	$routes->get('penmohon', 'Admin::penmohon', ['filter'=>'IsLogin']);
	$routes->get('detmohon/(:any)', 'Admin::detmohon', ['filter'=>'IsLogin']);

	$routes->get('pendata', 'Admin::pendata', ['filter'=>'IsLogin']);

	$routes->get('absensi', 'Admin::absensi', ['filter'=>'IsLogin']);
	$routes->get('jurnal', 'Admin::jurnal', ['filter'=>'IsLogin']);
	$routes->get('penilaian', 'Admin::penilaian', ['filter'=>'IsLogin']);
	$routes->get('rekappresensi', 'Admin::rekappresensi', ['filter'=>'IsLogin']);

	$routes->get('editabsen/(:any)', 'Admin::editabsen', ['filter'=>'IsLogin']);

	$routes->get('aspek', 'Admin::aspek', ['filter'=>'IsLogin']);

	$routes->get('inputnilai/(:any)', 'Admin::inputnilai', ['filter'=>'IsLogin']);

	$routes->get('kategoriagenda', 'Admin::kategoriagenda', ['filter'=>'IsLogin']);
	$routes->get('agenda', 'Admin::agenda', ['filter'=>'IsLogin']);
	$routes->get('tambahagenda', 'Admin::tambahagenda', ['filter'=>'IsLogin']);
	$routes->get('editagenda/(:any)', 'Admin::editagenda', ['filter'=>'IsLogin']);

	$routes->get('pindah', 'Admin::pindah', ['filter'=>'IsLogin']);
	$routes->get('chat', 'Admin::chat', ['filter'=>'IsLogin']);
	
	$routes->get('lapsiswa', 'Admin::lapsiswa', ['filter'=>'IsLogin']);
	$routes->get('lappembimbing', 'Admin::lappembimbing', ['filter'=>'IsLogin']);
	$routes->get('lappenempatan', 'Admin::lappenempatan', ['filter'=>'IsLogin']);
	$routes->get('kartu', 'Admin::kartu', ['filter'=>'IsLogin']);
	$routes->get('nilaipersiswa', 'Admin::nilaipersiswa', ['filter'=>'IsLogin']);
	$routes->get('nilaiperkelas', 'Admin::nilaiperkelas', ['filter'=>'IsLogin']);
	$routes->get('nilaiperindustri', 'Admin::nilaiperindustri', ['filter'=>'IsLogin']);

	$routes->get('badansurat', 'Admin::badansurat', ['filter'=>'IsLogin']);
	$routes->get('cetaksurat', 'Admin::cetaksurat', ['filter'=>'IsLogin']);

	$routes->get('banner', 'Admin::banner', ['filter'=>'IsLogin']);
	$routes->get('aplikasi', 'Admin::aplikasi', ['filter'=>'IsLogin']);

	$routes->get('jurnalharian', 'Admin::jurnalharian', ['filter'=>'IsLogin']);

});

$routes->group('guru', function($routes){
	$routes->get('home', 'Guru::home', ['filter'=>'IsLogin']);
	$routes->get('bimbingan', 'Guru::bimbingan', ['filter'=>'IsLogin']);
	$routes->get('industri', 'Guru::industri', ['filter'=>'IsLogin']);

	$routes->get('approvalpresensi', 'Guru::approvalpresensi', ['filter'=>'IsLogin']);
	$routes->get('rekappresensi', 'Guru::rekappresensi', ['filter'=>'IsLogin']);
	$routes->get('editpresensi/(:any)', 'Guru::editpresensi', ['filter'=>'IsLogin']);

	$routes->get('jurnal', 'Guru::jurnal', ['filter'=>'IsLogin']);
	$routes->get('penilaian', 'Guru::penilaian', ['filter'=>'IsLogin']);
	$routes->get('chat', 'Guru::chat', ['filter'=>'IsLogin']);
	$routes->get('chatpembimbing', 'Guru::chatpembimbing', ['filter'=>'IsLogin']);
	$routes->get('loadchatguru', 'Guru::loadchatguru', ['filter'=>'IsLogin']);
	$routes->get('kirimchatguru', 'Guru::kirimchatguru', ['filter'=>'IsLogin']);

	$routes->get('setting', 'Guru::setting', ['filter'=>'IsLogin']);

	$routes->get('approvaljurnal', 'Guru::approvaljurnal', ['filter'=>'IsLogin']);
	$routes->get('rekapjurnal', 'Guru::rekapjurnal', ['filter'=>'IsLogin']);
	$routes->get('surat', 'Guru::surat', ['filter'=>'IsLogin']);
});

$routes->group('/', function($routes){
	$routes->get('agenda', 'Home::agenda');
	$routes->get('agenda/kategori/(:any)', 'Home::kategoriagenda');
	$routes->get('industri', 'Home::industri');
	$routes->get('industri/(:any)', 'Home::detailindustri');
	$routes->get('agenda/(:any)', 'Home::bacaagenda');
	$routes->get('monitoring', 'Home::monitoring');
	$routes->get('login', 'Home::login');
});

$routes->group('siswa', function($routes){
	$routes->get('beranda', 'Siswa::beranda', ['filter'=>'IsLogin']);
	$routes->get('getAbsensiPerSiswa', 'Siswa::getAbsensiPerSiswa', ['filter'=>'IsLogin']);
	$routes->get('getJurnalPerSiswa', 'Siswa::getJurnalPerSiswa', ['filter'=>'IsLogin']);
	$routes->get('penempatan', 'Siswa::penempatan', ['filter'=>'IsLogin']);
	$routes->get('tambahpenempatan', 'Siswa::tambahpenempatan_action', ['filter'=>'IsLogin']);
	$routes->get('updatesiswa', 'Siswa::updatesiswa', ['filter'=>'IsLogin']);

	$routes->get('presensi', 'Siswa::presensi', ['filter'=>'IsLogin']);
	$routes->get('rekapabsensi', 'Siswa::rekapabsensi', ['filter'=>'IsLogin']);
	$routes->get('jurnal', 'Siswa::jurnal', ['filter'=>'IsLogin']);
	$routes->get('tambahjurnal_action', 'Siswa::tambahjurnal_action', ['filter'=>'IsLogin']);
	$routes->get('hapusjurnal_action', 'Siswa::hapusjurnal_action', ['filter'=>'IsLogin']);

	$routes->get('jurnalharian', 'Siswa::jurnalharian', ['filter'=>'IsLogin']);
	$routes->get('tambahjurnalharian', 'Siswa::tambahjurnalharian', ['filter'=>'IsLogin']);
	$routes->get('getJurnalHarian', 'Siswa::getJurnalHarian', ['filter'=>'IsLogin']);
	$routes->get('hapusjurnalharian', 'Siswa::hapusjurnalharian', ['filter'=>'IsLogin']);
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
