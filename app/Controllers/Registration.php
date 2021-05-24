<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  

class Registration extends BaseController {
	protected $users_model;
	protected $admin_model;
	protected $req;

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();  
		$this->req = \service('request');  
	}

    //tampilin halaman sign up
	public function index() {
		$data = [ //jangan lupa $data nanti dikirimkan ke return view ya
			'title' => 'Sign Up' 
		];

        return view('signup', $data);
	}

    //buat ngeproses sign up
    public function signup() {
        $email = $this->req->getVar('email');
		$username = $this->req->getVar('username');
        $pass = $this->req->getVar('pass');
        $re_pass = $this->req->getVar('repass');

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