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

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();
		$this->post_model = new Post_model();
		$this->games_model = new Games_model();

		$this->session = \Config\Services::session();

		\helper('url');
	}

	//ini buat halaman tamu
	public function index() {
		$data = [
			'title' => 'Guests' //sebagai judul page, dikirim ke <title> pada view
			//untuk memanggil model bisa dilempar ke $data sebagai key dan value, kemudian dikirim data ke view dan dilooping menggunakan foreach
			//'namaVar' => '$this->namaModel->namaMethod();'
		];

		// return view('index', $data); //memanggil view dengan mengirimkan data
		return view('index', $data);
	}

    public function upload() {
		// $this->users_model->can_login_user('coba@coba.com', 'coba');
		// dd($this->session->get('logged_in'));
		// session_destroy();
		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Upload'
			];
	
			return view('upload', $data);	
		} 

		return redirect()->to('/login');
    }
	
	//buat nampilin halaman home buat user
	public function home() {
		if ($this->session->get('logged_in') && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Home' //sebagai judul page, dikirim ke <title> pada view
			];

			return view('home', $data);	
		}

		return redirect()->to('/login');
	
	}

	//buat nampilin halaman admin
	public function admin() {
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$data = [
				'title' => 'Admin' //sebagai judul page, dikirim ke <title> pada view
			];

			return view('admin', $data);	
		}

		return redirect()->to('/login');
	}
}
