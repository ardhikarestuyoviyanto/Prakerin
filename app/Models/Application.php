<?php
namespace App\Models;

use CodeIgniter\Model;

class Application extends Model{

    public function getApp(){
        $build = $this->db->table('instansi');
        return $build->get();
    }

    public function getBanner(){
        $build = $this->db->table('banner');
        return $build->get();
    }

    public function editBanner($id, $data){
        $build = $this->db->table('banner');
        $build->where('id', $id);
        $build->update($data);
    }

}
?>