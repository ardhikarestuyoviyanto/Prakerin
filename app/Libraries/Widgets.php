<?php
namespace App\Libraries;

class Widgets{

    public function getTitle($params){

        return view('partisi/head', $params);

    }

    public function getSidebarAdmin($params){

        return view('partisi/a_sidebar', $params);

    }

    public function getSidebarGuru($params){

        return view('partisi/g_sidebar', $params);

    }

    public function getDataSekolah($params){

        return view('admin/export/kop_surat', $params);

    }

    //------------------------------

    public function footer_home($params){

        return view('landingpage/partisi/footer', $params);

    }

    public function navbar_home($params){

        return view('landingpage/partisi/navbar', $params);

    }

    public function head_home($params){

        return view('landingpage/partisi/head', $params);

    }

    public function js_home($params){

        return view('landingpage/partisi/js', $params);

    }

    //------------------------------

    public function footer_siswa($params){

        return view('siswa/partisi/footer', $params);

    }

    public function navbar_siswa($params){

        return view('siswa/partisi/navbar', $params);

    }

    public function head_siswa($params){

        return view('siswa/partisi/head', $params);

    }

    //------------------------------

}

?>