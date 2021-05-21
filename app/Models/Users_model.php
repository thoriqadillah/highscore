<?php

namespace App\Models;
use CodeIgniter\Model;
class Users_model extends Model {
    protected $table      = 'users'; //diisi nama tabel sesuai keinginan
    protected $primaryKey = 'email'; //diisi nama primary key dari tabel tersebut
    protected $useTimestamps = true; //digunakan ketika kita ingin menggunakan fitur otomatis pengisian data pada kolom created_at, updated_at pada tabel kita

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
        $user = $this->find($email);

        if ($user && $password == $user['PASSWORD']) {
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

    public function can_login_admin($email, $password) {
        $session = \Config\Services::session();
        $admin = $this->find($email);

        if ($admin && $password == $admin['PASSWORD']) {
            $data_session = [
                'username' => $admin['username'],
                'logged_in' => TRUE,
                'level' => 'admin'
            ];
            $session->set($data_session);

            return true;
        }

        return false; 
    }

}
