<?php

namespace App\Models;
use CodeIgniter\Model;
class Games_model extends Model {
    protected $table      = 'games'; //diisi nama tabel sesuai keinginan
    protected $useTimestamps = true;
    protected $allowedFields = ['name'];
    
    public function findRow($where) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM games WHERE id = $where LIMIT 1");
        $row   = $query->getRow();

        return $row;
    }
}
