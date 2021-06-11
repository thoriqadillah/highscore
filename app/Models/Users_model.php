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
        $user = $this->find($email);
        $hashed_pass = $user['password'];
        
        if ($user && password_verify($password, $hashed_pass)) {
            $data_session = [
                'username' => $user['username'],
                'logged_in' => TRUE,
                'level' => 'user',
                'user_email' => $user['email'],
            ];
            $session->set($data_session);
            return true;
        }

        return false;
    }

}
