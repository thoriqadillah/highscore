<?php

namespace App\Models;
use CodeIgniter\Model;
class Users_model extends Model {
    protected $table      = 'users'; //diisi nama tabel sesuai keinginan
    protected $primaryKey = 'email';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'username', 'password'];

    public function getTable($slug = false) { //semisal untuk mengambil row spesifik tabel, bisa menggunakan slug (jika ada)
        if ($slug == false) { //jika tidak ada, maka kembalikan semua isi tabel
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first(); //mengambil data tabel dengan klausa where, dan ambil hasil pertama saja
        
        //atau, jika ingin mengembalikan single row dengan id nya, parameternya bisa diganti dengan id, kemudian
        //$this->find($id); 
    }

    public function can_login_user($email, $password) {
        $session = \Config\Services::session();
        $user = $this->first($email);

        if ($user && $password == $user["password"]) {
            $data_session = [
                'username' => $user['username'],
                'logged_in' => TRUE,
                'level' => 'user'
            ];
            $session->set($data_session);
            return true;
        }

        return false;
    }

}
