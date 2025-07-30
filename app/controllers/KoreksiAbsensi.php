<?php

class KoreksiAbsensi extends Controller {
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
	

	public function index(){
		
		$data['page'] = "report";
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('koreksiabsensi/index');
		$this->view('templates/footer');
	}


	public function dataKoreksi(){
		

		$data =$_POST;
		$url ='/koreksiabsensi/reportkoreksiabsen';
		$response = $this->http->Requestdata($url,$data);
		
		echo $response;
	}
	
	
  public function EditData(){
	$data =$_POST;
		$url ='/koreksiabsensi/editkoreksiabsen';
		$response = $this->http->Requestdata($url,$data);
		
		echo $response;
  }

	

  public function DeleteData(){

	$data =$_POST;
		$url ='/koreksiabsensi/deletedataKoreksi';
		$response = $this->http->Requestdata($url,$data);
		
		echo $response;
  }


  public function cetakpdf(){

	$url ="/koreksiabsensi/getdatakoreksipdf";
	$data =$_POST;
	$response = $this->http->Requestdata($url,$data);
	
		/*$besturl = base_urlport.$url;
	
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		curl_close($curl); */
	
	$datajson = json_decode($response);

	$header = [
		"tahun"=>$_POST["tahun"],
		"bulan"=>$_POST["bulan"],
	];

	$datafull =[
		"datajson"=>$datajson,
		"header"=>$header,
	];
	//die(var_dump($datafull));
	
	$this->view('koreksiabsensi/cetakpdf',$datafull);
  }


}