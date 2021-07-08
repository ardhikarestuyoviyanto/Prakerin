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
    
    //------------------------------

    public function getAgendaLimit($limit){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->orderBy('id_agenda', "DESC");
        $build->limit($limit);
        return $build->get();
    }

    public function getAgenda(){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->orderBy('id_agenda', "DESC");
        return $build->get();
    }

    public function getTotalAgendaByKategori($id_kategoriagenda){
        $build = $this->db->table('agenda');
        $build->select('agenda.id_agenda');
        $build->where('agenda.id_kategoriagenda', $id_kategoriagenda);
        return $build->countAllResults();
    }

    public function getAgendaPopuler($limit){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->orderBy('agenda.dilihat', "DESC");
        $build->limit($limit);
        return $build->get();
    }

    public function getAgendaByNamaKategori($nama_kategoriagenda){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->where('kategori_agenda.nama_kategoriagenda', $nama_kategoriagenda);
        $build->orderBy('agenda.dilihat', "DESC");
        return $build->get();
    }

    public function FilterAgenda($nama_kategoriagenda){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->like('agenda.judul', $nama_kategoriagenda);
        $build->orderBy('agenda.dilihat', "DESC");
        return $build->get();
    }

    public function getAgendaByslug($slug){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->where('agenda.slug', $slug);
        return $build->get();
    }

    public function getJudulAgendaByslug($slug){
        $build = $this->db->table('kategori_agenda');
        $build->select('kategori_agenda.nama_kategoriagenda, agenda.judul, agenda.slug, agenda.isi, agenda.gambar, agenda.file, agenda.dilihat, agenda.tgl');
        $build->join('agenda', 'agenda.id_kategoriagenda = kategori_agenda.id_kategoriagenda');
        $build->where('agenda.slug', $slug);
        foreach ($build->get()->getResult() as $x):
            return $x->judul;
        endforeach;
    }

    //------------------------------

    public function getIndustriPopuler($limit){
        $build = $this->db->table('industri');
        $build->select('industri.nama_industri, industri.slug, industri.bidang_kerja, industri.foto, industri.deskripsi, COUNT(industri.nama_industri) AS total_siswa, industri.kuota, industri.id_industri');
        $build->join('penempatan', 'penempatan.id_industri = industri.id_industri', 'LEFT');
        $build->orderBy('total_siswa', "DESC");
        $build->limit($limit);
        $build->groupBy('penempatan.id_industri');
        return $build->get();   
    }

    public function FilterIndustri($nama_industri){
        $build = $this->db->table('industri');
        $build->select('industri.nama_industri, industri.slug, industri.bidang_kerja, industri.foto, industri.deskripsi, industri.kuota, industri.id_industri');
        $build->like('industri.nama_industri', $nama_industri);
        return $build->get();
    }

    public function getIndustriBySlug($slug){
        $build = $this->db->table('industri');
        $build->select('*');
        $build->where('slug', $slug);
        return $build->get();
    }

    public function getNamaIndustriBySlug($slug){
        $build = $this->db->table('industri');
        $build->select('*');
        $build->where('slug', $slug);
        foreach ($build->get()->getResult() as $x):
            return $x->nama_industri;
        endforeach;
    }

    public function getIdIndustriByslug($slug){
        $build = $this->db->table('industri');
        $build->where('slug', $slug);
        foreach ($build->get()->getResult() as $x):
            return $x->id_industri;
        endforeach;
    }

    public function getSiswaTerdaftarIndustriByIdindustri($id_industri){
        $build = $this->db->table('kelas');
        $build->select('siswa.nama_siswa, kelas.nama_kelas, penempatan.status');
        $build->join('siswa', 'kelas.id_kelas = siswa.id_kelas');
        $build->join('penempatan', 'siswa.id_siswa = penempatan.id_siswa');
        $build->where('penempatan.id_industri', $id_industri);
        return $build;

    }

}
?>