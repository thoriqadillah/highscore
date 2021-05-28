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

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();
        $this->games_model = new Games_model();
        $this->req = \service('request');

        $this->games = $this->games_model->findAll();
	}

    //tampilin halaman login
	public function index() {
		$data = [ //jangan lupa $data nanti dikirimkan ke return view ya
			'title' => 'Home',
            'games' => $this->games
		];

        return view('login', $data);
	}

    //buat ngeproses login
    public function signin() {
        $email = $this->req->getVar("email");
        $pass = $this->req->getVar("pass");

        if ($this->users_model->can_login_user($email, $pass)) {
            return \redirect()->to('/home');
        } else if ($this->admin_model->can_login_admin($email, $pass)) {
            return \redirect()->to('/admin');
        }

        return \redirect()->to('/login');
    }

    
}