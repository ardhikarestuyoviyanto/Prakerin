<?php
namespace App\Models;
use CodeIgniter\Model;

class Industri extends Model{
    protected $table = 'industri';
    protected $primaryKey = 'id_industri';
    protected $returnType     = 'object';
    protected $allowedFields = '*';
    protected $useTimestamps = true;
}
?>