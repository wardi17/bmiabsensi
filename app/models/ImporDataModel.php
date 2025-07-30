<?php



date_default_timezone_set('Asia/Jakarta');
class ImporDataModel{
    //private $tablehead= 'mutasi2';
   // private $tabledetail= 'mutasidetail2';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}
	protected function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
    public function Simpandata($data){
        
      
        $tgl_from = $this->test_input($data['tgl_from']);
        $tgl_to = $this->test_input($data['tgl_to']);
        $tahun = $this->test_input($data['tahun']);
        $bulan = $this->test_input($data['bulan']);

        $this->UserInfo();
        return $this->chackoutin($tgl_from,$tgl_to,$tahun,$bulan);

       // return "ok";
       
    }

    public function chackoutin($tgl_from,$tgl_to,$tahun,$bulan){
       // $datacheckin = $this->GetDataChackInOut($tgl_from,$tgl_to,$tahun,$bulan);
      
        $json_data = $this->GetDataChackInOut($tgl_from,$tgl_to,$tahun,$bulan);
		
		

        $url =base_urlport.'/absensi/kirmdatachekinout';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data))
        );
    
        curl_exec($ch);
        $pesan ="";
        if (curl_errno($ch)) {
          // Penanganan kesalahan jika permintaan gagal
          $pesan="Gagal Expord data sending POST request:  . curl_error($ch)";
        } else {
          // Penanganan respons dari server
          $pesan="Data berhasil diimpor dari MS Access ke SQL Server.";
        }
        curl_close($ch);

      
        return $pesan;

      
    }


    private function GetDataChackInOut($tgl_from,$tgl_to,$tahun,$bulan){
   
   
		$besturl = base_urlserver3.'/imporddata/getdatatest';
		
		$data =[
			"tgl_from"=>$tgl_from,
			"tgl_to"=>$tgl_to,
			"tahun"=>$tahun,
			"bulan"=>$bulan
		 ];
	
		 
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		curl_close($curl);
		
 
    
	
		return $response;
        // Ambil data dari MS Access\
        
    // SELECT USERID,CHECKTIME,CHECKTYPE FROM CHECKINOUT WHERE  Userid=673 AND CHECKTIME BETWEEN #2024-02-01 00:00:00# AND #2024-02-23 23:59:59# ;
   
			

    }


    // public function SimpandataUser(){
        

    //     return $this->UserInfo();
    // }
    
    public function UserInfo(){

		$besturl = base_urlserver3.'/imporddata/getdatauserinfo';
		
		$curl = curl_init($besturl);
		// curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($curl);
		curl_close($curl);
	
       // $url = 'https://27.123.222.151:886/portalabsensi/public/Absensi/kirimdatauser';

        $url = base_urlport.'/absensi/kirimdatauser';
        $json_data = $response;
       
	   //die(print_r($json_data));
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data))
        );
        curl_exec($ch);
        curl_close($ch);
 
    }




    




	
	

}