<?php

namespace App\Models;
use CodeIgniter\Model;
class Users_model extends Model {
    protected $table      = 'users'; //diisi nama tabel sesuai keinginan
    protected $primaryKey = 'email';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'username', 'password'];

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
