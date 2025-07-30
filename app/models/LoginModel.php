<?php

class LoginModel {
	
	private $table = 'a_user';
	private $db;
	private $db2;
	public function __construct()
	{
		$this->db2 = new Database;
	}

	public function checkLogin($data)
	{
		
		
		$username =  addslashes($data["username"]);
		$pass = addslashes($data["password"]);

		$datas =[
			"username"=>$username,
			"pass"=>$pass
		];
		$url =base_urlport.'/login/proses';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$datas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name.txt');  
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie-name.txt');
		$hasil=curl_exec($ch);
		curl_close ($ch);



		$chs = curl_init($url);

		// Set opsi cURL
		curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1);

		// Eksekusi cURL dan simpan respons
		$response = curl_exec($chs);
		die(var_dump($response));
		// Periksa apakah ada kesalahan
		if (curl_errno($ch)) {
			echo 'Error: ' . curl_error($ch);
		}

				// Tutup sesi cURL
				curl_close($ch);

// Proses respons JSON menjadi array
			$dataArray = json_decode($response, true);

					
}
	
	
	public function getDataDivisi(){
		$query ="SELECT DISTINCT divisi_budget FROM  $this->table WHERE divisi_budget <>'NULL'";
		$result =$this->db2->baca_sql2($query);
			
			$data =[];
			while(odbc_fetch_row($result)){
				$data[] = array(
					"divisi_budget"=>rtrim(odbc_result($result,'divisi_budget')),

				);
				
				}
				
		return $data;
	}

}