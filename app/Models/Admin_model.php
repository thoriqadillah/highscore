<?php

namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model {
    protected $table      = 'admin'; //diisi nama tabel sesuai keinginan
    protected $primaryKey = 'email';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'username', 'password'];

    public function can_login_admin($email, $password) {
        $session = \Config\Services::session();
        $admin = $this->first($email);

        if ($admin && $password == $admin["password"]) {
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
