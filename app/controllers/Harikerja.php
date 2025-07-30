<?php

class Harikerja extends Controller {
	private $http;
	public function __construct()
	{	
		
		if($_SESSION['session_login'] != 'sudah_login') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			header('location: '. base_url . '/login');
			exit;
		}else{
			$this->http = new Response;
		}


  }
	public function index()
	{
		$data['page'] = "hari";
	

		//$userlog =(isset($_SESSION['login_user']))? $_SESSION['login_user'] : ''; 
	

		// if($userlog =='') {
		// 	$this->view('templates/header');
		// 	$this->view('templates/alertlog');
		// }else{
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('harikerja/edit_data');
			$this->view('harikerja/tambah');
			$this->view('harikerja/index', $data);
			$this->view('templates/footer');
		//}
	
	}

	public function AbsMasalah(){
	
		$data['page'] = "masalah";
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('exporddata/masalah');
		$this->view('templates/footer');
	}


	public function Getharikj(){
		
	
		$data =$_POST;
		$url ='/harikerja/getharikj';
		$response = $this->http->Requestdata($url,$data);
		
		echo $response;
	}
	
	


	
	public function GetDataTampil(){
		$data = $_POST;
		$url ='/harikerja/gettampilhk';
		$response = $this->http->Requestdata($url,$data);
		echo $response;
	}


	public function Editdata(){
		$data = $_POST;
		$url ='/harikerja/updatedataHk';
		$response = $this->http->Requestdata($url,$data);
		echo $response;
	}


	public function tambahhk(){
		$data = $_POST;
		$url ='/harikerja/crateharikerja';
		$response = $this->http->Requestdata($url,$data);
		echo $response;
	}
}