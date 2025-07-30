<?php

class Home extends Controller {

	public function __construct()
	{	
		
		if($_SESSION['session_login'] != 'sudah_login') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
  }	
	public function index()
	{
	
		$data['page'] = "home";
		$data['title'] = 'Halaman Home';

		//$userlog =(isset($_SESSION['login_user']))? $_SESSION['login_user'] : ''; 
	

		// if($userlog =='') {
		// 	$this->view('templates/header');
		// 	$this->view('templates/alertlog');
		// }else{
			$data['pages'] = "home";
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('home/index', $data);
			//$this->view('templates/footer');
		//}
	
	}
}