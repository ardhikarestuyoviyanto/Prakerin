<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelsGuru extends Model{

    public function getIndustriDibimbing($id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->select('industri.nama_industri, industri.id_industri, industri.kuota, industri.bidang_kerja');
        $build->join('industri', 'industri.id_industri = pembimbing.id_industri');
        $build->where('pembimbing.id_pembimbing', $id_pembimbing);
        return $build->get();
    }

    public function getDataSiswa($id_industri){
        $build = $this->db->table('jurusan');
        $build->select('siswa.nis, siswa.nama_siswa, kelas.nama_kelas, jurusan.nama_jurusan');
        $build->join('kelas', 'kelas.id_jurusan = jurusan.id_jurusan');
        $build->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
        $build->join('penempatan', 'penempatan.id_siswa = siswa.id_siswa');
        $build->where('penempatan.id_industri', $id_industri);
        return $build->get();
    }

    public function getPenempatanJoinSiswa($id_industri){
        $build = $this->db->table('siswa');
        $build->select('siswa.nis, siswa.nama_siswa, siswa.id_siswa, siswa.id_kelas, penempatan.id_penempatan, penempatan.id_industri');
        $build->join('penempatan', 'penempatan.id_siswa = siswa.id_siswa');
        $build->where('penempatan.id_industri', $id_industri);
        $build->orderBy('siswa.nis', "ASC");
        return $build->get();
        
    }

    public function getIdJurusanByPembimbing($id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->select('pembimbing.id_jurusan');
        foreach ($build->get()->getResult() as $x):
            return $x->id_jurusan;
        endforeach;
    }

}
?>