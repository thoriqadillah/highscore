<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  
use App\Models\Post_model;  
use App\Models\Games_model;  

class Highscore extends BaseController {
	protected $users_model;
	protected $admin_model;
	protected $post_model;
	protected $games_model;

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();
		$this->post_model = new Post_model();
		$this->games_model = new Games_model();
	}

	//ini buat halaman tamu
	public function index() {
		$data = [
			'title' => 'Home' //sebagai judul page, dikirim ke <title> pada view
			//untuk memanggil model bisa dilempar ke $data sebagai key dan value, kemudian dikirim data ke view dan dilooping menggunakan foreach
			//'namaVar' => '$this->namaModel->namaMethod();'
		];

		
		// return view('index', $data); //memanggil view dengan mengirimkan data
		return view('index', $data);
	}

	//buat validasi aja, misal kalo belum login nanti gabisa upload, harus login dulu
    public function upload() {
        //misal user pengen upload, cek dulu dia udah logged_in belum di session nya
        //jika logged in true, yaudah diarahin ke halaman upload
        //kalo false ke halaman login
    }
	
	//buat nampilin halaman home buat user
	public function home() {
		$data = [
			'title' => 'Home' //sebagai judul page, dikirim ke <title> pada view
		];
		//buat validasi lagi biar gaboleh masuk kalo misal maksa masuk halaman controller/function lewat url bar
		
		//cek dulu dia udah logged_in belum di session nya
		//jika logged in true, yaudah diarahin ke halaman home buat user
		//kalo false ke halaman login
	
	}

	//buat nampilin halaman admin
	public function admin() {
		$data = [
			'title' => 'Home' //sebagai judul page, dikirim ke <title> pada view
		];
		//ini juga dibuat validasinya juga ya, sama kaya user


	}
}
