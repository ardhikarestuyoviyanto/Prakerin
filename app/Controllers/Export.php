<?php
namespace App\Controllers;
use App\Models\ModelsAdmin;
use App\Models\Application;

class Export extends BaseController{

    private $ModelsAdmin;
    private $input;
    private $ModelsApp;

    public function __construct(){

        $this->input = service('request');
        $this->ModelsAdmin = new ModelsAdmin();
        $this->ModelsApp = new Application();

        view_cell('App\Libraries\Widgets::getDataSekolah', ['data_sekolah'=>$this->ModelsApp->getApp()->getResult()]);
    }

    public function export_lapsiswa(){

        if(isset($_GET['kelas']) && isset($_GET['type'])){

            $data = array(

                'data' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult()

            );

            if($_GET['type'] == "pdf"){

                echo view('admin/export/export_lapsiswa_pdf', $data);
                
            }else{

                echo view('admin/export/export_lapsiswa_excel', $data);

            }

        }

    }

    public function export_lappembimbing(){

        $data = array(
            'pembimbing' => $this->ModelsAdmin->getGuru()->getResult()
        );

        if($_GET['type'] == "pdf"){

            echo view('admin/export/export_lappembimbing_pdf', $data);

        }else{

            echo view('admin/export/export_lappembimbing_excel', $data);

        }

    }

    public function export_lappenempatan(){

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'data' => $this->ModelsAdmin->FilterPenempatan($_GET['kelas'], $_GET['industri'])->getResult()
            );

            if($_GET['type'] == "pdf"){

                echo view('admin/export/export_lappenempatan_pdf', $data);

            }else{

                echo view('admin/export/export_lappenempatan_excel', $data);

            }

        }


    }

}

?>