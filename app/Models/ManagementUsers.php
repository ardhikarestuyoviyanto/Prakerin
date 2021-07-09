<?php
namespace App\Models;

use CodeIgniter\Model;

class ManagementUsers extends Model{

    public function getAdmin($username){
        
        $build = $this->db->table('admin');
        $build->where('username', $username);
        return $build->get();
    
    }

    public function getGuru($username){

        $build = $this->db->table('pembimbing');
        $build->where('username', $username);
        return $build->get();

    }

    public function getSiswa($username){

        $build = $this->db->table('siswa');
        $build->where('username', $username);
        return $build->get();

    }

}
?>