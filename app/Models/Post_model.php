<?php

namespace App\Models;
use CodeIgniter\Model;
class Post_model extends Model {
    protected $table      = 'post'; //diisi nama tabel sesuai keinginan
    protected $useTimestamps = true;
    protected $allowedFields = ['image', 'score', 'user_id', 'user_email', 'game_id'];
    protected $builder;
    protected $db;

    public function __construct() {
        $this->db      = \Config\Database::connect();
    }
    
    public function get_post($where) {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->where($where)
        ->orderBy('g.name', 'ASC')
        ->orderBy('p.score', 'DESC');
        $query = $builder->get();

        return $query;
    }

    public function get_post_by_game($where) {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->where($where)
        ->orderBy('p.score', 'DESC');
        $query = $builder->get();

        return $query;
    }

    public function search($keyword, $where) {
        $builder = $this->db->table('post p');
        $builder->select(array('p.id','p.image', 'p.score', 'u.username', 'p.game_id', 'p.verified', 'g.name'))
        ->join('users u', 'u.email=p.user_email')
        ->join('games g', 'g.id=p.game_id')
        ->like('u.username', $keyword)
        ->orLike('p.score', $keyword)
        ->orLike('g.name', $keyword)
        ->where($where)
        ->orderBy('g.name', 'ASC')
        ->orderBy('p.score', 'DESC');
        $query = $builder->get();

        return $query;
    }

    public function findRow($where) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM post WHERE id = $where LIMIT 1");
        $row   = $query->getRow();

        return $row;
    }

}
