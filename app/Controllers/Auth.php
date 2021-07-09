<?php
namespace App\Controllers;
use App\Models\ManagementUsers;

class Auth extends BaseController{

    public $request;
    public $models;

    public function __construct(){
        
        $this->request = service('request');
        $this->session = \Config\Services::session();
        $this->models = new ManagementUsers();

    }

    public function admin(){

        return view('login/admin');

    }

    public function ActionLoginAdmin(){

        $realcaptcha = $this->request->getPost('number_1') + $this->request->getPost('number_2');

        if($this->request->getPost('captcha') == $realcaptcha){

            foreach ($this->models->getAdmin($this->request->getPost('username'))->getResult() as $x):

                if(password_verify($this->request->getPost('password'), $x->password)):

                    $data = array(
                        'username' => $x->username,
                        'nama' => $x->nama,
                        'isLogin' => true
                    );

                    $this->session->set($data);

                    return redirect('admin/home');
                    
                    break;
                    
                endif;
            
            endforeach;

            $this->session->setFlashdata('error', "Username Atau Password Salah");

            return redirect('auth/admin');

        }else{

			$this->session->setFlashdata('error', "Captcha Salah");

            return redirect('auth/admin');

        }


    }

    //------------------------------

    public function guru(){

        return view('login/guru');

    }

    public function ActionLoginGuru(){

        $realcaptcha = $this->request->getPost('number_1') + $this->request->getPost('number_2');

        if($this->request->getPost('captcha') == $realcaptcha){

            foreach ($this->models->getGuru($this->request->getPost('username'))->getResult() as $x):

                if(password_verify($this->request->getPost('password'), $x->password)):

                    $data = array(
                        'username' => $x->username,
                        'nama' => $x->nama_pembimbing,
                        'isLogin' => true,
                        'id_pembimbing' => $x->id_pembimbing
                    );

                    $this->session->set($data);

                    return redirect('guru/home');
                    
                    break;
                    
                endif;
            
            endforeach;

            $this->session->setFlashdata('error', "Username Atau Password Salah");

            return redirect('auth/guru');

        }else{

			$this->session->setFlashdata('error', "Captcha Salah");

            return redirect('auth/guru');

        }

    }

    //--------------------------------------------------------------

    public function ActionLoginSiswa(){

        $realcaptcha = $this->request->getPost('number_1') + $this->request->getPost('number_2');

        if($this->request->getPost('captcha') == $realcaptcha){

            if(empty($this->models->getSiswa($this->request->getPost('username'))->getResult())){

                echo json_encode('Username Atau Password Salah');

            }else{

                foreach ($this->models->getSiswa($this->request->getPost('username'))->getResult() as $x):

                    if(password_verify($this->request->getPost('password'), $x->password)){
    
                        $data = array(
                            'id_siswa' => $x->id_siswa,
                            'nama_siswa' => $x->nama_siswa,
                            'isLogin' => true
                        );
    
                        $this->session->set($data);
    
                        echo json_encode(1);
        
                    }else{
    
                        echo json_encode("Username Atau Password Salah");
    
    
                    }
    
                endforeach;

            }

        }else{

            echo json_encode('Captcha Salah');

        }


    }

    public function isLogout(){

        $sessionData = ['username', 'nama', 'isLogin'];
        $this->session->remove($sessionData);

        return redirect('/');

    }

}


?>