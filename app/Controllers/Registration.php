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

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();  
		$this->games_model = new Games_model();
        $this->req = \service('request');

        $this->games = $this->games_model->findAll(); 
		$this->validation =  \Config\Services::validation();
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
        $email = $this->req->getVar('email');
		$username = $this->req->getVar('username');
        $pass = $this->req->getVar('password');
        $re_pass = $this->req->getVar('repeat-password');

		if(!$this->validate([
            'email' => [
				'rules' => 'required|is_unique[users.email]',
				'errors' => [
					'required' => '{field} tidak boleh kosong',
					'is_unique' => '{field} sudah digunakan'
				]
			],
			'username' => [
				'rules' => 'required|is_unique[users.username]',
				'errors' => [
					'required' => '{field} tidak boleh kosong',
					'is_unique' => '{field} sudah digunakan'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} tidak boleh kosong'
				]
			],
			'repeat-password' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => '{field} tidak boleh kosong',
					'matches' => 'password tidak sama'
				]
			]
        ])) {
			return redirect()->to('/registration')->withInput()->with('validation', $this->validation);
		}

		if ($pass == $re_pass) {
			$this->users_model->save([
				'email' => $email,
				'username' => $username,
				'password' => $pass
			]);
			return \redirect()->to('/login');
		}

        return redirect()->to('/registration');
    }

    
}