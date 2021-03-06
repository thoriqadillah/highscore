<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;
use App\Models\Games_model;

class Registration extends BaseController {
	protected $users_model;
	protected $admin_model;
	protected $req;
	protected $games_model;
	protected $validation;
	protected $session;

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();  
		$this->games_model = new Games_model();
        $this->req = \service('request');

        $this->games = $this->games_model->findAll(); 
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
	}

    //tampilin halaman sign up
	public function index() {
		$data = [ //jangan lupa $data nanti dikirimkan ke return view ya
			'title' => 'Sign Up',
			'games' => $this->games ,
			'validation' => $this->validation
		];

        return view('signup', $data);
	}

    //buat ngeproses sign up
    public function signup() {
		$request = \Config\Services::request();

		if(!$this->validate([
            'email' => [
				'rules' => 'required|is_unique[users.email]',
				'errors' => [
					'required' => 'Email tidak boleh kosong',
					'is_unique' => 'Email sudah digunakan'
				]
			],
			'username' => [
				'rules' => 'required|is_unique[users.username]',
				'errors' => [
					'required' => 'Username tidak boleh kosong',
					'is_unique' => 'Username sudah digunakan'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password tidak boleh kosong'
				]
			],
			'repeat-password' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'Password tidak boleh kosong',
					'matches' => 'Password tidak sama'
				]
			]
        ])) {
			return redirect()->to('/registration')->withInput()->with('validation', $this->validation);
		}

		$email = $request->getVar('email');
		$username = $request->getVar('username');
        $pass = $request->getVar('password');
		
		$this->users_model->insert([
			'email' => $email,
			'username' => $username,
			'password' => password_hash($pass, PASSWORD_BCRYPT)
		]);

		$this->session->setFlashdata('registrasi', 'Pendaftaran akun berhasil. Silahkan login');
		return \redirect()->to('/login');
		

        return redirect()->to('/registration');
    }

    
}