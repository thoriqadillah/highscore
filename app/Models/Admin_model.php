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
        $hashed_pass = $admin['password'];

        if ($admin && password_verify($password, $hashed_pass)) {
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

    public function get_post_Inadmin() {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name', 'p.created_at'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->orderBy('p.created_at', 'DESC');
        $query = $builder->get();

        return $query;
    }

    public function search_InAdmin($keyword) {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name', 'p.created_at'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->like('u.username', $keyword)
        ->orLike('p.score', $keyword)
        ->orLike('g.name', $keyword)
        ->orderBy('p.created_at', 'DESC')
        ->orderBy('g.name', 'ASC');
        $query = $builder->get();

        return $query;
    }

    public function verify($id) {
        $builder = $this->db->table('post');
        $data = [
            'verified' => true
        ];
        $builder->set($data)
        ->where('id', $id)
        ->update();
    }

    public function unverify($id) {
        $builder = $this->db->table('post');
        $data = [
            'verified' => false
        ];
        $builder->set($data)
        ->where('id', $id)
        ->update();
    }

    public function get_post_by_game_inAdmin($where) {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->where($where)
        ->orderBy('p.created_at', 'DESC')
        ->orderBy('p.score', 'DESC');
        $query = $builder->get();

        return $query;
    }
}
