<?php

class UserModel {
	
	private $table = 'a_user';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllUser()
	{
	
		// $this->db->query('SELECT * FROM ' . $this->table);
		// return $this->db->resultSet();
	}

	// public function getUserById($data)
	// {
	// 	$email = $this->test_input($data["email"]);
	// 	$query = "SELECT * FROM $this->table  WHERE email='".$email."' ";
	// 	$result = $this->db->baca_sql($query);
	// 	$data =[];
	// 	while(odbc_fetch_row($result)){
	// 		$data[] = array(
	// 			"nama"=>rtrim(odbc_result($result,'nama')),
	// 			"email"=>rtrim(odbc_result($result,'email')),
	// 			"password"=>rtrim(odbc_result($result,'password')),
	// 			"divisi"=>rtrim(odbc_result($result,'divisi')),
	// 			"jabatan"=>rtrim(odbc_result($result,'jabatan')),

	// 		);
			
	// 		}
	// 	// echo "<pre>";
	// 	// print_r($data);
	// 	// echo "</pre>";die();
	// 	return $data;		
	// }

	// public function tambahUser($data)
	// {
	// 		$nama_user =$this->test_input($data["nama_user"]);
	// 		$Email =$this->test_input($data["Email"]);
	// 		$password =$this->test_input($data["password"]);
	// 		$jabatan =$this->test_input($data["jabatan"]);
	// 		$divisi =$this->test_input($data["divisi"]);
				
	// 		$cek =0;
	// 		$sql="INSERT INTO $this->table (nama,email,password,divisi,jabatan) 
	// 		Values ('". $nama_user ."','".$Email."','".$password."','".$divisi."','".$jabatan."')"; 
	// 		$result = $this->db->baca_sql($sql);
	// 		if(!$result){
	// 		$cek =$cek+1;
	// 		}
		
	// 		if ($cek==0){
	// 		$status['nilai']=1; //bernilai benar
	// 		$status['error']="Data Berhasil Ditambahkan";
	// 		}else{
	// 		$status['nilai']=0; //bernilai benar
	// 		$status['error']="Data Gagal Ditambahkan";
	// 		}	
		
	// 	return $status;

		
	// }

	// public function UserTampil(){
	// 	$query = "SELECT * FROM $this->table  ORDER BY nama  ASC";
		
	// 	//$query ="dailyactivityuser_sp";
		
	// 	$result = $this->db->baca_sql($query);
	// 	$data =[];
	// 	while(odbc_fetch_row($result)){
	// 		$data[] = array(
	// 			"nama"=>rtrim(odbc_result($result,'nama')),
	// 			"email"=>rtrim(odbc_result($result,'email')),
	// 			"password"=>rtrim(odbc_result($result,'password')),
	// 			"divisi"=>$this->get_Divisi(rtrim(odbc_result($result,'divisi'))),
	// 			"jabatan"=>$this->get_Jabatan(rtrim(odbc_result($result,'jabatan'))),

	// 		);
			
	// 		}
	// 	return $data;
	// }

	// public function get_Divisi($divisi){
	// 	$query = "SELECT nama_divisi FROM DailyActivity_divisi  WHERE kode_divisi ='".$divisi."'";
	// 	$result = $this->db->baca_sql($query);
	// 	$arr = odbc_fetch_array($result);
	// 	$nama_div = $arr['nama_divisi'];
	// 	return $nama_div;

	// }

	// public function get_Jabatan($kode){
	// 	$query = "SELECT nama_jabatan FROM DailyActivity_jabatan  WHERE kode_jabatan ='".$kode."'";
	// 	$result = $this->db->baca_sql($query);
	// 	$arr = odbc_fetch_array($result);
	// 	$nama_jab = $arr['nama_jabatan'];
	// 	return $nama_jab;

	// }


	// public function validasiPassword(){
	// 	$password = $_POST['password'];
	// 	$uppercase = preg_match('@[A-Z]@', $password);
	// 	$lowercase = preg_match('@[a-z]@', $password);
	// 	$number    = preg_match('@[0-9]@', $password);
	// 	$specialChars = preg_match('@[^\w]@', $password);
		
	// 	if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
	// 		$st_pass['nilai'] =0;
	// 		$st_pass['pesan'] ='Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter.';
	// 	}else{
	// 		$st_pass['nilai'] =1;
	// 		$st_pass['pesan'] ='Strong password.';
	// 	}
	// 	return $st_pass;
	// }
	// public function cekUsername(){
	
	// 	$username = $_POST['Email'];
	// 	$query = "SELECT DISTINCT * FROM $this->table where email ='$username' ";
	// 	$sql=$this->db->baca_sql($query);
	// 	$rows= odbc_fetch_array($sql);
	// 	return $rows;

	// }

	// public function deleteUser($data){
	// 	$email = $this->test_input($data["email"]);
	// 	$sql="DELETE FROM $this->table WHERE email = '".$email."'"; 
	// 	$result = $this->db->baca_sql($sql);
	
	// 	//$sql2="DELETE FROM member_Status_kunjungan WHERE kode_Status = '".$kode_Status."' "; 
	// 		//$result2 = odbc_exec($connection, $sql2); 
	// 	$cek = 0;
	// 	if(!$result){
	// 		$cek = $cek+1;
	// 	}
	// 	if ($cek==0){
	// 		$status['nilai']=1; //bernilai benar
	// 		$status['error']="Data Berhasil Dihapus";
	// 	}else{
	// 		$status['nilai']=0; //bernilai benar
	// 		$status['error']="Data Gagal Dihapus";
  	// 	}
	// 	return $status;
	// }


	// public function updateDataUser($data)
	// {	
	// 	// echo "<pre>";
	// 	// print_r($data);
	// 	// echo "</pre>"; die();
	// 	$nama_user = $this->test_input($data["nama_user"]);
	// 	$password = $this->test_input($data["password"]);
	// 	$email = $this->test_input($data["email"]);
	// 	$jabatan =$this->test_input($data["jabatan"]);
	// 	$divisi =$this->test_input($data["divisi"]);
	
	// 	$sql="UPDATE $this->table SET nama = '". $nama_user ."', password = '". $password ."', divisi = '". $divisi ."',jabatan = '". $jabatan ."'
	// 	WHERE email = '". $email ."' "; 
	
	// 	$result = $this->db->baca_sql($sql);
	// 	$cek =0;
	// 	if(!$result){
	// 	$cek = $cek+1;
	// 	}
	// 	if ($cek==0){
	
	// 	$status="Data Berhasil di edit";
	// 	}else{
		
	// 	$status="Data Gagal di edit";
	// 	}
	// 	return $status;;
	// }


	// public function getDataUserFilter($data)
	// {
	// 	$kode_div = $this->test_input($data["divisi"]);
	// 	if($kode_div !==""){
	// 	$query = "SELECT * FROM $this->table  WHERE divisi ='".$kode_div."'";
	// 	$result = $this->db->baca_sql($query);
	// 	$datas =[];
	// 	while(odbc_fetch_row($result)){
	// 		$datas[] = array(
	// 			"id_user"=>rtrim(odbc_result($result,'id_user')),
	// 			"nama"=>rtrim(odbc_result($result,'nama')),
	// 			"divisi_user"=>rtrim(odbc_result($result,'divisi')),
	// 		);
			
	// 		}
	// 	}else{
	// 		$datas ="";
	// 	}


	// 	return $datas;		
	// }

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}



		public function getdata(){
			
		}
}