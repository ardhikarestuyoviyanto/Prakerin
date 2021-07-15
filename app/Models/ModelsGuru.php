<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelsGuru extends Model{

    public function getIndustriDibimbing($id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->select('industri.nama_industri, industri.id_industri, industri.kuota, industri.bidang_kerja, industri.slug');
        $build->join('industri', 'industri.id_industri = pembimbing.id_industri');
        $build->where('pembimbing.id_pembimbing', $id_pembimbing);
        return $build->get();
    }

    public function getDataSiswa($id_industri){
        $build = $this->db->table('jurusan');
        $build->select('siswa.nis, siswa.nama_siswa, kelas.nama_kelas, penempatan.surat, penempatan.status');
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

    //--------------------------------------------------------------

    public function getStatusGuru($id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->where('pembimbing.id_pembimbing', $id_pembimbing);
        foreach ($build->get()->getResult() as $x):
            return $x->type;
        endforeach;
    }

    public function getBimbinganGuru($id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->where('pembimbing.id_pembimbing', $id_pembimbing);
        foreach ($build->get()->getResult() as $x):
            return $x->id_industri;
        endforeach;
    }

    public function getguruByidIndustri($id_industri, $id_pembimbing){
        $build = $this->db->table('pembimbing');
        $build->where('pembimbing.id_pembimbing !=', $id_pembimbing);
        $build->where('pembimbing.id_industri', $id_industri);
        return $build->get();
    }

    public function getChatGuru($id_penerima, $id_pengirim){
        $build = $this->db->table('pembimbing');
        $build->select('pembimbing.nama_pembimbing, chat_pembimbing.isi, chat_pembimbing.lampiran, chat_pembimbing.id_pengirim, chat_pembimbing.tgl, chat_pembimbing.id_penerima');
        $build->join('chat_pembimbing', 'chat_pembimbing.id_pengirim = pembimbing.id_pembimbing');
        $build->where('chat_pembimbing.id_penerima', $id_penerima);
        $build->orWhere('chat_pembimbing.id_penerima', $id_pengirim);
        $build->where('chat_pembimbing.id_pengirim', $id_pengirim);
        $build->orWhere('chat_pembimbing.id_pengirim', $id_penerima);
        $build->orderBy('chat_pembimbing.id_chat_pembimbing', "DESC");
        return $build->get();

    }

    public function SimpanChatGuru($data){
        $build = $this->db->table('chat_pembimbing');
        $build->insert($data);
    }

    //--------------------------------------------------------------

}
?>