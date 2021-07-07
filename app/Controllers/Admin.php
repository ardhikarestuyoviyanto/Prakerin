<?php
namespace App\Controllers;

use App\Models\Application;
use App\Models\ModelsAdmin;
use PDO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController{

    private $ModelsApp;
    private $ModelsAdmin;
    private $input;

    public function __construct(){
        $this->input = service('request');
        $this->ModelsApp = new Application();
        $this->ModelsAdmin = new ModelsAdmin();
    }

    public function home(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Homepage', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Homepage', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'data' => $this->ModelsApp->getApp()->getResult()
        );

        echo view('admin/home/home', $data);

    }

    public function jurusan(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Jurusan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Jurusan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()
        );

        echo view('admin/data/jurusan', $data);

    }

    public function tambahjurusan(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Tambah Jurusan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Jurusan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        echo view('admin/data/tambahjurusan');

    }

    public function tambahjurusan_action(){

        $data = array(
            'nama_jurusan' => $this->input->getPost('nama_jurusan')
        );

        $this->ModelsAdmin->TambahJurusan($data);

        echo json_encode('Jurusan '.$this->input->getPost('nama_jurusan').' Berhasil di Inputkan');

    }

    public function editjurusan(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Jurusan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Jurusan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'jurusan' => $this->ModelsAdmin->getJurusanByid($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/data/editjurusan', $data);
    }

    public function updatejurusan_action(){
        $data = array(
            'nama_jurusan' => $this->input->getPost('nama_jurusan')
        );

        $this->ModelsAdmin->UpdateJurusan($this->input->getPost('id'), $data);

        echo json_encode('Update Berhasil');
    }

    public function deletejurusan(){
        $this->ModelsAdmin->Deletejurusan($this->input->uri->getSegment('3'));
        return redirect('admin/jurusan');
    }

    //--------------------------------------------------------------------------------------------------------------------------

    public function kelas(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Kelas', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Kelas', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'kelas' => $this->ModelsAdmin->getKelas()->getResult()

        );

        echo view('admin/data/kelas', $data);

    }

    public function tambahkelas(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Tambah Kelas', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Kelas', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()

        );

        echo view('admin/data/tambahkelas', $data);

    }

    public function tambahkelas_action(){

        $data = array(
            'id_jurusan' => $this->input->getPost('id_jurusan'),
            'nama_kelas' => $this->input->getPost('nama_kelas')
        );

        $this->ModelsAdmin->TambahKelas($data);

        echo json_encode('Tambah Kelas Berhasil');

    }

    public function editkelas(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Kelas', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Kelas', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'kelas' => $this->ModelsAdmin->getKelasByid($this->input->uri->getSegment('3'))->getResult(),
            'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()
        );

        echo view('admin/data/editkelas', $data);
        
    }

    public function editkelas_action(){

        $data = array(
            'nama_kelas' => $this->input->getPost('nama_kelas'),
            'id_jurusan' => $this->input->getPost('id_jurusan')
        );

        $this->ModelsAdmin->UpdateKelas($this->input->getPost('id_kelas'), $data);

        echo json_encode('Update Kelas Berhasil');

    }

    public function deletekelas(){

        $this->ModelsAdmin->DeleteKelas($this->input->uri->getSegment('3'));

        return redirect('admin/kelas');

    }

    //-------------------------------------------------------------------------------------------

    public function siswa(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Siswa', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Siswa', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswa()->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );
    

        }

        echo view('admin/data/siswa', $data);

    }

    public function tambahsiswa(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Tambah Siswa', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Siswa', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'kelas' => $this->ModelsAdmin->getKelas()->getResult()
        );

        echo view('admin/data/tambahsiswa', $data);

    }

    public function editsiswa(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Siswa', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Siswa', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'siswa' => $this->ModelsAdmin->getSiswaByid($this->input->uri->getSegment('3'))->getResult(),
            'kelas' => $this->ModelsAdmin->getKelas()->getResult()
        );

        echo view('admin/data/editsiswa', $data);

    }

    public function tambahsiswa_action(){
        $data = array(
            'nama_siswa' => $this->input->getPost('nama_siswa'),
            'id_kelas' => $this->input->getPost('id_kelas'),
            'nis' => $this->input->getPost('nis'),
            'alamat' => $this->input->getPost('alamat'),
            'username' => $this->input->getPost('username'),
            'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT),
            'jenis_kelamin' => $this->input->getPost('jenis_kelamin')
        );

        $this->ModelsAdmin->TambahSiswa($data);

        echo json_encode('Tambah Siswa Berhasil');
    }

    public function editsiswa_action(){

        if(!empty($this->input->getPost('password'))){

            $data = array(
                'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
            );

            $this->ModelsAdmin->UpdateSiswa($this->input->getPost('id'), $data);

        }

        $data = array(
            'nama_siswa' => $this->input->getPost('nama_siswa'),
            'id_kelas' => $this->input->getPost('id_kelas'),
            'nis' => $this->input->getPost('nis'),
            'alamat' => $this->input->getPost('alamat'),
            'username' => $this->input->getPost('username'),
            'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT),
            'jenis_kelamin' => $this->input->getPost('jenis_kelamin')
        );

        $this->ModelsAdmin->UpdateSiswa($this->input->getPost('id'), $data);

        echo json_encode('Update Siswa Berhasil');
    }

    public function hapussiswa_action(){
        
        if(empty($_POST['id'])){

            echo json_encode('Gagal Hapus, Checklist Minimal 1 Siswa');

        }else{

            foreach ($_POST['id'] as $x):

                $this->ModelsAdmin->DeleteSiswa($x);

            endforeach;

            echo json_encode(count($_POST['id']).' Siswa Berhasil dihapus');

        }

    }

    public function importsiswa(){

        $spreadsheet = new Spreadsheet();

        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['excel']['name']);
            $extension = end($arr_file);
         
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
         
            $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
             
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            
            for($i = 1;$i < count($sheetData);$i++){
                
                $data = array(

                    'nis' => $sheetData[$i]['1'],
                    'nama_siswa' => $sheetData[$i]['2'],
                    'username' => $sheetData[$i]['3'],
                    'id_kelas' => $sheetData[$i]['4'],
                    'jenis_kelamin' => $sheetData[$i]['5'],
                    'alamat' => $sheetData[$i]['6'],
                    'password' => password_hash($sheetData[$i]['7'], PASSWORD_DEFAULT)
                );

                $this->ModelsAdmin->TambahSiswa($data);

            }

            echo json_encode('Berhasil Import Data');

        }else{

            echo json_encode('Ekstensi File Salah (harus .xlsx)');

        }

    }


    //-------------------------------------------------------------------------------------------

    public function industri(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Industri', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Industri', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'industri' => $this->ModelsAdmin->getIndustri()->getResult()
        );

        echo view('admin/data/industri', $data);

    }

    public function tambahindustri(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Industri', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Industri', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        echo view('admin/data/tambahindustri');

    }

    public function editindustri(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Industri', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Industri', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'industri' => $this->ModelsAdmin->getIndustriByid($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/data/editindustri', $data);

    }

    public function tambahindustri_action(){

        $validated = $this->validate([
            'avatar' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[foto,4096]',
            ],
        ]);

        if($validated){

            $avatar = $this->input->getFile('foto');

            $avatar->move('assets/industri');

            $data = array(
            
                'foto' => $avatar->getName(),
                'nama_industri' => $this->input->getPost('nama_industri'),
                'alamat_industri' => $this->input->getPost('alamat_industri'),
                'deskripsi' => $this->input->getPost('deskripsi'),
                'kuota' => $this->input->getPost('kuota'),
                'bidang_kerja' => $this->input->getPost('bidang_kerja'),
                'telp' => $this->input->getPost('telp'),
                'email' => $this->input->getPost('email'),
                'syarat' => $this->input->getPost('syarat'),
                'slug' => url_title($this->input->getPost('nama_industri'), '-', TRUE),
            
            );

            
            $this->ModelsAdmin->TambahIndustri($data);
            
            echo json_encode('Industri Berhasil Di Input');

        }else{

            echo json_encode('Internal Server Error');

        }

    }

    public function editindustri_action(){


        if(file_exists($_FILES['foto']['tmp_name'])){

            $validated = $this->validate([
                'avatar' => [
                    'uploaded[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[foto,4096]',
                ],
            ]);
    
            if($validated){
    
                $avatar = $this->input->getFile('foto');
    
                $avatar->move('assets/industri');
    
                $data = array(
                
                    'foto' => $avatar->getName()
                
                );
    
                
                $this->ModelsAdmin->UpdateIndustri($this->input->getPost('id'), $data);
            
            }else{

                echo json_encode('Ekstensi File Salah');

            }

        }

        $data = array(
        
            'nama_industri' => $this->input->getPost('nama_industri'),
            'alamat_industri' => $this->input->getPost('alamat_industri'),
            'deskripsi' => $this->input->getPost('deskripsi'),
            'kuota' => $this->input->getPost('kuota'),
            'bidang_kerja' => $this->input->getPost('bidang_kerja'),
            'telp' => $this->input->getPost('telp'),
            'email' => $this->input->getPost('email'),
            'syarat' => $this->input->getPost('syarat'),
            'slug' => url_title($this->input->getPost('nama_industri'), '-', TRUE)
        
        );

        
        $this->ModelsAdmin->UpdateIndustri($this->input->getPost('id'), $data);
        
        echo json_encode('Industri Berhasil Di Edit');


    }

    public function hapusindustri_action(){

        if(empty($_POST['id'])){

            echo json_encode('Gagal Hapus; Checklist Minimal 1 Data');

        }else{

            foreach ($_POST['id'] as $x):

                $this->ModelsAdmin->DeleteIndustri($x);
            
            endforeach;

            echo json_encode(count($_POST['id'])." data berhasil dihapus");

        }

    }

    //------------------------------------------------------------------------------

    public function showadmin(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Admin', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Admin', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'admin' => $this->ModelsAdmin->getAdmin()->getResult()
        );

        echo view('admin/data/admin', $data);

    }

    public function tambahadmin(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Tambah Admin', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Admin', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        echo view('admin/data/tambahadmin');

    }

    public function editadmin(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Admin', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Admin', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'admin' => $this->ModelsAdmin->getAdminByid($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/data/editadmin', $data);

    }

    public function tambahadmin_action(){

        $data = array(
            'nama' => $this->input->getPost('nama'),
            'username' => $this->input->getPost('username'),
            'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
        );

        $this->ModelsAdmin->TambahAdmin($data);

        echo json_encode('Tambah Admin Berhasil');

    }

    public function editadmin_action(){

        if(!empty($_POST['password'])){

            $data = array(
                'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
            );

            $this->ModelsAdmin->UpdateAdmin($this->input->getPost('id'), $data);

        }

        $data = array(
            
            'nama' => $this->input->getPost('nama'),
            'username' => $this->input->getPost('username')
        );

        $this->ModelsAdmin->UpdateAdmin($this->input->getPost('id'), $data);

        echo json_encode('Update Berhasil');


    }

    public function hapusadmin_action(){

        $this->ModelsAdmin->DeleteAdmin($this->input->uri->getSegment('3'));

        return redirect('admin/showadmin');
          
    }


    //------------------------------------------------------------------------------------------

    public function pembimbing(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Pembimbing', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Pembimbing', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['industri']) && isset($_GET['jurusan'])){

            $data = array(
                'pembimbing' => $this->ModelsAdmin->FilterDataGuru($_GET['jurusan'], $_GET['industri'])->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()
            );

        }else{

            $data = array(
                'pembimbing' => $this->ModelsAdmin->getGuru()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()
            );

        }

        echo view('admin/guru/guru', $data);

    }

    public function tambahpembimbing(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Tambah Pembimbing', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Pembimbing', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'jurusan' => $this->ModelsAdmin->getJurusan()->getResult(),
            'industri' => $this->ModelsAdmin->getIndustri()->getResult()
        );

        echo view('admin/guru/tambahguru', $data);

    }

    public function editpembimbing(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Pembimbing', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Pembimbing', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'jurusan' => $this->ModelsAdmin->getJurusan()->getResult(),
            'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            'guru' => $this->ModelsAdmin->getGuruByid($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/guru/editguru', $data);

    }

    public function tambahpembimbing_action(){

        $data = array(
            'nama_pembimbing' => $this->input->getPost('nama_pembimbing'),
            'nip' => $this->input->getPost('nip'),
            'id_industri' => $this->input->getPost('id_industri'),
            'id_jurusan' => $this->input->getPost('id_jurusan'),
            'username' => $this->input->getPost('username'),
            'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
        );

        $this->ModelsAdmin->TambahGuru($data);

        echo json_encode('Data Pembimbing Baru Berhasil ditambahkan ');

    }

    public function deletepembimbing_action(){

        if(empty($_POST['id'])){

            echo json_encode('Gagal; Checklist Minimal 1 Data');

        }else{

            foreach ($_POST['id'] as $x):

                $this->ModelsAdmin->DeleteGuru($x);

            endforeach;

            echo json_encode(count($_POST['id'])." Data Berhasil Dihapus");

        }

    }

    public function editpembimbing_action(){

        if(!empty($_POST['password'])){

            $data = array(
                'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
            );

            $this->ModelsAdmin->UpdateGuru($this->input->getPost('id'), $data);

        }

        $data = array(
            'nama_pembimbing' => $this->input->getPost('nama_pembimbing'),
            'nip' => $this->input->getPost('nip'),
            'id_industri' => $this->input->getPost('id_industri'),
            'id_jurusan' => $this->input->getPost('id_jurusan'),
            'username' => $this->input->getPost('username'),
            'password' => password_hash($this->input->getPost('password'), PASSWORD_DEFAULT)
        );

        $this->ModelsAdmin->UpdateGuru($this->input->getPost('id'), $data);


        echo json_encode('Data Pembimbing Berhasil Diedit');

    }

    public function importpembimbing(){

        $spreadsheet = new Spreadsheet();

        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel']['name']) && in_array($_FILES['excel']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['excel']['name']);
            $extension = end($arr_file);
         
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
         
            $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
             
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            
            for($i = 1;$i < count($sheetData);$i++){
                
                $data = array(

                    'nip' => $sheetData[$i]['1'],
                    'nama_pembimbing' => $sheetData[$i]['2'],
                    'id_industri' => $sheetData[$i]['3'],
                    'id_jurusan' => $sheetData[$i]['4'],
                    'username' => $sheetData[$i]['5'],
                    'password' => password_hash($sheetData[$i]['6'], PASSWORD_DEFAULT)
                );

                $this->ModelsAdmin->TambahGuru($data);

            }

            echo json_encode('Berhasil Import Data');

        }else{

            echo json_encode('Ekstensi File Salah (harus .xlsx)');

        }

    }

    //------------------------------------------------------------------------------------------------------------------

    public function penmanual(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penempatan Manual', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Manual', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'industri' => $this->ModelsAdmin->getIndustri()->getResult()
        );

        echo view('admin/penempatan/manual', $data);

    }

    public function setmanual(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penempatan Manual', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Manual', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'nama_industri' => $this->ModelsAdmin->getNamaIndustriByNama($this->input->uri->getSegment('3')),
                'data' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'industri' => $this->input->uri->getSegment('3'),
                'industri_detail' => $this->ModelsAdmin->getIndustriByid($this->input->uri->getSegment('3'))->getResult(),
                'kuota_terisi' => $this->ModelsAdmin->getTotalKuotaPenempatanByIndustri($this->input->uri->getSegment('3')),
                'pembimbing' => $this->ModelsAdmin->getguruByidIndustri($this->input->uri->getSegment('3'))->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'nama_industri' => $this->ModelsAdmin->getNamaIndustriByNama($this->input->uri->getSegment('3')),
                'industri' => $this->input->uri->getSegment('3'),
                'industri_detail' => $this->ModelsAdmin->getIndustriByid($this->input->uri->getSegment('3'))->getResult(),
                'kuota_terisi' => $this->ModelsAdmin->getTotalKuotaPenempatanByIndustri($this->input->uri->getSegment('3')),
                'pembimbing' => $this->ModelsAdmin->getguruByidIndustri($this->input->uri->getSegment('3'))->getResult()
            );

        }

        echo view('admin/penempatan/manual_setting', $data);  

    }

    public function setmanual_action(){
        
        if(empty($_POST['id_siswa'])){

            echo json_encode('Gagal Menempatkan; Checklist Minimal 1 Siswa');

        }else{

            $res = array(
                'industri' => $this->ModelsAdmin->getIndustriByid($this->input->getPost('id_industri'))->getResult(),
                'kuota_terisi' => $this->ModelsAdmin->getTotalKuotaPenempatanByIndustri($this->input->getPost('id_industri'))
            );

            foreach($res['industri'] as $y):

                $sisa_kuota = $y->kuota - $res['kuota_terisi'];

            endforeach;

            if($sisa_kuota == 0 || $sisa_kuota < count($_POST['id_siswa'])){

                echo json_encode('Maaf Kuota yang anda masukkan kelebihan atau Sudah Penuh');


            }else{

                foreach ($_POST['id_siswa'] as $x):

                    $data = array(
                        'id_siswa' => $x,
                        'id_industri' => $this->input->getPost('id_industri'),
                        'tgl_request' => date('Y-m-d H:i:s'),
                        'status' => 'diterima',
                        'surat' => 'kosong'
                    );
        
                    $this->ModelsAdmin->TambahPenempatan($data);
        
                endforeach; 
        
                echo json_encode(count($_POST['id_siswa'])." Siswa Berhasil Ditempatkan");

            }

        }

    }

    //------------------------------------------------------------------------------------------------------------------

    public function penmohon(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Surat Permohonan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Permohonan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['type'])){

            if($_GET['type'] == "pending"){

                if(isset($_GET['kelas']) && isset($_GET['industri'])){

                    $data = array(
                        'data' => $this->ModelsAdmin->FilterPermohonanSiswaPending($_GET['industri'], $_GET['kelas'])->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );

                }else{

                    $data = array(
                        'data' => $this->ModelsAdmin->getPermohonanSiswaPending()->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );

                }


                echo view('admin/penempatan/permohonan_pending', $data);


            }else if($_GET['type'] == "ditolak"){

                if(isset($_GET['kelas']) && isset($_GET['industri'])){

                    $data = array(
                        'data' => $this->ModelsAdmin->FilterPermohonanSiswaDitolak($_GET['industri'], $_GET['kelas'])->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );

                }else{

                    $data = array(
                        'data' => $this->ModelsAdmin->getPermohonanSiswaDitolak()->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );

                }

                echo view('admin/penempatan/permohonan_ditolak', $data);

            }else if($_GET['type'] == "diterima"){

                if(isset($_GET['kelas']) && isset($_GET['industri'])){

                    $data = array(
                        'data' => $this->ModelsAdmin->FilterPermohonanSiswaDiterima($_GET['industri'], $_GET['kelas'])->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );
    
                }else{

                    $data = array(
                        'data' => $this->ModelsAdmin->getPermohonanSiswaDiterima()->getResult(),
                        'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                        'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                    );

                }

                echo view('admin/penempatan/permohonan_diterima', $data);

            }else{

                $data = array(
                    'data' => $this->ModelsAdmin->getPermohonanSiswaPending()->getResult(),
                    'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                    'industri' => $this->ModelsAdmin->getIndustri()->getResult()
                );

                echo view('admin/penempatan/permohonan_pending', $data);

            }

        }else{

            $data = array(
                'data' => $this->ModelsAdmin->getPermohonanSiswaPending()->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );

            echo view('admin/penempatan/permohonan_pending', $data);

        }

    }

    public function simpanpermohonan_global(){
        
        if(empty($_POST['id_penempatan'])){

            echo json_encode('Gagal; Checklist Minimal 1 Data');

        }else{

            if($this->input->getPost('type') == "diterima"){

                foreach ($_POST['id_penempatan'] as $x):

                    $data = array(
                        'status' => "diterima"
                    );

                    $this->ModelsAdmin->updatePermohonan($x, $data);

                endforeach;

                echo json_encode("Proses Penerimaan Permohonan Untuk ".count($_POST['id_penempatan'])." data Berhasil");

            }else{

                $data = array(
                    'status' => "ditolak"
                );

                foreach ($_POST['id_penempatan'] as $x):

                    $data = array(
                        'status' => "ditolak"
                    );

                    $this->ModelsAdmin->updatePermohonan($x, $data);
                
                    $datapenolakan = array(
                        'alasan' => $this->input->getPost('alasan'),
                        'id_penempatan' => $this->input->getPost('id_penempatan'),
                        'tgl' => date('Y-m-d H:i:s')
                    );

                    $this->ModelsAdmin->TambahTolakPenempatan($datapenolakan);

                endforeach;

                echo json_encode("Proses Tolak Permohonan Untuk ".count($_POST['id_penempatan'])." data Berhasil");

            }

        }

    }

    public function hapuspermohonan(){

        if(empty($_POST['id_penempatan'])){

            echo json_encode('Gagal; Checklist Minimal 1 Data');

        }else{

            foreach ($_POST['id_penempatan'] as $x):

                $this->ModelsAdmin->hapusPermohonan($x);

            endforeach;

            echo json_encode(count($_POST['id_penempatan'])." Data Berhasil Terhapus");

        }

    }

    public function detmohon(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Detail Permohonan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Permohonan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'data' => $this->ModelsAdmin->getDetailPermohonan($this->input->uri->getSegment('3'))->getResult(),
        );

        echo view('admin/penempatan/detail_permohonan', $data);

    }

    public function pendata(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Data Penempatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Data Penempatan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'data' => $this->ModelsAdmin->FilterPenempatan($_GET['kelas'], $_GET['industri'])->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
    
            );

        }

        echo view('admin/penempatan/data', $data);
    
    }


    //------------------------------------------------------------------------------------------

    public function absensi(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Absensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Absensi', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'], $_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            );
    
        }


        echo view('admin/monitoring/absensi', $data);

    }

    public function input_rekapabsensi(){

        if(empty($_POST['id_penempatan'])){

            echo json_encode('Gagal Input; Checklist Minimal 1 Siswa');

        }else{

            foreach($_POST['id_penempatan'] as $x){

                $data = array(
                    'id_penempatan' => $x,
                    'tgl' => $this->input->getPost('tgli'),
                    'status' => $this->input->getPost('status')
                );

                $this->ModelsAdmin->inputRekapAbsen($data);

            }

            echo json_encode(count($_POST['id_penempatan']).' Data Siswa Berhasil Direkap');

        }

    }

    public function editabsen(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Absensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Absensi', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'data_siswa' => $this->ModelsAdmin->getDataSiswaByIdPenempatan($this->input->uri->getSegment('3'))->getResult(),
            'data' => $this->ModelsAdmin->getAbsensiPerSiswa($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/monitoring/editabsensi', $data);

    }

    public function editabsen_action(){
        
        if(empty($_POST['id_absen'])){

            echo json_encode('Gagal; Checklist Minimal 1 Data');

        }else{

            foreach ($_POST['id_absen'] as $x):
                
                $data = array(
                    'status' => $this->input->getPost('status')
                );

                $this->ModelsAdmin->updateRekapAbsen($x, $data);

            endforeach;

            echo json_encode(count($_POST['id_absen']).' Data Absen Berhasil Diupdate');

        }

    }

    public function hapusabsen_action(){

        $this->ModelsAdmin->hapusRekapAbsen($this->input->getPost('id_penempatan'), $this->input->getPost('tgl'));

        echo json_encode('Berhasil Hapus Rekap Absensi');

    }

    public function rekappresensi(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Rekap Presensi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Rekap Presensi', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'], $_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            );
    
        }


        echo view('admin/monitoring/rekappresensi', $data);

    }

    //--------------------------------------------------------------------------------------------------------------------------------


    public function jurnal(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Jurnal', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Jurnal', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'], $_GET['kelas'])->getResult(),
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            );

        }

        echo view('admin/monitoring/jurnal', $data);

    }

    public function UpdateStatusJurnal(){
        
        if(empty($_POST['status'])){

            echo json_encode('Ups; Kolom Status Masih Kosong');

        }else{

            $data = array(
                'status' => $this->input->getPost('status')
            );
    
            $this->ModelsAdmin->inputnilaiJurnal($this->input->getPost('id'), $data);
    
            echo json_encode('Status Jurnal Berhasil Diupdate');

        }

    }

    //---------------------------------------------------------------------------------------------------------------------------------------

    public function penilaian(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penilaian', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Penilaian', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'data' => $this->ModelsAdmin->getPenempatanJoinSiswa($_GET['industri'], $_GET['kelas'])->getResult(),
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
            );

        }

        echo view('admin/monitoring/penilaian', $data);

    }

    public function inputnilai(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Input Nilai', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Penilaian', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        //uri (3) id penempatan
        //uri (4) id jurusan

        //uri (5) id industri
        //uri (6) id kelas

        $data = array(
            'data_siswa' => $this->ModelsAdmin->getDataSiswaByIdPenempatan($this->input->uri->getSegment('3'))->getResult(), //menampilkan data siswa
            'data_aspek' => $this->ModelsAdmin->getDataAspekByidJurusan($this->input->uri->getSegment('4'))->getResult(), //menampilkan aspek penilaian
            'id_penempatan' => $this->input->uri->getSegment('3'),

            'id_industri' =>$this->input->uri->getSegment('5'), //segment url id_industri
            'id_kelas' => $this->input->uri->getSegment('6') //segment url id_kelas
        );

        echo view('admin/monitoring/inputnilai', $data);

    }

    public function inputnilai_action(){
        
        if(empty($_POST['nilai_angka']) || empty($_POST['nilai_huruf'])){

            echo json_encode('Mohon Inputkan Semua Nilai');

        }else{

            // hapus nilai yg lama terlebih dahulu (jika ada)

            $this->ModelsAdmin->deletenilai($this->input->getPost('id_penempatan'));

            $i = 0;
            
            foreach ($_POST['id_aspek'] as $x):

                $data = array(

                    'id_penempatan' => $this->input->getPost('id_penempatan'),
                    'id_aspek' => $x,
                    'nilai_angka' => $_POST['nilai_angka'][$i],
                    'nilai_huruf' => $_POST['nilai_huruf'][$i]

                );

                $this->ModelsAdmin->inputnilai($data);
            
                $i++;

            endforeach;

            echo json_encode('Nilai Berhasil Diperbaharui');

        }

    }

    //--------------------------------------------------------------------------------------------------------------------------------

    public function aspek(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Aspek Penilaian', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Aspek', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['jurusan'])){

            $data = array(
                'jurusan' => $this->ModelsAdmin->getJurusan()->getResult(),
                'data' => $this->ModelsAdmin->getAspekByIdJurusan($_GET['jurusan'])->getResult()
            );

        }else{

            $data = array(
                'jurusan' => $this->ModelsAdmin->getJurusan()->getResult()
            );

        }

        echo view('admin/monitoring/aspek', $data);

    }

    public function Tambahaspek_Action(){
        $data = array(
            'id_jurusan' => $this->input->getPost('id_jurusan'),
            'nama_aspek' => $this->input->getPost('nama_aspek')
        );

        $this->ModelsAdmin->TambahAspek($data);

        echo json_encode('Tambah Aspek Penilaian Berhasil');
    }

    public function HapusAspek(){
        $id_aspek = $this->input->getPost('id_aspek');
        $this->ModelsAdmin->HapusAspek($id_aspek);
        
        echo json_encode('Data Aspek Berhasil Terhapus');
    }

    public function AspekByid(){
        echo json_encode($this->ModelsAdmin->getAspekByid($this->input->getPost('id_aspek'))->getResult());
    }

    public function editAspek(){
        $data = array(
            'nama_aspek' => $this->input->getPost('nama_aspek')
        );
        $this->ModelsAdmin->EditAspek($this->input->getPost('id_aspek'), $data);
        echo json_encode('Update Aspek Berhasil');
    }

    //------------------------------------------------------------------------------------------

    public function kategoriagenda(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Kategori Agenda', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'KategoriAgenda', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);
    
        $data = array(
            'agenda' => $this->ModelsAdmin->getKategoriAgenda()->getResult()
        );

        echo view('admin/agenda/kategori', $data);
    }

    public function tambahKategoriAgenda_action(){
        $data = array(
            'nama_kategoriagenda' => $this->input->getPost('nama_kategoriagenda')
        );
        $this->ModelsAdmin->tambahKategoriAgenda($data);
        echo json_encode('Tambah Kategori Agenda Berhasil');
    }

    public function getKategoriAgenda(){
        echo json_encode($this->ModelsAdmin->getKategoriAgendaById($this->input->getPost('id_kategoriagenda'))->getResult());
    }

    public function updateKategoriAnggota_action(){
        $data = array(
            'nama_kategoriagenda' => $this->input->getPost('nama_kategoriagenda')
        );
        $this->ModelsAdmin->updateKategoriAgenda($this->input->getPost('id_kategoriagenda'), $data);
        echo json_encode('Kategori Agenda Berhasil Diupdate');
    }

    public function hapusKategoriAgenda_action(){
        $this->ModelsAdmin->deleteKategoriAgenda($this->input->getPost('id_kategoriagenda'));
        echo json_encode('Hapus Kategori Agenda Berhasil');
    }

    //-----------------------------------------------------------------------------------------

    public function agenda(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Agenda Kegiatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Agenda', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);
        
        $data = array(
            'data' => $this->ModelsAdmin->getAgenda()->getResult()
        );

        echo view('admin/agenda/agenda', $data);
    
    }

    public function tambahagenda(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Agenda Kegiatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Agenda', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);
        
        $data = array(
            'kategoriagenda' => $this->ModelsAdmin->getKategoriAgenda()->getResult()
        );

        echo view('admin/agenda/tambahagenda', $data);
        
    }

    public function tambahagenda_action(){
        
        $validate = $this->validate([
            'avatar' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[foto,4096]',
            ],
        ]);

        $avatar = $this->input->getFile('foto');

        if(file_exists($_FILES['file']['tmp_name'])){

            if($validate){

                $file = $this->input->getFile('file');

                $avatar->move('assets/agenda');
                $file->move('assets/agenda');
    
                $data = array(
                
                   'id_kategoriagenda' => $this->input->getPost('id_kategoriagenda'),
                   'judul' => $this->input->getPost('judul'),
                   'slug' => url_title($this->input->getPost('judul'), '-', TRUE),
                   'isi' => $this->input->getPost('isi'),
                   'gambar' => $avatar->getName(),
                   'file' => $file->getName(),
                   'dilihat' => 0,
                   'tgl' => date('Y-m-d H:i:s')
                
                );
    
                $this->ModelsAdmin->TambahAgenda($data);
                
                echo json_encode('Agenda Baru Berhasil Di Input');

            }else{

                echo json_encode('Ekstensi Gambar Salah');

            }
    

        }else{

            if($validate){

                $avatar->move('assets/agenda');

                $data = array(

                    'id_kategoriagenda' => $this->input->getPost('id_kategoriagenda'),
                    'judul' => $this->input->getPost('judul'),
                    'slug' => url_title($this->input->getPost('judul'), '-', TRUE),
                    'isi' => $this->input->getPost('isi'),
                    'gambar' => $avatar->getName(),
                    'file' => 'kosong',
                    'dilihat' => 0,
                    'tgl' => date('Y-m-d H:i:s')

                );

                $this->ModelsAdmin->TambahAgenda($data);

                echo json_encode('Agenda Baru Berhasil Di Input');

            }else{

                echo json_encode('Ekstensi Gambar Salah');

            }


        }


    }

    public function editagenda(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Edit Agenda Kegiatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Agenda', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);
        
        $data = array(
            'kategoriagenda' => $this->ModelsAdmin->getKategoriAgenda()->getResult(),
            'data' => $this->ModelsAdmin->getAgendaByid($this->input->uri->getSegment('3'))->getResult()
        );

        echo view('admin/agenda/editagenda', $data);
    }

    public function editagenda_action(){

        $validate = $this->validate([
            'avatar' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[foto,4096]',
            ],
        ]);

        if(file_exists($_FILES['file']['tmp_name'])){

            $file = $this->input->getFile('file');
            $file->move('assets/agenda');

            $data = array(
                'file' => $file->getName()
            );

            $this->ModelsAdmin->UpdateAgenda($this->input->getPost('id'), $data);

        }
        

        if(file_exists($_FILES['foto']['tmp_name'])){

            $foto = $this->input->getFile('foto');
            $foto->move('assets/agenda');

            if($validate){

                $data = array(
                    'gambar' => $foto->getName()
                );

                $this->ModelsAdmin->UpdateAgenda($this->input->getPost('id'), $data);

            }else{

                echo json_encode('Ekstensi File Salah');

            }

        }

        $data = array(
            'id_kategoriagenda' => $this->input->getPost('id_kategoriagenda'),
            'judul' => $this->input->getPost('judul'),
            'slug' => url_title($this->input->getPost('judul'), '-', TRUE),
            'isi' => $this->input->getPost('isi'),
        );

        $this->ModelsAdmin->UpdateAgenda($this->input->getPost('id'), $data);

        echo json_encode('Agenda Berhasil diUpdate');

    }

    public function hapusagenda_action(){
        $this->ModelsAdmin->DeleteAgenda($this->input->getPost('id'));
        echo json_encode('Hapus Agenda Berhasil');
    }

    //----------------------------------------------------------------------------------

    public function pindah(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Pindah Kelas', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Pindah', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
    
            );

        }

        echo view('admin/data/pindahkelas', $data);

    }

    public function pindah_action(){

        if(empty($_POST['id'])){

            echo json_encode('Gagal Memindahkan; Checklist Minimal 1 Siswa');

        }else{

            foreach ($_POST['id'] as $x):

                $data = array(
                    'id_kelas' => $this->input->getPost('id_kelas')
                );
            
                $this->ModelsAdmin->UpdateSiswa($x, $data);

            endforeach;

            echo json_encode(count($_POST['id']).' Siswa Berhasil Dipindahkan');
        }

    }

    //-----------------------------------------------------------------

    public function chat(){
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Chatting', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Chatting', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['guru'])){

            $data = array(
                'kontak' => $this->ModelsAdmin->getGuru()->getResult(),
                'nama_guru' => $this->ModelsAdmin->getNamaGuru($_GET['guru'])
            );

        }else{

            $data = array(
                'kontak' => $this->ModelsAdmin->getGuru()->getResult()
            );

        }

        echo view('admin/chat/chat', $data);

    }

    public function loadchat(){

        echo json_encode($this->ModelsAdmin->getChat($this->input->getPost('id_pembimbing'))->getResult());
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
            'pengirim' => "admin"
        );

        $this->ModelsAdmin->SimpanChat($data);

        echo json_encode($this->ModelsAdmin->errors());

    }

    public function hapuschat(){
        $this->ModelsAdmin->HapusChat($this->input->getPost('id_chat'));
        
        return redirect('admin/chat?guru='.$_GET['guru']);
    }

    //----------------------------------------------------------------------------------------------------------------

    public function lapsiswa(){
        
        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Lap Data Siswa', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Lap Data Siswa', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswa()->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );
    

        }

        echo view('admin/laporan/lapsiswa', $data);

    }

    public function lappembimbing(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Lap Data Pembimbing', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Lap Data Pembimbing', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'pembimbing' => $this->ModelsAdmin->getGuru()->getResult()
        );

        echo view('admin/laporan/lappembimbing', $data);


    }

    public function lappenempatan(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Lap Data Penempatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Lap Data Penempatan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas']) && isset($_GET['industri'])){

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'data' => $this->ModelsAdmin->FilterPenempatan($_GET['kelas'], $_GET['industri'])->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
    
            );

        }

        echo view('admin/laporan/lappenempatan', $data);

    }

    public function kartu(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Kartu Penempatan', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Kartu Penempatan', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswa()->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );
    

        }

        echo view('admin/laporan/lapkartu', $data);

    }

    public function nilaipersiswa(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Lap Nilai Per Siswa', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Lap Nilai Per Siswa', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()

            );
    

        }

        echo view('admin/laporan/lapnilaipersiswa', $data);

    }

    public function nilaiperkelas(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Lap Nilai Per Kelas', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Lap Nilai Per Kelas', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['kelas'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaBykelas($_GET['kelas'])->getResult(),
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()
            );

        }else{

            $data = array(
                'kelas' => $this->ModelsAdmin->getKelas()->getResult()

            );
    

        }

        echo view('admin/laporan/lapnilaiperkelas', $data);

    }

    public function perindustri(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Penempatan Per Industri', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Penempatan Per Industri', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['industri'])){

            $data = array(
                'siswa' => $this->ModelsAdmin->getSiswaByIndustri($_GET['industri'])->getResult(),
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );

        }else{

            $data = array(
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );
    

        }

        echo view('admin/laporan/lapperindustri', $data);

    }

    //----------------------------------------------------------------

    public function badansurat(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Badan Surat', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Badan Surat', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'data_surat' => $this->ModelsApp->getApp()->getResult()
        );

        echo view('admin/surat/badansurat', $data);
    
    }

    public function updatebadansurat(){
        $data = array(
            'badansurat' => $this->input->getPost('badansurat')
        );

        $this->ModelsAdmin->UpdateInstansi($data);

        echo json_encode('Data Berhasil diperbaharui');
    }

    public function cetaksurat(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Cetak Surat', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Cetak Surat', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        if(isset($_GET['industri'])){

            $data = array(
                'industri' => $this->ModelsAdmin->getIndustri()->getResult(),
                'data' => $this->ModelsAdmin->getSiswaByIndustri($_GET['industri'])->getResult()
            );

        }else{

            $data = array(
                'industri' => $this->ModelsAdmin->getIndustri()->getResult()
            );

        }
        
        echo view('admin/surat/cetaksurat', $data);

    }

    //----------------------------------------------------------------

    public function banner(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Banner', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Banner', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'logo' => $this->ModelsApp->getApp()->getResult(),
            'banner' => $this->ModelsApp->getBanner()->getResult()
        );

        echo view('admin/setting/banner', $data);   

    }

    public function editbanner(){
        if(file_exists($_FILES['banner']['tmp_name'])):
            $file = $this->input->getFile('banner');
            $file->move('assets/banner');
            $data = array(
                'judul' => $this->input->getPost('judul'),
                'file' => $file->getName()
            );
        else:
            $data = array(
                'judul' => $this->input->getPost('judul')
            );
        endif;

        $this->ModelsApp->editBanner($this->input->getPost('id'), $data);
        echo json_encode('Banner Terupdate');
    }

    public function editlogo(){

        if(file_exists($_FILES['file']['tmp_name'])):
            $file = $this->input->getFile('file');
            $file->move('dist/img');

            if($this->input->getPost('typelogo') == "Logo Kiri"):

                $data = array(
                    'logo_kiri' => $file->getName()
                );

            else:

                $data = array(
                    'logo_kanan' => $file->getName()
                );

            endif;

            $this->ModelsAdmin->UpdateInstansi($data);

            echo json_encode('Logo Terupdate');

        endif;
    }

    public function aplikasi(){

        view_cell('App\Libraries\Widgets::getTitle', ['title'=>'Setting Aplikasi', 'appdata'=>$this->ModelsApp->getApp()->getResultArray()]);
        view_cell('App\Libraries\Widgets::getSidebarAdmin', ['sidebar'=>'Aplikasi', 'permohonan_pending'=>count($this->ModelsAdmin->getPermohonanSiswaPending()->getResultArray())]);

        $data = array(
            'data' => $this->ModelsApp->getApp()->getResult()
        );

        echo view('admin/setting/aplikasi', $data);   

    }

    public function aplikasi_edit(){

        $data = array(
            'nama_instansi' => $this->input->getPost('nama_instansi'),
            'nama_app' => $this->input->getPost('nama_app'),
            'kepala_sekolah' => $this->input->getPost('kepala_sekolah'),
            'email' => $this->input->getPost('email'),
            'notelp' => $this->input->getPost('notelp'),
            'disqus' => $this->input->getPost('disqus'),
        );

        $this->ModelsAdmin->UpdateInstansi($data);

        echo json_encode('Data Berhasil diedit');

    }

}

?>