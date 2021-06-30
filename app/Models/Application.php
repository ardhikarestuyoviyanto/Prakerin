<?php
namespace App\Models;

use CodeIgniter\Model;

class Application extends Model{

    public function getApp(){
        $build = $this->db->table('instansi');
        return $build->get();
    }

}
?>