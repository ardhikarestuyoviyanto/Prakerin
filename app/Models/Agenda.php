<?php
namespace App\Models;
use CodeIgniter\Model;

class Agenda extends Model{
    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';
    protected $returnType = 'object';
    protected $allowedFields = 'judul, slug, isi, gambar, file, dilihat, tgl';
    protected $useTimestamps = true;
}
?>