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
    
    public function getTable($slug = false) { //semisal untuk mengambil row spesifik tabel, bisa menggunakan slug (jika ada)
        if ($slug == false) { //jika tidak ada, maka kembalikan semua isi tabel
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first(); //mengambil data tabel dengan klausa where, dan ambil hasil pertama saja
        
        //atau, jika ingin mengembalikan single row dengan id nya, parameternya bisa diganti dengan id, kemudian
        //$this->find($id); 
    }

    public function get_post($where) {
        $this->builder->select('image', 'score', 'user_email', 'game_id')
        ->join('users', 'user.id = post.user_id')
        ->join('games', 'games.id = post.game_id')
        ->where($where)
        ->groupBy('games')
        ->orderBy('score', 'DESC');
        $query = $this->builder->get();

        return $query;
    }

    public function get_post_by_game($where) {
        $this->builder->select('image', 'score', 'user_email', 'game_id')
        ->join('users', 'user.id = post.user_id')
        ->join('games', 'games.id = post.game_id')
        ->where($where)
        ->orderBy('score', 'DESC');
        $query = $this->builder->get();

        return $query;
    }

}
