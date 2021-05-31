<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  
use App\Models\Post_model;  
use App\Models\Games_model;  

class Highscore extends BaseController {
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

	//ini buat halaman tamu
	public function index() {
		//bagian sini juga ngerjain kaya di function admin

		$data = [
			'title' => 'Guests', //sebagai judul page, dikirim ke <title> pada view
			'games' => $this->games
			//untuk memanggil model bisa dilempar ke $data sebagai key dan value, kemudian dikirim data ke view dan dilooping menggunakan foreach
			//'namaVar' => '$this->namaModel->namaMethod();'
		];
		
		// return view('index', $data); //memanggil view dengan mengirimkan data
		return view('index', $data);
	}
	
    public function upload() {
		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Upload',
				'session_data' => $this->session->get(),
				'games' => $this->games
			];
			
			return view('upload', $data);	
		} 
		
		return redirect()->to('/login');
    }
	
	//buat nampilin halaman home buat user
	public function home() {
		//bagian sini juga ngerjain kaya di function admin

		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Home', //sebagai judul page, dikirim ke <title> pada view
				'session_data' => $this->session->get(),
				'games' => $this->games
			];
			
			return view('home', $data);	
		}

		return redirect()->to('/login');
	
	}

	public function games($id) {
		//cara kerjanya sama kaya admin, cuma ditambahin di $where_condition 'id' = $id
	}

	public function logout() {
		$array_items = ['username', 'logged_in', 'level'];
		$this->session->remove($array_items);
		
		return redirect()->to('/');
	}

}
