<?php
namespace App\Libraries;

class Widgets{

    public function getTitle($params){

        return view('partisi/head', $params);

    }

    public function getSidebarAdmin($params){

        return view('partisi/a_sidebar', $params);

    }

    public function getDataSekolah($params){

        return view('admin/export/kop_surat', $params);

    }

}

?>