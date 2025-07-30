<?php

class User extends Controller {
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
		
		$data['title'] = 'Data User';
		$data['page'] = "user";
		//$data['user'] = $this->model('UserModel')->getAllUser();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('user/index', $data);
		$this->view('templates/footer');
	}


	public function setdatauser(){
	
		$data =$this->model('ImporDataModel')->SimpandataUser();
		if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }

	}


























	public function cari()
	{
		$data['title'] = 'Data User';
		$data['user'] = $this->model('UserModel')->cariUser();
		$data['key'] = $_POST['key'];
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('user/index', $data);
		$this->view('templates/footer');
	}

	public function editData(){
		$data['title'] = 'Edit User';
		$data['page'] = "user";
		$data['user'] = $this->model('UserModel')->getUserById($_POST);
		$data['divisi'] = $this->model('DivisiModel')->getDatadivisi();
		$data['jabatan'] = $this->model('JabatanModel')->getDataJabatan();
		$this->view('user/edit', $data);
	}

	public function tambah(){
		$data['title'] = 'Tambah User';
		$data['page'] = "user";	
		$data['divisi'] = $this->model('DivisiModel')->getDatadivisi();
		$data['jabatan'] = $this->model('JabatanModel')->getDataJabatan();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('user/create', $data);
		$this->view('templates/footer');
	}


	public function tampilData(){
		$data= $this->model('UserModel')->UserTampil();
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}
	public function simpanUser(){

		if($_POST['password'] == $_POST['ulangi_password']) {
			// $validasipws = $this->model('UserModel')->validasiPassword();
			// if($validasipws['nilai'] == 0){
			// 	die('masu');
			// 	$pesan = $validasipws['pesan'];
			// 	header('location: '. base_url . '/user/tambah',$pesan);
			// 	exit;
			// }
			$row = $this->model('UserModel')->cekUsername();
			if($row == true){
				Flasher::setMessage('Gagal','Username yang anda masukan sudah pernah digunakan!','danger');
				header('location: '. base_url . '/user/tambah');
				exit;	
			} else {

				if( $this->model('UserModel')->tambahUser($_POST) > 0 ) {
					//$pesan = $this->model('UserModel')->tambahUser($_POST);
				//	Flasher::setMessage('Berhasil',$pesan,'success');
					header('location: '. base_url . '/user');
					exit;	
				} else {
					Flasher::setMessage('Gagal','ditambahkan','danger');
					header('location: '. base_url . '/user');
					exit;	
				}
			}
		} else {
			Flasher::setMessage('Gagal','password tidak sama.','danger');
			header('location: '. base_url . '/user/tambah');
			exit;	
		}
		
	}

	public function updateUser(){	
	
		if($_POST['password'] =="") {
			$data ="Gagal Update password kosong";
			echo json_encode($data);
			exit;
		} else {
			if($_POST['password'] == $_POST['ulangi_password']) {
				$data= $this->model('UserModel')->updateDataUser($_POST);
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
			exit();
			}
		}
	}



	public function deleteData(){
		$data= $this->model('UserModel')->deleteUser($_POST);
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}


		public function getUser(){
		
		$data= $this->model('UserModel')->getDataUserFilter($_POST);
		
		if(empty($data)){
			$data = null;
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}
}