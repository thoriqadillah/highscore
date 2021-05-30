<?php

namespace App\Models;
use CodeIgniter\Model;
class Post_model extends Model {
    protected $table      = 'post'; //diisi nama tabel sesuai keinginan
    protected $useTimestamps = true;
    protected $allowedFields = ['image', 'score', 'user_id'];
    protected $builder;
    protected $db;

    public function __construct() {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('post');
    }
    
    public function get_post($where) {
        $this->builder->select('image', 'score', 'username', 'game_id', 'verified', 'name')
        ->join('users', 'users.email = post.user_email')
        ->join('games', 'games.id = post.game_id')
        ->where($where)
        ->groupBy('name')
        ->orderBy('score', 'DESC');
        $query = $this->builder->get();

        return $query;
    }

    public function get_post_by_game($where) {
        $this->builder->select('image', 'score', 'username', 'game_id', 'verified', 'name')
        ->join('users', 'users.email = post.user_email')
        ->where($where)
        ->orderBy('score', 'DESC');
        $query = $this->builder->get();

        return $query;
    }

}
