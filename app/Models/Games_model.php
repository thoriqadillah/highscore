<?php

namespace App\Models;
use CodeIgniter\Model;
class Games_model extends Model {
    protected $table      = 'games'; //diisi nama tabel sesuai keinginan
    protected $useTimestamps = true;
    protected $allowedFields = ['name'];
    
}
