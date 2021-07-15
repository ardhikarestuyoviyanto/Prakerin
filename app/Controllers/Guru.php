<?php
namespace App\Controllers;
use App\Models\Application;
use App\Models\ModelsGuru;
use App\Models\ModelsAdmin;

class Guru extends BaseController{

    private $ModelsApp;
    private $ModelsGuru;
    private $input;

    public function __construct(){

        $this->ModelsApp = new Application();
        $this->ModelsGuru = new ModelsGuru();
        $this->ModelsAdmin = new ModelsAdmin();
        $this->input = service('request');

    }

    public function home(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Homepage', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Homepage']);

        $data = array(
            'data' => $this->ModelsApp->getApp()->getResult(),
            'siswa' =>  $this->ModelsGuru->getDataSiswa($this->ModelsAdmin->getIdIndustriByidPembimbing($_SESSION['id_pembimbing']))->getResult(),
            'status' => $this->ModelsGuru->getStatusGuru($_SESSION['id_pembimbing'])
        );

        echo view('guru/home/home', $data);

    }

    public function bimbingan(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Bimbingan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Data Bimbingan']);

        if(isset($_GET['industri'])): 
            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsGuru->getDataSiswa($_GET['industri'])->getResult()
            );
        else:
            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );
        endif;

        echo view('guru/data/bimbingan', $data);

    }

    public function industri(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Industri', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Industri']);

        $data = array(
            'data' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
        );

        echo view('guru/data/industri', $data);

    }

    //-------------------------------------------------------------

    public function approvalpresensi(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Approval Presensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Approval Presensi']);

        if(isset($_GET['industri'])): 
            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsGuru->getPenempatanJoinSiswa($_GET['industri'])->getResult()
            );
        else:
            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );
        endif;

        echo view('guru/presensi/approval', $data);

    }

    public function editpresensi(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Presensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Approval Presensi']);

        $data = array(
            'data_siswa' => $this->ModelsAdmin->getDataSiswaByIdPenempatan($this->input->uri->getSegment('3'))->getResult(),
            'data' => $this->ModelsAdmin->getAbsensiPerSiswa($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('guru/presensi/editpresensi', $data);

    }

    public function rekappresensi(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Rekap Presensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Rekap Presensi']);

        if(isset($_GET['industri'])){

            $data = array(
                'data' => $this->ModelsGuru->getPenempatanJoinSiswa($_GET['industri'])->getResult(),
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );
    
        }


        echo view('guru/presensi/rekappresensi', $data);

    }

    //---------------------------------------------------------------

    public function jurnal(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Approval Jurnal', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Approval Jurnal']);

        if(isset($_GET['industri'])){

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsGuru->getPenempatanJoinSiswa($_GET['industri'])->getResult(),
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()

            );

        }

        echo view('guru/jurnal/jurnal', $data);

    }

    //---------------------------------------------------------------

    public function penilaian(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penilaian', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Penilaian']);

        if(isset($_GET['industri'])){

            $data = array(
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'])->getResult(),
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );

        }

        echo view('guru/penilaian/penilaian', $data);

    }

    public function inputnilai(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penilaian', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Penilaian']);

        //uri (3) id penempatan
        //uri (4) id jurusan

        //uri (5) id industri
        //uri (6) id kelas

        $data = array(
            'data_siswa' => $this->ModelsAdmin->getDataSiswaByIdPenempatan($this->input->uri->getSegment('3'))->getResult(), //menampilkan data siswa
            'data_aspek' => $this->ModelsAdmin->getDataAspekByidJurusan($this->input->uri->getSegment('4'))->getResult(), //menampilkan aspek penilaian
            'id_penempatan' => $this->input->uri->getSegment('3'),

            'id_industri' =>$this->input->uri->getSegment('5'), //segment url id_industri
        );

        echo view('guru/penilaian/inputnilai', $data);

    }

    //----------------------------------------------------------------------

    public function chat(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Chatting', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Chat']);

        echo view('guru/chat/chat');

    }

    
    public function kirimchat(){

        if(file_exists($_FILES['lampiran']['tmp_name'])){

            $lamp = $this->input->getFile('lampiran');
            $lamp->move('assets/chat');
            $lampiran = $lamp->getName();

        }else{

            $lampiran = "kosong";

        }

        $data = array(
            'isi' => $this->input->getPost('isi'),
            'lampiran' => $lampiran,
            'id_pembimbing' => $this->input->getPost('id_pembimbing'),
            'tgl' => date('Y-m-d H:i:s'),
            'pengirim' => "guru"
        );

        $this->ModelsAdmin->SimpanChat($data);

        echo json_encode($this->ModelsAdmin->errors());

    }

    public function chatpembimbing(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Chat Pembimbing', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Chat Pembimbing']);

        if(isset($_GET['guru'])){

            $data = array(
                'kontak' => $this->ModelsGuru->getguruByidIndustri($this->ModelsGuru->getBimbinganGuru($_SESSION['id_pembimbing']), $_SESSION['id_pembimbing'])->getResult(),
                'nama_guru' => $this->ModelsAdmin->getNamaGuru($_GET['guru']),
                'id_pembimbing' => $_SESSION['id_pembimbing']
            );

        }else{

            $data = array(
                'kontak' => $this->ModelsGuru->getguruByidIndustri($this->ModelsGuru->getBimbinganGuru($_SESSION['id_pembimbing']), $_SESSION['id_pembimbing'])->getResult(),
                'id_pembimbing' => $_SESSION['id_pembimbing']
            );
            
        }

        echo view('guru/chat/chatpembimbing', $data);
    }

    public function loadchatguru(){
        echo json_encode($this->ModelsGuru->getChatGuru($this->input->getPost('id_penerima'), $this->input->getPost('id_pengirim'))->getResult());
    }

    public function kirimchatguru(){
        if(file_exists($_FILES['lampiran']['tmp_name'])){

            $lamp = $this->input->getFile('lampiran');
            $lamp->move('assets/chat');
            $lampiran = $lamp->getName();

        }else{

            $lampiran = "kosong";

        }

        $data = array(
            'isi' => $this->input->getPost('isi'),
            'lampiran' => $lampiran,
            'id_pengirim' => $this->input->getPost('id_pengirim'),
            'id_penerima' => $this->input->getPost('id_penerima'),
            'tgl' => date('Y-m-d H:i:s')
        );

        $this->ModelsGuru->SimpanChatGuru($data);

        echo json_encode($this->ModelsAdmin->errors());
    }   

    //----------------------------------------------------------------

    public function setting(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Setting', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Setting']);

        $data = array(
            'guru' => $this->ModelsAdmin->getGuruByid($_SESSION['id_pembimbing'])->getResult()
        );

        echo view('guru/setting/setting', $data);

    }

    //--------------------------------------------------------------

    public function approvaljurnal(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Approval Jurnal Harian', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Jurnal Harian']);

        if(isset($_GET['industri'])){

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'])->getResult(),
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult()
            );

        }

        echo view('guru/jurnalharian/data', $data);
    }

    public function rekapjurnal(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Rekap Jurnal', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Rekap Jurnal Harian']);

        if(isset($_GET['industri'])){

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'])->getResult(),
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
            );

        }

        echo view('guru/jurnalharian/rekap', $data);
    }

    public function surat(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Surat', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarGuru', ['sidebar'=>'Surat']);

        if(isset($_GET['industri'])){

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
                'data' => $this->ModelsAdmin->getSiswaByIndustri($_GET['industri'])->getResult()
            );

        }else{

            $data = array(
                'industri' => $this->ModelsGuru->getIndustriDibimbing($_SESSION['id_pembimbing'])->getResult(),
            );

        }
        
        echo view('guru/surat/cetaksurat', $data);

    }

}
?>