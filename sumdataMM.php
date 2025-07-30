<?php

class sumdataMM extends Controller {
	public $db;
	public function index()
	{
		
		$data['page'] = "sum";
		$query ="SP_TampilDivisiProduct";
	
		$result = $this->db->baca_sql($query);
		$datafull=[];
		while(odbc_fetch_row($result)){
			$datafull[] =[
				"divisi"=>rtrim(odbc_result($result,'divisi')),
				
			];
		}
		
		$data["divisi"] = $datafull;

		$this->view('templates/header');
		//$this->view('templates/sidebar', $data);
		$this->view('sumdatamm/index',$data);
		$this->view('templates/footer');
	
	}

	public function __construct()
	{
		$this->db = new Database;
	}
	

	 public function Kirimdata(){
		
		$from  = $_POST["tgl_from"];
		$to  = $_POST["tgl_to"];
		$divisi = $_POST["divisi"];
	 /*	$query ="select  DISTINCT  b.partid
		from dotransaction a, dotransactiondetail b, sotransaction c
		where a.flagposting = 'Y' and a.flagpostinginv = 'Y'  and divisi='MM' and a.dodate >= '".$from."' and a.dodate <= '".$to."' 
		and a.dotransacid = b.dotransacid and a.sotransacid = c.sotransacid order by partid  "; */
		
		$query ="catez  '".$from."','".$to."','".$divisi."' ";
		$result = $this->db->baca_sql($query);

        $data =[];
		
		  while(odbc_fetch_row($result)){
            $data[] = array(
                "partid"=>$this->subts(rtrim(odbc_result($result,'spartid'))),
				 "partname"=>$this->subts(rtrim(odbc_result($result,'partname'))),
				 "div"=>$this->subts(rtrim(odbc_result($result,'div'))),
				 "qty"=>$this->subts(rtrim(odbc_result($result,'qty'))),
				 "amount"=>round($this->subts(rtrim(odbc_result($result,'amount'))),2)
            );
            }
			
			
		
     /*   while(odbc_fetch_row($result)){
            $data[] = array(
                "partid"=>$this->subts(rtrim(odbc_result($result,'partid'))),
				
            );
            }

		*/
			$fulldata =[];
		foreach ($data as $item){
			$fulldata[] =[
				"partid"=>$item["partid"],
				"partname"=>$item["partname"],
				"div"=>$item["div"],
				"qty"=>$item["qty"],
				"amount"=>$this->getformatnumer($item["amount"]),
				//"dodate"=>$this->SetDoDate($from,$to,$item["partid"]),
			];
			
		} 
	
	   
	   
	
		if(empty($fulldata)){
            $fulldata = null;
            echo json_encode($fulldata);
        }else{
            echo json_encode($fulldata);
        }

	 }

	private function getformatnumer($data){
		$format =number_format($data,0,",",",");
		return $format;
	}


	 private function subts($partid){

		$expolod = explode("-",$partid);
		
		$partineew = $expolod[0];
		
		return $partineew;
	 }



	 private function SetDoDate($from,$to,$partid){
		
		$query ="select a.dodate
from [bambi-bmi].[dbo].dotransaction a, [bambi-bmi].[dbo].dotransactiondetail b, [bambi-bmi].[dbo].sotransaction c  
where a.flagposting = 'Y' and a.flagpostinginv = 'Y'  and divisi='MM' and a.dodate >='".$from."' and a.dodate <='".$to."'
and a.dotransacid = b.dotransacid and a.sotransacid = c.sotransacid AND ";
	
		$result = $this->db->baca_sql3($query);
		$dodate=odbc_result($result,"dodate");

		return $dodate;

	 }




	 private function SetQty($from,$to,$partid){
		
		$query ="SP_Rubah_partid  '".$from."','".$to."','".$partid."'";
	
		$result = $this->db->baca_sql3($query);
		$qty=odbc_result($result,"qty");

		return $qty;

	 }
	 
	 
	 
	 public function testgetdata(){
			
		
		$besturl = base_urlserver3.'/imporddata/getdatatest';
		//die(var_dump($besturl));
		$data = ['wardi'=>12];
		$curl = curl_init($besturl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

		$response = curl_exec($curl);
		curl_close($curl);
		
		
		return $response;
	
		

	}
}