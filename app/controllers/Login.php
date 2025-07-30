<?php

class Login extends Controller {
	private $http;

	public function __construct()
	{
		$this->http = new Response;
	}
	public function index()
	{
		$data['title'] = 'Halaman Login';
	
		$this->view('login/login', $data);
	}

	public function prosesLogin() {
		
		$url ='/login/proses';
		$data =$_POST;
	
		$response = $this->http->Requestdata($url,$data);

		$datajson = json_decode($response);
		//die(var_dump($_POST['id_user']));
		if($datajson !==NULL){
			  if($datajson->nama =="Rita" OR $datajson->nama =="Wardi" OR $datajson->nama =="Herman_MG" ){
				$akseposting ='Y';
			  }else{
				$akseposting ='N';
			  }
			$_SESSION['level_user'] = $akseposting; 
			$_SESSION['id_user'] = $datajson->id_user;
			$_SESSION['login_user'] =  $datajson->username;
			$_SESSION['nama'] = $datajson->nama;
			$_SESSION['session_login'] = 'sudah_login'; 
			$_SESSION['divisi'] =  $datajson->divisi;
			$_SESSION['jabatan'] = $datajson->jabatan;
			$_SESSION['log_menu'] = $datajson->log_menu;
			header('location: '. base_url . '/home');
		}else{
			// header('location: '. base_url . '/login');
			// exit;

			$this->view('templates/header');
			$this->view('templates/alertlog');
			$this->view('templates/footer');
		}

	}


	public function prosesLoginAjax() {
		
		//die(var_dump($_POST['id_user']));
		$_SESSION['id_user'] = $_POST['id_user'];
		$_SESSION['login_user'] =  $_POST['username'];
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['session_login'] = 'sudah_login'; 
		$_SESSION['divisi'] =  $_POST['divisi'];
		$_SESSION['jabatan'] = $_POST['jabatan'];
		$_SESSION['log_menu'] = $_POST['log_menu'];

		
		echo json_encode('ok');
		//if($row['username'])
		//header('location: '. base_url . '/home');
		
	}
}