<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  
use App\Models\Post_model;  
use App\Models\Games_model;  

class Admin extends BaseController {
	protected $users_model;
	protected $admin_model;
	protected $post_model;
	protected $games_model;
	protected $session;
	protected $req;
	protected $games;
	protected $validation;

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();
		$this->post_model = new Post_model();
		$this->games_model = new Games_model();

		$this->session = \Config\Services::session();

		$this->req = \service('request');

		$this->games = $this->games_model->findAll();
		$this->validation =  \Config\Services::validation();
	}

	//ini buat halaman dashboard admin
	public function index() {
		$where_condition = array('p.verified' => false);
		$post_data = $this->post_model->get_post($where_condition)->getResultArray(); //post data hanya menampilkan image, score, dan username
        // dd($this->post_model->coba()->getResultArray());
        
        
		
		// if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
        // }
        
		// return redirect()->to('/login');
        $data = [
            'title' => 'Admin', //sebagai judul page, dikirim ke <title> pada view
            'session_data' => $this->session->get(),
            'posts' => $post_data,
            'games' => $this->games
        ];
        return view('admin/indexAdmin', $data);	
	}
	
	//buat nampilin halaman home buat admin, untuk mengecek apakah sudah bekerja dari otoritas adminnya
	public function home() {
		$where_condition = ['p.verified' => true];
		$post_data = $this->post_model->get_post($where_condition); //post data hanya menampilkan image, score, dan username
		
		// if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
				
		// }

		// return redirect()->to('/login');
        $data = [
				'title' => 'Admin', //sebagai judul page, dikirim ke <title> pada view
				'session_data' => $this->session->get(),
				'posts' => $post_data,
				'games' => $this->games
			];
			return view('admin/homeAdmin', $data);
	
	}

	//buat nampilin halaman admin
	

	public function games($id) {
		$where_condition = [
            'p.verified' => true,
            'p.game_id' => $id
        ];
		$post_data = $this->post_model->get_post($where_condition); //post data hanya menampilkan image, score, dan username
		
		// if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
        // }
        
		// return redirect()->to('/login');
        $data = [
            'title' => 'Admin', //sebagai judul page, dikirim ke <title> pada view
            'session_data' => $this->session->get(),
            'posts' => $post_data,
            'games' => $this->games
        ];
        return view('admin/gamesAdmin', $data);	
	}

	public function logout() {
		$array_items = ['username', 'logged_in', 'level'];
		$this->session->remove($array_items);
		
		return redirect()->to('/');
	}

	public function verify($id) {
        $this->post_model->verify($id);
        return redirect()->to('/adm');
	}

	public function delete($id) {
		$this->post_model->delete($id);
		return redirect()->to('/adm');
	}
}
