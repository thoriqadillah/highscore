<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  
use App\Models\Post_model;  
use App\Models\Games_model;
use CodeIgniter\CodeIgniter;

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
		$where_condition = [
			'p.verified' => true
		];
		$keyword = $this->req->getVar('keyword');

		if ($keyword) {
			$result = $this->post_model->search($keyword, $where_condition)->getResultArray();
			if ($result == false) {
				$post_data = $this->post_model->get_post($where_condition)->getResultArray();
				$this->session->setFlashdata('pesan', 'Data tidak ditemukan');
			} else {
				$post_data = $result;
			}
		} else {
			$post_data = $this->post_model->get_post($where_condition)->getResultArray(); //post data hanya menampilkan image, score, dan username
		}
		
		$data = [
			'title' => 'Halaman Tamu', //sebagai judul page, dikirim ke <title> pada view
			'posts' => $post_data,
			'games' => $this->games,
			'flashdata' => $this->session->getFlashdata('pesan')
		];
		return view('index', $data);	
	
	}
	
    public function upload() {
		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Upload',
				'session_data' => $this->session->get(),
				'games' => $this->games,
				'validation' => $this->validation
			];
			
			return view('upload', $data);	
		} 
		
		return redirect()->to('/login');
    }

	public function upload_post() {
		$request = \Config\Services::request();
		$score = $request->getVar('score');
		$game = $request->getVar('game');
		
		if(!$this->validate([
            'score' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Score tidak boleh kosong',
					'numeric' => 'Score harus berupa angka',
				]
			],
			'image' => [
				'rules' => 'uploaded[image]|max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'Screenshot tidak boleh kosong',
					'max_size' => 'Maksimal ukuran gambar adalah 5MB',
					'is_image' => 'Yang Anda pilih bukan gambar',
					'mime_in' => 'Yang Anda pilih bukan gambar'
				]
			],
			'game' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Game tidak boleh kosong'
				]
			]
        ])) {
			return redirect()->to('/upload')->withInput();
		}

		$image = $request->getFile('image');
		$namaImage = $image->getRandomName(); //generate nama random buat gambar
		$image->move('img', $namaImage);
		
		$this->post_model->save([
			'image' => $namaImage,
			'score' => $score,
			'user_email' => $this->session->get('user_email'),
			'game_id' => $game
		]);
		$this->session->setFlashdata('berhasil', 'Berhasil memposting. Mohon tunggu untuk diverifikasi terlebih dahulu');
		return \redirect()->to('/user_post');
	}
	
	//buat nampilin halaman home buat user
	public function home() {
		$where_condition = [
			'p.verified' => true
		];
		$keyword = $this->req->getVar('keyword');

		if ($keyword) {
			$result = $this->post_model->search($keyword, $where_condition)->getResultArray();
			if ($result == false) {
				$post_data = $this->post_model->get_post($where_condition)->getResultArray();
				$this->session->setFlashdata('pesan', 'Data tidak ditemukan');
			} else {
				$post_data = $result;
			}
		} else {
			$post_data = $this->post_model->get_post($where_condition)->getResultArray(); //post data hanya menampilkan image, score, dan username
		}

		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Home', //sebagai judul page, dikirim ke <title> pada view
				'posts' => $post_data,
				'session_data' => $this->session->get(),
				'games' => $this->games,
				'flashdata' => $this->session->getFlashdata('pesan')
			];
			return view('home', $data);
		}

		return redirect()->to('/login');
	
	}

	public function games($id) {
		$where_condition = [
			'p.verified' => true,
			'p.game_id' => $id
		];
		$keyword = $this->req->getVar('keyword');

		if ($keyword) {
			$result = $this->post_model->search($keyword, $where_condition)->getResultArray();
			if ($result == false) {
				$post_data = $this->post_model->get_post_by_game($where_condition)->getResultArray();
				$this->session->setFlashdata('pesan', 'Data tidak ditemukan');
			} else {
				$post_data = $result;
			}
		} else {
			$post_data = $this->post_model->get_post_by_game($where_condition)->getResultArray(); //post data hanya menampilkan image, score, dan username
		}
		
		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'Games', //sebagai judul page, dikirim ke <title> pada view
				'posts' => $post_data,
				'session_data' => $this->session->get(),
				'games' => $this->games,
				'flashdata' => $this->session->getFlashdata('pesan')
			];

			return view('games', $data);
		}

		$data = [
			'title' => 'Games', //sebagai judul page, dikirim ke <title> pada view
			'posts' => $post_data,
			'games' => $this->games,
			'flashdata' => $this->session->getFlashdata('pesan')
			];
		return view('games', $data);
	}

	public function logout() {
		$array_items = ['username', 'logged_in', 'level'];
		$this->session->remove($array_items);
		
		return redirect()->to('/');
	}

	public function user_post() {
		$where_condition = [
			'u.username' => $this->session->get('username')
		];
		$post_data = $this->post_model->get_post($where_condition)->getResultArray(); 

		if ($this->session->get('logged_in') == true && $this->session->get('level') == 'user') {
			$data = [
				'title' => 'My Post', //sebagai judul page, dikirim ke <title> pada view
				'posts' => $post_data,
				'session_data' => $this->session->get(),
				'games' => $this->games,
				'flashdata' => $this->session
			];
			return view('user_post', $data);
		}

		return redirect()->to('/login');
	}

}
