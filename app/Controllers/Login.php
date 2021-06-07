<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;
use App\Models\Games_model;

class Login extends BaseController {
	protected $users_model;
	protected $admin_model;
    protected $games_model;
    protected $req;
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

    //tampilin halaman login
	public function index() {
		$data = [ //jangan lupa $data nanti dikirimkan ke return view ya
			'title' => 'Home',
            'games' => $this->games,
            'validation' => $this->validation,
            'login' => $this->session->getFlashdata('registrasi')
		];

        return view('login', $data);
	}

    //buat ngeproses login
    public function signin() {
        $email_user = $this->req->getVar("email");
        $email_admin = $this->req->getVar("email");
        $pass = $this->req->getVar("password");

        if(!$this->validate([
            'email' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Email tidak boleh kosong'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password tidak boleh kosong'
				]
			]
        ])) {
			return redirect()->to('/login')->withInput()->with('validation', $this->validation);
		}

        if ($this->admin_model->can_login_admin($email_admin, $pass)) {
            return \redirect()->to('/admin');
        } else if ($this->users_model->can_login_user($email_user, $pass)) {
            return \redirect()->to('/home');
        }

        return \redirect()->to('/login');
    }

    
}