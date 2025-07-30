<?php

class ExpordData extends Controller {
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
		
		$data['page'] = "expor";
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('exporddata/index');
		$this->view('templates/footer');
	
	}


	

	 public function Kirimdata(){
		$data =$this->model('ImporDataModel')->Simpandata($_POST);
		if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }

	 }






	public function cetakpdf(){
		
	

		$url ="/absensi/gedatapdf";
		$data =$_POST;
		
		$response = $this->http->Requestdata($url,$data);

		/*$besturl = base_urlport.$url;
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_POST, true);
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
		
	    $this->view('exporddata/cetakpdf',$datafull);
	}


	public function cetakpdfdetail(){
		
	
		
		$url ="/absensi/getdatagapokpdf";
		$data =$_POST;
		$response = $this->http->Requestdata($url,$data);

		/*$besturl = base_urlport.$url;
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_POST, true);
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
		
	    $this->view('exporddata/cetakpdfdetail',$datafull);
	}


	public function getdatabensi(){

	
		$data =$_POST;
		$url ="/absensi/getdatabsensiuser";
		$response = $this->http->Requestdata($url,$data);
		
	    echo $response;
		
	}


	public function getabmasalah(){
		$data = $_POST;
		$url ="/absensi/getabdatamsh";
		$response = $this->http->Requestdata($url,$data);
		
	    echo $response;
	}


	public function getabsenisByID(){
		$data = $_POST;
		$url = "/absensi/getabmshbyid";
		$response = $this->http->Requestdata($url,$data);
		
	    echo $response;
	}


	public function getdataUserKosong(){
		$data =$_POST;
		
		$url ="/absensi/getdataUserkosong";
		$response = $this->http->Requestdata($url,$data);
		
	
	    echo $response;
	}


	
	public function TampildataAbsensi(){
	
		$data =$_POST;
		$url ="/absensi/gettampilabsensisajah";
		$response = $this->http->Requestdata($url,$data);
		
	    echo $response;
	}



	public function SaveDataKoreksiAbsen(){
	
		$data =$_POST;
	
		$url ="/absensi/savedatakoreksi";
		$response = $this->http->Requestdata($url,$data);

	    echo $response;
	}


	public function DeleteDataKoreksiAbsen(){
	
		$data =$_POST;
		$url ="/absensi/deletedatakoreksi";
		$response = $this->http->Requestdata($url,$data);

	    echo $response;
	}

	public function TampildataFullAbsensi(){
	
		$data =$_POST;
		$url ="/absensi/tampilfullabsensihasil";
		$response = $this->http->Requestdata($url,$data);
		
	    echo $response;
	}
}