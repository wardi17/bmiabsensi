<?php

class Gapok extends Controller {
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
       
		$data['page'] = "gapok";
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('gapok/index');
		$this->view('gapok/edit_data');
		$this->view('templates/footer');
	
	}



    public function GetDataTampil(){
		$data =$_POST;
		$url ='/master_op/getdataop';
		//$response = $this->http->GetRequestdata($url);
		$response = $this->http->Requestdata($url,$data);
		echo $response;
		
	}


	public function editdata(){
		
	
		$data =$_POST;
		$url ='/master_op/updatedatagapok';
		$response = $this->http->Requestdata($url,$data);
		
		echo $response;
	}



	public function cetakpdf(){
		$data =$_POST;
		$url ='/master_op/getdataop';
		//$response = $this->http->GetRequestdata($url);
		$response = $this->http->Requestdata($url,$data);

		$datafull = json_decode($response);
		$this->view('gapok/cetakpdf',$datafull);

	}
}