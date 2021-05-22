<?php

namespace App\Controllers;
use App\Models\Users_model;  //mengambil Model pada folder Model dengan menggunakan namespace
use App\Models\Admin_model;  

class Registration extends BaseController {
	protected $users_model;
	protected $admin_model;

	public function __construct() {
		$this->users_model = new Users_model(); //untuk memanggil model sekali dan bisa digunakan berkali2
		$this->admin_model = new Admin_model();
	}

    //tampilin halaman login
	public function index() {
		$data = [ //jangan lupa $data nanti dikirimkan ke return view ya
			'title' => 'Sign Up' 
		];

        return view('signup', $data);
	}

    //buat ngeproses login
    public function signin() {
        //tutorial, kalo udah selesai mungkin bisa dihapus, atau dicut dimana gitu
        //ambil kiriman data email itu buat email user atau username admin
        //ambil juga passwordnya. Jadi nanti action diarahin ke sini

        //manfaatin function can_login dari user_model sama admin_model
        //kalo hasilnya true buat function user, redirect ke halaman home buat user (index buat tamu)
        //kalo hasilnya true buat function user, redirect ke halaman admin yang nanti dibuat dila

        //untuk nanti buat ngakses halaman admin, nanti buat controller admin lagi ya. Buat user pake highscore aja controllernya
    }

    
}