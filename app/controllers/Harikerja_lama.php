<?php

class Harikerja_lama extends Controller {
	
	
	
	
	public function Getharikj(){
		
		
		$url =base_urlport.'/harikerja/getharikj';
		
		$result = $this->Requestdata($url,$_POST);
		
		echo $result;
	}
	
	
	
	private function Requestdata($url,$data){
		
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		curl_close($curl);
		
		
		return $response;
	
		
	}
	
}



?>