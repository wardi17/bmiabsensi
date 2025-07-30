<?php

class Response{



    public function Requestdata($url,$data){
		
		$besturl = base_urlport.$url;
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		curl_close($curl);
		
		
		
		
		return $response;
	
		
	}

	public function GetRequestdata($url){
		
		$besturl = base_urlport.$url;
		
	/*	$curl = curl_init($besturl);
		//curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);

		$response = curl_exec($curl);
		die(var_dump($response));
		curl_close($curl);
		*/
		
		
		$cURLConnection = curl_init();

		curl_setopt($cURLConnection, CURLOPT_URL,$besturl);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$phoneList = curl_exec($cURLConnection);
		die(var_dump($phoneList));
		curl_close($cURLConnection);
		return $response;
	
		
	}
}