<?php

namespace App\Models;
use CodeIgniter\Model;
class Games_model extends Model {
    protected $table      = 'games'; //diisi nama tabel sesuai keinginan
    protected $useTimestamps = true;
    protected $allowedFields = ['name'];
    
    public function getTable($slug = false) { //semisal untuk mengambil row spesifik tabel, bisa menggunakan slug (jika ada)
        if ($slug == false) { //jika tidak ada, maka kembalikan semua isi tabel
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first(); //mengambil data tabel dengan klausa where, dan ambil hasil pertama saja
        
        //atau, jika ingin mengembalikan single row dengan id nya, parameternya bisa diganti dengan id, kemudian
        //$this->find($id); 
    }

}
