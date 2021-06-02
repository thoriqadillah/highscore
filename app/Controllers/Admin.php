<?php

namespace App\Controllers;
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
		$keyword = $this->req->getVar('keyword');

		if ($keyword) {
			$result = $this->admin_model->search_InAdmin($keyword)->getResultArray();
			if ($result == false) {
				$post_data = $this->admin_model->get_post_Inadmin()->getResultArray();
				$this->session->setFlashdata('pesan', 'Data tidak ditemukan');
			} else {
				$post_data = $result;
			}
		} else {
			$post_data = $this->admin_model->get_post_Inadmin()->getResultArray(); //post data hanya menampilkan image, score, dan username
		}
    
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$data = [
				'title' => 'Admin', //sebagai judul page, dikirim ke <title> pada view
				'session_data' => $this->session->get(),
				'posts' => $post_data,
				'games' => $this->games,
				'flashdata' => $this->session->getFlashdata('pesan')
			];
			return view('admin/indexAdmin', $data);	
			
        }
        
		return redirect()->to('/login');
	}
	
	public function games($id) {
		$where_condition = [
            'p.game_id' => $id
        ];
		$keyword = $this->req->getVar('keyword');
		if ($keyword) {
			$result = $this->admin_model->search_InAdmin($keyword)->getResultArray();
			if ($result == false) {
				$post_data = $this->post_model->get_post($where_condition)->getResultArray();
				$this->session->setFlashdata('pesan', 'Data tidak ditemukan');
			} else {
				$post_data = $result;
			}
		} else {
			$post_data = $this->post_model->get_post($where_condition)->getResultArray(); //post data hanya menampilkan image, score, dan username
		}
		
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$data = [
				'title' => 'Admin', //sebagai judul page, dikirim ke <title> pada view
				'session_data' => $this->session->get(),
				'posts' => $post_data,
				'games' => $this->games,
				'flashdata' => $this->session->getFlashdata('pesan')
			];
			return view('admin/gamesAdmin', $data);	
        }
        
		return redirect()->to('/login');
	}

	public function logout() {
		$array_items = ['username', 'logged_in', 'level'];
		$this->session->remove($array_items);
		
		return redirect()->to('/');
	}

	public function verify($id) {
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$this->post_model->verify($id);
			return redirect()->to('/admin');
		}

		return redirect()->to('/login');
	}

	public function unverify($id) {
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$this->post_model->verify($id);
			return redirect()->to('/admin');
		}

		return redirect()->to('/login');
	}

	public function delete($id) {
		if ($this->session->get('logged_in') && $this->session->get('level') == 'admin') {
			$this->post_model->delete($id);
			return redirect()->to('/admin');
		}

		return redirect()->to('/login');
	}

	

}
