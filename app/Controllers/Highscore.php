<?php

namespace App\Controllers;

use App\Models\Highscore_model;

class Highscore extends BaseController {
	protected $highscore;

	public function __construct() {
		$this->highscore = new Highscore_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
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
		dd($this->request->('email'));
		$data = [
			'title' => 'Home'
		];
		
		return view('login', $data);

	}
}
