<?php

namespace App\Controllers;

use App\Models\Highscore_model;

class Highscore extends BaseController {
	protected $highscore;
	protected $session;
	protected $rrequest;

	public function __construct() {
		$this->highscore = new Highscore_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->session = \Config\Services::session();
		$this->rrequest = service('request');
	}

	public function index() {
		$data = [
			'title' => 'Home' //sebagai judul page, dikirim ke <title> pada view
			//untuk memanggil model bisa dilempar ke $data sebagai key dan value, kemudian dikirim data ke view dan dilooping menggunakan foreach
			//'namaVar' => '$this->namaModel->namaMethod();'
		];
		// return view('index', $data); //memanggil view dengan mengirimkan data
		return view('index', $data);
	}

	public function login() {
		$data = [
			'title' => 'Home'
		];
		return view('login', $data);
	}
	
	public function login_process() {
		$email = 'coba@coba.com';
		$pass = 'coba';

		if ($this->highscore->can_login_user($email, $pass) && $this->session->get('logged_in')) {
			return redirect()->to('home');
		}

		return redirect()->to('login');
	}
}
