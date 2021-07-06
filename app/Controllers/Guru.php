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
            'data' => $this->ModelsApp->getApp()->getResult()
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


}
?>