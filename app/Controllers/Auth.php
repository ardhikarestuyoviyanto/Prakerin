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

    public function isLogout(){

        $sessionData = ['username', 'nama', 'isLogin'];
        $this->session->remove($sessionData);

        return redirect('/');

    }

}


?>