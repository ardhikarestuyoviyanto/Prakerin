<?php
namespace App\Controllers;
use App\Models\ModelsAdmin;
use App\Models\Application;

class Siswa extends BaseController{

    private $ModelsAdmin;
    private $input;
    private $ModelsApp;

    public function __construct(){

        $this->ModelsApp = new Application();
        $this->ModelsAdmin = new ModelsAdmin();
        $this->input = service('request');

        view_cell('App\Libraries\Widgets::footer_siswa', ['app'=>$this->ModelsApp->getApp()->getResult()]);

    }

    public function beranda(){

        view_cell('App\Libraries\Widgets::head_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Beranda"]);
		view_cell('App\Libraries\Widgets::navbar_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Beranda"]);

        $data = array(
            'app' => $this->ModelsApp->getApp()->getResult(),
            'data_siswa' => $this->ModelsAdmin->getSiswaByid($_SESSION['id_siswa'])->getResult(),
            'id_siswa' => $_SESSION['id_siswa'],
            'total_pembimbingindustri' => $this->ModelsApp->getTotalPembimbingIndustri($this->ModelsAdmin->getIdPenempatanByidSiswa($_SESSION['id_siswa']))->getResult(), 
            'total_pembimbingsekolah' => $this->ModelsApp->getTotalPembimbingSekolah($this->ModelsAdmin->getIdPenempatanByidSiswa($_SESSION['id_siswa']))->getResult()
        );

        return view('siswa/beranda', $data);

    }

    public function getAbsensiPerSiswa(){
        echo json_encode($this->ModelsAdmin->getAbsensiPerSiswa($this->ModelsAdmin->getIdPenempatanByidSiswa($_SESSION['id_siswa']))->getResult());
    }

    public function getJurnalPerSiswa(){
        echo json_encode($this->ModelsAdmin->getJurnalByIdSiswa($_SESSION['id_siswa'])->getResult());
    }

    //--------------------------------------------------------------

    public function penempatan(){

        view_cell('App\Libraries\Widgets::head_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Penempatan"]);
		view_cell('App\Libraries\Widgets::navbar_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Penempatan"]);

        $data = array(
            'industri' => $this->ModelsApp->FilterPenempatan($_SESSION['id_siswa'])->getResult(),
            'data_industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            'id_siswa' => $_SESSION['id_siswa']
        );

        return view('siswa/penempatan', $data);

    }

    public function tambahpenempatan_action(){
        
        if(empty($this->input->getPost('id_siswa'))){

            echo json_encode('Permohonan Gagal dibuat; silahkan coba lagi lain waktu');

        }else{

            $res = array(
                'industri' => $this->ModelsAdmin->getIndustriByid($this->input->getPost('id_industri'))->getResult(),
                'kuota_terisi' => $this->ModelsAdmin->getTotalKuotaPenempatanByIndustri($this->input->getPost('id_industri'))
            );

            foreach($res['industri'] as $y):

                $sisa_kuota = $y->kuota - $res['kuota_terisi'];

            endforeach;

            if($sisa_kuota == 0){

                echo json_encode('Maaf Kuota Sudah Penuh');


            }else{

                $Surat = $this->input->getFile('surat');
                $Surat->move('assets/surat');

                    $data = array(
                        'id_siswa' => $this->input->getPost('id_siswa'),
                        'id_industri' => $this->input->getPost('id_industri'),
                        'tgl_request' => date('Y-m-d H:i:s'),
                        'status' => 'pending',
                        'surat' => $Surat->getName()
                    );
        
                    $this->ModelsAdmin->TambahPenempatan($data);
        
        
                echo json_encode("Permohonan anda sudah tersimpan, silahkan menunggu beberapa saat");

            }


        }

    }

    public function updatesiswa(){

        if(!empty($this->input->getPost('password'))){

            $data = array(
                'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
            );

            $this->ModelsAdmin->UpdateSiswa($this->input->getPost('id'), $data);

        }

        $data = array(
            'username' => $this->input->getPost('username')
        );

        $this->ModelsAdmin->UpdateSiswa($this->input->getPost('id'), $data);

        echo json_encode('Update Siswa Berhasil');

    }

    //--------------------------------------------------------------

    public function presensi(){

        view_cell('App\Libraries\Widgets::head_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Presensi"]);
		view_cell('App\Libraries\Widgets::navbar_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Presensi"]);

        if(isset($_GET['industri'])):
            
            $data = array(
                'data' => $this->ModelsAdmin->getAbsensiPerSiswaByidIndustriAndIdPenempatan($_SESSION['id_siswa'], $_GET['industri'])->getResult(),
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult()
            );
        
        else:

            $data = array(
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult()
            );

        endif;

        return view('siswa/presensi', $data);

    }

    public function rekapabsensi(){

        $data = array(
            'id_penempatan' => $this->input->getPost('id_penempatan'),
            'tgl' => $this->input->getPost('tgl'),
            'status' => $this->input->getPost('status')
        );

        $this->ModelsAdmin->inputRekapAbsen($data);

        echo json_encode('Berhasil Input Absensi, Tunggu Guru Pembimbing meng acc absensi');

        

    }

    //----------------------------------------------------------------

    public function jurnal(){

        view_cell('App\Libraries\Widgets::head_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Laporan"]);
		view_cell('App\Libraries\Widgets::navbar_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Jurnal"]);

        if(isset($_GET['industri'])):
            
            $data = array(
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult(),   
            );
        
        else:

            $data = array(
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult()
            );

        endif;

        return view('siswa/jurnal', $data);
    }

    public function tambahjurnal_action(){

        $jurnal = $this->input->getFile('jurnal');
        $jurnal->move('assets/jurnal');

        $data = array(
            'judul' => $this->input->getPost('judul'),
            'keterangan' => $this->input->getPost('keterangan'),
            'tgl_kumpul' => date('Y-m-d H:i:s'),
            'id_penempatan' => $this->input->getPost('id_penempatan'),
            'status' => "P",
            'file' => $jurnal->getName()
        );

        $this->ModelsApp->TambahJurnal($data);

        echo json_encode('Jurnal Telah dikumpulkan');

    }

    public function hapusjurnal_action(){

        $this->ModelsApp->Hapusjurnal($this->input->getPost('id'));

        echo json_encode('Hapus Jurnal Berhasil');

    }

    //------------------------------

    public function jurnalharian(){

        view_cell('App\Libraries\Widgets::head_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'title'=>"Jurnal Harian"]);
		view_cell('App\Libraries\Widgets::navbar_siswa', ['app'=>$this->ModelsApp->getApp()->getResult(), 'navbar'=>"Jurnal Harian"]);

        if(isset($_GET['industri'])):
            
            $data = array(
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult(),  
                'data' => $this->ModelsApp->getJurnalHarian($this->ModelsAdmin->getIdPenempatanByidSiswa($_SESSION['id_siswa']))->getResult(),
                'cekjurnal' =>$this->ModelsApp-> cekjurnalharian($this->ModelsAdmin->getIdPenempatanByidSiswa($_SESSION['id_siswa']))
            );
        
        else:

            $data = array(
                'industri' => $this->ModelsAdmin->getPenempatanByidSiswa($_SESSION['id_siswa'])->getResult()
            );

        endif;

        return view('siswa/jurnalharian', $data);

    }

    public function tambahjurnalharian(){

        $data = array(
            'tgl' => date('Y-m-d'),
            'kegiatan' => implode(",",$this->input->getPost('kegiatan')),
            'id_penempatan' => $this->input->getPost('id_penempatan'),
            'status' => 'P'
        );

        $this->ModelsApp->TambahJurnalHarian($data);

        echo json_encode('Jurnal Harian Berhasil disimpan');
    }

    public function hapusjurnalharian(){

        $this->ModelsApp->hapusjurnalHarian($this->input->getPost('id'));

        echo json_encode('Hapus Jurnal Berhasil');
    }

}

?>