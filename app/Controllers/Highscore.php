<?php

namespace App\Controllers;

use App\Models\NamaModel; //mengambil Model pada folder Model dengan menggunakan namespace

class Home extends BaseController {
	protected $namaModel;

	public function __construct() {
		$this->namaModel = new NamaModel(); //untuk memanggil model sekali dan bisa digunakan berkali2
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
}
